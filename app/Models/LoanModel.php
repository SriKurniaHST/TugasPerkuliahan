<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\MemberModel;

class LoanModel extends Model 
{

    protected $table = 'borrow_service';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['id_buku', 'id_user', 'tgl_peminjaman', 'tgl_pengembalian', 'status'];  

    public function user()
    {
        return $this->belongsTo('App\Models\MemberModel', 'id_user', 'id_user');
    }
}