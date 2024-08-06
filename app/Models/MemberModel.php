<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'member'; 
    protected $primaryKey = 'id'; 

    protected $allowedFields = ['id_user', 'kode_anggota', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tgl_lahir', 'telpon', 'alamat', 'foto_anggota']; 
}
