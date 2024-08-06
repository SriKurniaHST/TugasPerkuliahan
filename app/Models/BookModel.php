<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model 
{

    protected $table = 'books';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['judul', 'isbn', 'pengarang', 'id_penerbit', 'tahun_terbit', 'id_kategori', 'jumlah_buku', 'foto_buku'];  
}