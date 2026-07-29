<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/gis.css') ?>">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<section class="gis-banner">
    <div class="container text-center">
        <h1>GIS Kabupaten Banyuwangi</h1>
        <p>
            Sistem Informasi Geografis Sumber Daya Air dan
            Infrastruktur Pengairan
        </p>
    </div>
</section>

<section class="gis-content">

    <div class="container">

        <div class="breadcrumb-box">
            <a href="<?= base_url() ?>">Beranda</a>
            >
            <span>GIS</span>
        </div>

        <div class="row mt-4">

            <!-- FILTER -->
            <div class="col-md-3">

               <div class="filter-card">

    <div class="filter-header">
        ☰ Filter Kecamatan
    </div>

    <div class="p-3">

        <!-- Filter Kecamatan -->
        <select class="form-select" id="filterKecamatan">

            <option value="">
                Semua Kecamatan
            </option>

            <?php foreach ($kecamatan as $k): ?>

                <option value="<?= $k['id']; ?>">
                    <?= esc($k['nama_kecamatan']); ?>
                </option>

            <?php endforeach; ?>

        </select>

        <!-- Filter Kategori -->
        <select class="form-select mt-3" id="filterKategori">

            <option value="">
                Semua Infrastruktur
            </option>

            <option value="jaringan irigasi">
                Jaringan Irigasi
            </option>

            <option value="bendungan">
                Bendungan
            </option>

            <option value="embung">
                Embung
            </option>

            <option value="bangunan pengairan">
                Bangunan Pengairan
            </option>

        </select>

        <button
            class="btn btn-secondary w-100 mt-3"
            id="resetFilter">

            Reset Filter

        </button>

    </div>

</div>

            </div>

            <!-- MAP -->
            <div class="col-md-9">

                <div id="map"
                     style="height:600px;border-radius:10px;"></div>

            </div>

        </div>

    </div>

</section>

<script>

const dataGIS = <?= json_encode($gis ?? []); ?>;

document.addEventListener("DOMContentLoaded", function () {

    const map = L.map('map').setView([-8.2192,114.3691],10);

    L.tileLayer(
'https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',
{
    maxZoom:20,
    subdomains:['mt0','mt1','mt2','mt3']
}).addTo(map);

    let markers=[];

    function tampilkanMarker(){

        // Hapus marker lama
        markers.forEach(function(marker){
            map.removeLayer(marker);
        });

        markers=[];

        const idKorsda=document.getElementById('filterKecamatan').value;
        const kategori=document.getElementById('filterKategori').value;

        dataGIS.forEach(function(item){

            // Filter Kecamatan
            if(idKorsda!="" && String(item.id_korsda)!==idKorsda){
                return;
            }
            if(
    kategori != "" &&
    (item.keterangan ?? "").toLowerCase().trim() != kategori.toLowerCase().trim()
){
    return;
}

            if(
                item.latitude==null ||
                item.longitude==null ||
                item.latitude=="" ||
                item.longitude==""
            ){
                return;
            }

            let marker=L.marker([
                parseFloat(item.latitude),
                parseFloat(item.longitude)
            ]).addTo(map);

            marker.bindPopup(`
                <div style="min-width:220px">

                    <h6>${item.nama_lokasi}</h6>

                    <hr>

                    <b>Kecamatan</b><br>

                    ${item.nama_kecamatan ?? '-'}

                    <br><br>

                    <b>Latitude</b><br>

                    ${item.latitude}

                    <br><br>

                    <b>Longitude</b><br>

                    ${item.longitude}

                    <br><br>

                    <b>Keterangan</b><br>

                    ${item.keterangan ?? '-'}

                </div>
            `);

            markers.push(marker);

        });

        if(markers.length>0){

            let group=L.featureGroup(markers);

            map.fitBounds(group.getBounds().pad(0.2));

        }

    }

    tampilkanMarker();

    document
        .getElementById("filterKecamatan")
        .addEventListener("change",tampilkanMarker);
    
    document
    .getElementById("filterKategori")
    .addEventListener("change",tampilkanMarker);

    document
        .getElementById("resetFilter")
        .addEventListener("click",function(){

            document.getElementById("filterKecamatan").value="";
            document.getElementById("filterKategori").value="";

            tampilkanMarker();

        });

});
</script>

<?= $this->include('layout/footer') ?>