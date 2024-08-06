<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\PublisherModel;
use App\Models\LoanModel;
use App\Models\MemberModel;
use CodeIgniter\Commands\Utilities\Publish;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function anggotaList()
    {

        if (session('role') !== 'admin') {
            return redirect()->to('/');
        }

        $userModel = new UserModel();
        $siswaData = $userModel->where('role', 'anggota')->findAll(); // Ambil semua data siswa

        return view('admin/anggota_list', ['siswaData' => $siswaData]);
    }

    public function listBuku(){
        $bukuModel = new BookModel();
        $bukuData = $bukuModel->findAll();

        return view ('admin/list_buku', ['bukuData' => $bukuData]);
    }

    
    public function showFormTambahBuku()
    {
        $publisherModel = new PublisherModel();
        $categoryModel = new CategoryModel();
    
        $publishers = $publisherModel->findAll(); // Ambil semua data publisher
        $categories = $categoryModel->findAll(); // Ambil semua data kategori
    
        return view('admin/form_tambah_buku', [
            'publishers' => $publishers,
            'categories' => $categories
        ]);
    }

    private function uploadFoto($inputName)
    {
        $foto = $this->request->getFile($inputName);

        if ($foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $path = FCPATH . 'public/upload/buku/';

            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            if ($foto->move($path, $newName)) {
                return $newName; // Jika berhasil, kembalikan nama file baru
            } else {
                // Jika gagal, kembalikan null dan tampilkan pesan kesalahan
                $error = $foto->getError();
                log_message('error', 'Gagal mengunggah file: ' . $error);
                return null;
            }
        }

        return null; // Kembalikan null jika file tidak valid atau sudah dipindahkan sebelumnya
    }



    public function tambahBuku()
    {
        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('foto_buku');
    
            if ($file->isValid() && !$file->hasMoved()) {
                $validationRules = [
                    'judul' => 'required',
                    'isbn' => 'required|is_unique[books.isbn]', 
                    'pengarang' => 'required',
                    'id_penerbit' => 'required',
                    'tahun_terbit' => 'required|numeric',
                    'id_kategori' => 'required',
                    'jumlah_buku' => 'required|numeric',
                    'foto_buku' => 'uploaded[foto_buku]|mime_in[foto_buku,image/jpg,image/jpeg,image/png]|max_size[foto_buku,1024]'
                ];
    
                $validation = \Config\Services::validation();
                if (!$validation->setRules($validationRules)->run($_POST)) {
                    return redirect()->back()->withInput()->with('errors', $validation->getErrors());
                }
    
                // Lakukan proses upload foto buku
                $namaFoto = $this->uploadFoto('foto_buku');
    
                if ($namaFoto !== null) {
                    // Data untuk disimpan ke database
                    $data = [
                        'judul' => $this->request->getPost('judul'),
                        'isbn' => $this->request->getPost('isbn'),
                        'pengarang' => $this->request->getPost('pengarang'),
                        'id_penerbit' => $this->request->getPost('id_penerbit'),
                        'tahun_terbit' => $this->request->getPost('tahun_terbit'),
                        'id_kategori' => $this->request->getPost('id_kategori'),
                        'jumlah_buku' => $this->request->getPost('jumlah_buku'),
                        'foto_buku' => $namaFoto
                    ];
    
                    // Simpan data ke database
                    $bookModel = new BookModel();
                    $bookModel->insert($data);
    
                    session()->setFlashdata('success', 'Buku berhasil disimpan.');
                    return redirect()->to('/admin/list_buku')->with('success', 'Buku berhasil disimpan');
                } else {
                    session()->setFlashdata('error', 'Gagal mengunggah foto buku.');
                    return redirect()->back()->withInput();
                }
            }
        }
    
        session()->setFlashdata('error', 'Buku gagal ditambahkan.');
        return redirect()->back()->withInput();
    }
    

    public function ShowformUbahBuku($id)
    {
    $bookModel = new BookModel();
    $buku = $bookModel->find($id);

    $publisherModel = new PublisherModel();
    $categoryModel = new CategoryModel();

    $publishers = $publisherModel->findAll(); // Ambil semua data publisher
    $categories = $categoryModel->findAll(); // Ambil semua data kategori

    return view('admin/form_ubah_buku', [
        'buku' => $buku,
        'publishers' => $publishers,
        'categories' => $categories
    ]);
    }


    public function ubahBuku()
    {
    $bookModel = new BookModel();

    $id = $this->request->getVar('id');

    $data = [
        'judul' => $this->request->getVar('judul'),
        'isbn' => $this->request->getVar('isbn'),
        'pengarang' => $this->request->getVar('pengarang'),
        'id_penerbit' => $this->request->getVar('id_penerbit'),
        'tahun_terbit' => $this->request->getVar('tahun_terbit'),
        'id_kategori' => $this->request->getVar('id_kategori'),
        'jumlah_buku' => $this->request->getVar('jumlah_buku'),
        
    ];

    $foto = $this->request->getFile('foto_buku');
    if ($foto && $foto->isValid() && !$foto->hasMoved()) {
        // Proses upload foto
        $newName = $foto->getRandomName();
        $path = FCPATH . 'public/upload/buku/';

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        if ($foto->move($path, $newName)) {
            $data['foto_buku'] = $newName;
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah foto');
        }
    }

    $bookModel->update($id, $data);

    session()->setFlashdata('success', 'Buku berhasil diubah.');
    return redirect()->to('/admin/list_buku')->with('success', 'Buku berhasil diubah.');
    }


    public function hapusBuku($id)
    {
        $bookModel = new BookModel();

        $bookModel->delete($id);

        session()->setFlashdata('success', 'Buku berhasil dihapus.');
        return redirect()->to('/admin/list_buku')->with('success', 'Buku berhasil dihapus');
    }

    public function detailBuku($id)
    {
        $BukuModel = new BookModel();
        $buku = $BukuModel->find($id);

        if ($buku) {
            return view('/admin/detail_buku', ['buku' => $buku]);
        } else {
            // Tampilkan pesan atau redirect jika buku tidak ditemukan
            return redirect()->to('/page_not_found');
        }

    }


    public function viewAllLoans()
    {
        // Load model
        $loanModel = new LoanModel();

        // Filter dan urutkan data peminjaman
        $loans = $loanModel->where('status', 'Terlambat')
        ->orWhere('status', 'Dipinjam')
        ->orWhere('status', 'Kembali')
        ->orderBy('status', 'ASC') // Urutkan berdasarkan status secara descending
        ->orderBy('tgl_pengembalian', 'DESC') // Kemudian, urutkan berdasarkan tanggal pengembalian secara ascending
        ->findAll();

    
        // Pass data to the view
        return view('admin/list_peminjaman', ['loans' => $loans]);
    }

    public function kembali($id)
    {
        $loanModel = new LoanModel();
        $bookModel = new BookModel();

        // Ambil data peminjaman berdasarkan ID
        $loan = $loanModel->find($id);

        if (!$loan) {
            return redirect()->to('/admin/list_peminjaman')->with('error', 'Data peminjaman tidak ditemukan');
        }

        // Perbarui status peminjaman menjadi 'kembali'
        $loan['status'] = 'Kembali';
        $loanModel->save($loan);

        // Ambil data buku berdasarkan ID
        $book = $bookModel->find($loan['id_buku']);

        if ($book) {
            $book['jumlah_buku'] += 1;
            $bookModel->save($book);
        }
        session()->setFlashdata('success', 'Buku berhasil dikembalikan.');

        return redirect()->to('/admin/list_peminjaman')->with('success', 'Buku berhasil dikembalikan');
    }   

    public function detailAnggota($id)
    {
        // Instansiasi model MemberModel
        $memberModel = new MemberModel();
    
        // Dapatkan data profil anggota berdasarkan ID user
        $profil = $memberModel->where('id_user', $id)->first();
    
        if ($profil) {
            // Jika profil ditemukan, tampilkan data profil
            return view('admin/detail_anggota', ['profil' => $profil]); // Ganti dengan nama view yang sesuai
        } else {
            // Jika profil tidak ditemukan, tampilkan pesan atau redirect ke halaman lain
            return redirect()->to('admin/anggota_list')->with('error', 'Profil tidak ditemukan');
        }
    }

    public function tambahKategori()
{
    $kategoriModel = new CategoryModel(); // Ganti dengan model kategori yang Anda miliki

    // Ambil data dari form
    $data = [
        'kode_kategori' => $this->request->getPost('kode_kategori'),
        'nama_kategori' => $this->request->getPost('nama_kategori'),
    ];

    // Validasi data
    $validationRules = [
        'kode_kategori' => 'required',
        'nama_kategori' => 'required',
    ];

    $validation = \Config\Services::validation();
    if (!$validation->setRules($validationRules)->run($data)) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Tambahkan kategori
    $kategoriModel->insert($data);

    session()->setFlashdata('success', 'Kategori berhasil ditambahkan.');
     
    return redirect()->to('/admin/list_kategori')->with('success', 'Kategori berhasil ditambahkan');
}

    public function showFormTambahKategori(){
        return view('admin/form_tambah_kategori');
    }

    public function listKategori(){
        $kategoriModel = new CategoryModel();
        $kategoriData = $kategoriModel->orderBy('kode_kategori', 'ASC')->findAll();

        return view ('admin/list_kategori', ['kategoriData' => $kategoriData]);
    }

    public function hapusKategori($id)
    {
        $kategoriModel = new CategoryModel();

        $kategoriModel->delete($id);

        session()->setFlashdata('success', 'Kategori berhasil dihapus.');
        return redirect()->to('/admin/list_kategori')->with('success', 'Kategori berhasil dihapus');
    }

    public function tambahPenerbit()
{
    $penerbitModel = new PublisherModel(); // Ganti dengan model penerbit yang Anda miliki

    // Ambil data dari form
    $data = [
        'kode_penerbit' => $this->request->getPost('kode_penerbit'),
        'nama_penerbit' => $this->request->getPost('nama_penerbit'),
    ];

    // Validasi data
    $validationRules = [
        'kode_penerbit' => 'required',
        'nama_penerbit' => 'required',
    ];

    $validation = \Config\Services::validation();
    if (!$validation->setRules($validationRules)->run($data)) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Tambahkan penerbit
    $penerbitModel->insert($data);

    session()->setFlashdata('success', 'penerbit berhasil ditambahkan.');
     
    return redirect()->to('/admin/list_penerbit')->with('success', 'penerbit berhasil ditambahkan');
}

    public function showFormTambahPenerbit(){
        return view('admin/form_tambah_penerbit');
    }

    public function listPenerbit(){
        $penerbitModel = new PublisherModel();
        $penerbitData = $penerbitModel->findAll();

        return view ('admin/list_penerbit', ['penerbitData' => $penerbitData]);
    }

    public function hapusPenerbit($id)
    {
        $penerbitModel = new PublisherModel();

        $penerbitModel->delete($id);

        session()->setFlashdata('success', 'Penerbit berhasil dihapus.');
        return redirect()->to('/admin/list_penerbit')->with('success', 'Penerbit berhasil dihapus');
    }

    public function ShowformUbahKategori($id)
    {
        $kategoriModel = new CategoryModel();
        $category = $kategoriModel->find($id);


        return view('admin/form_ubah_kategori', [
            'category' => $category,
        ]);
    }

    public function ubahKategori()
    {
    $kategoriModel = new CategoryModel();

    $id = $this->request->getVar('id');

    $data = [
        'kode_kategori' => $this->request->getVar('kode_kategori'),
        'nama_kategori' => $this->request->getVar('nama_kategori'),
        
    ];

    $kategoriModel->update($id, $data);

    session()->setFlashdata('success', 'Kategori berhasil diubah.');
    return redirect()->to('/admin/list_kategori')->with('success', 'Kategori berhasil diubah.');
    }

    public function ubahPenerbit()
    {
    $penerbitModel = new PublisherModel();

    $id = $this->request->getVar('id');

    $data = [
        'kode_penerbit' => $this->request->getVar('kode_penerbit'),
        'nama_penerbit' => $this->request->getVar('nama_penerbit'),
        
    ];

    $penerbitModel->update($id, $data);

    session()->setFlashdata('success', 'Penerbit berhasil diubah.');
    return redirect()->to('/admin/list_penerbit')->with('success', 'Penerbit berhasil diubah.');
    }




    public function ShowformUbahPenerbit($id)
    {
        $penerbitModel = new PublisherModel();
        $penerbit = $penerbitModel->find($id);


        return view('admin/form_ubah_penerbit', [
            'penerbit' => $penerbit ,
        ]);
    }


}
