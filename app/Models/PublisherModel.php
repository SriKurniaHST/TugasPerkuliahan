<?php

namespace App\Models;

use CodeIgniter\Model;

class PublisherModel extends Model 
{

    protected $table = 'publisher';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['kode_penerbit', 'nama_penerbit'];  
}