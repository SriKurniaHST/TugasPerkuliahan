<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Beranda::index');
$routes->get('/login', 'Auth::showLogin');
$routes->post('/auth/login', 'Auth::login');
$routes->post('/auth/logout', 'Auth::logout');
$routes->get('/admin/dashboard', 'Admin::dashboard'); 
$routes->get('/register', 'Auth::showRegister'); 
$routes->post('/auth/processRegister', 'Auth::processRegister'); 
$routes->get('/admin/anggota_list', 'Admin::anggotaList'); 
$routes->get('/anggota/dashboard', 'Anggota::dashboard');
$routes->get('/admin/list_buku', 'Admin::listBuku'); 
$routes->get('/admin/form_tambah_buku', 'Admin::showFormTambahBuku');
$routes->post('/admin/tambahBuku', 'Admin::tambahBuku');
$routes->get('/admin/hapus_buku/(:num)', 'Admin::hapusBuku/$1');
$routes->get('/admin/form_ubah_buku/(:num)', 'Admin::ShowformUbahBuku/$1');
$routes->post('/admin/ubahBuku', 'Admin::ubahBuku');
$routes->get('/admin/detail_buku/(:num)', 'Admin::detailBuku/$1');
$routes->get('/profile_input', 'Anggota::profileInput');
$routes->post('/anggota/detailAnggota', 'Anggota::detailAnggota');
$routes->get('/anggota/showProfil/(:num)', 'Anggota::showProfil/$1');
$routes->get('/anggota/edit_profil/(:num)', 'Anggota::showEditProfil/$1');
$routes->post('/anggota/updateProfil/(:num)', 'Anggota::updateProfil/$1');
$routes->get('/anggota/peminjaman', 'Anggota::peminjaman');
$routes->post('/anggota/form_pinjam/(:num)', 'Anggota::ShowFormPinjam/$1');
$routes->post('/anggota/prosesPinjam', 'Anggota::prosesPinjam');
$routes->get('/anggota/daftar_buku_pinjam', 'Anggota::bukuDipinjam');
$routes->get('/admin/list_peminjaman', 'Admin::viewAllLoans');
$routes->get('/admin/kembali/(:num)', 'Admin::kembali/$1');
$routes->get('/admin/detail_anggota/(:num)', 'admin::detailAnggota/$1');
$routes->get('/admin/form_tambah_kategori', 'Admin::showFormTambahKategori');
$routes->post('/admin/tambahKategori', 'Admin::tambahKategori');
$routes->get('/admin/form_tambah_penerbit', 'Admin::showFormTambahPenerbit');
$routes->post('/admin/tambahPenerbit', 'Admin::tambahPenerbit');
$routes->get('/admin/list_kategori', 'Admin::listKategori'); 
$routes->get('/admin/list_penerbit', 'Admin::listPenerbit');
$routes->get('/admin/hapus_kategori/(:num)', 'Admin::hapusKategori/$1'); 
$routes->get('/admin/form_ubah_kategori/(:num)', 'Admin::ShowformUbahKategori/$1');
$routes->post('/admin/ubahKategori', 'Admin::ubahKategori');
$routes->get('/admin/form_ubah_kategori/(:num)', 'Admin::ShowformUbahKategori/$1');
$routes->post('/admin/ubahKategori', 'Admin::ubahKategori');
$routes->get('/admin/form_ubah_penerbit/(:num)', 'Admin::ShowformUbahPenerbit/$1');
$routes->post('/admin/ubahPenerbit', 'Admin::ubahPenerbit');
$routes->get('/admin/hapus_penerbit/(:num)', 'Admin::hapusPenerbit/$1'); 













