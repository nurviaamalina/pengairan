<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'username',
        'email',
        'password',
        'role',
        'remember_token',
        'reset_token',
        'reset_expires',
        'otp_code',
        'otp_expires'
    ];

    protected $useTimestamps = true;
}