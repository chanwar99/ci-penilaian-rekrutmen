<?php namespace App\Models\Auth;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table        = 'tb_admin';
    protected $primaryKey   = 'id_admin';

    public function getSingleUser($emailOrUsername)
    {
        $key = filter_var($emailOrUsername, FILTER_VALIDATE_EMAIL) ? 'alamat_email' : 'nama_user';
        return $this->where($key, $emailOrUsername)->first();
    }
}