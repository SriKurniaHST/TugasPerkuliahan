<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MemberModel;
use App\Models\BookModel;
use App\Models\LoanModel;
use CodeIgniter\HTTP\ResponseInterface;

class Anggota extends BaseController
{
    public function dashboard()
    {
        // Pastikan user sudah login dan ambil ID user dari sesi
        $id_user = session()->get('id');
    
        // Cek keberadaan data anggota berdasarkan ID user pada tabel member
        $memberModel = new MemberModel();
    
        // Pastikan model MemberModel telah di-load melalui constructor atau menggunakan Dependency Injection
    
        $memberData = $memberModel->where('id_user', $id_user)->first();
    
        // Jika data anggota tidak ditemukan, arahkan pengguna ke halaman profile_input
        if ($memberData === null) {
            return redirect()->to('/profile_input')->with('warning', 'Lengkapi profil Anda');
        }
    
        // Tampilkan dashboard jika data anggota sudah ada
        return view('anggota/dashboard'); // Pastikan ini sesuai dengan nama view yang Anda gunakan
    }
    


    private function uploadFoto($inputName)
    {
        $foto = $this->request->getFile($inputName);

        if ($foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $path = FCPATH . 'public/upload/anggota/';

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

    
    public function detailAnggota()
{
    if ($this->request->getMethod() === 'post') {
        $file = $this->request->getFile('foto_anggota');

        if ($file->isValid() && !$file->hasMoved()) {
            $validationRules = [
                'kode_anggota' => 'is_unique[member.kode_anggota]', 
                'nama' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tgl_lahir' => 'required',
                'telpon' => 'required',
                'alamat' => 'required',
                'foto_anggota' => 'uploaded[foto_anggota]|mime_in[foto_anggota,image/jpg,image/jpeg,image/png]|max_size[foto_anggota,2048]'
            ];

            $validation = \Config\Services::validation();
            if (!$validation->setRules($validationRules)->run($this->request->getPost())) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $id_user = session()->get('id');
            $kode_anggota = '6307' . substr(str_shuffle('0123456789'), 0, 8);

            $namaFoto = $this->uploadFoto('foto_anggota');
            
            if ($namaFoto !== null) {
                $data = [
                    'id_user' => $id_user,
                    'kode_anggota' => $kode_anggota,
                    'nama' => $this->request->getPost('nama'),
                    'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                    'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                    'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                    'telpon' => $this->request->getPost('telpon'),
                    'alamat' => $this->request->getPost('alamat'),
                    'foto_anggota' => $namaFoto
                ];

                $memberModel = new MemberModel();
                $memberModel->insert($data);

                session()->setFlashdata('success', 'Profil berhasil disimpan.');
                return redirect()->to('/anggota/dashboard')->with('success', 'Profil berhasil disimpan');
            } else {
                session()->setFlashdata('error', 'Gagal mengunggah foto Anggota.');
                return redirect()->back()->withInput();
            }
        }
    }

    session()->setFlashdata('error', 'Profil gagal ditambahkan.');
    return redirect()->back()->withInput();
}


    public function profileInput()
    { 
        return view('anggota/profile_input');
    }

    public function showProfil($id_user)
    {
        // Instansiasi model MemberModel
        $memberModel = new MemberModel();
    
        // Dapatkan data profil anggota berdasarkan ID user
        $profil = $memberModel->where('id_user', $id_user)->first();
    
        if ($profil) {
            // Jika profil ditemukan, tampilkan data profil
            return view('anggota/profil', ['profil' => $profil]); // Ganti dengan nama view yang sesuai
        } else {
            // Jika profil tidak ditemukan, tampilkan pesan atau redirect ke halaman lain
            return redirect()->to('/dashboard')->with('error', 'Profil tidak ditemukan');
        }
    }


        public function showEditProfil($id_user)
    {
        $memberModel = new MemberModel();
        
        // Gunakan 'id_user' sebagai kriteria pencarian
        $profil = $memberModel->where('id_user', $id_user)->first();

        if ($profil) {
            return view('anggota/edit_profil', ['profil' => $profil]);
        } else {
            return redirect()->to('/anggota/dashboard')->with('error', 'Profil tidak ditemukan');
        }
    }

    // Anggota controller
public function updateProfil($id_user)
{
    $memberModel = new MemberModel();
    $profil = $memberModel->find($id_user);

    if ($this->request->getMethod() === 'post') {
        // Atur aturan validasi sesuai kebutuhan
        $validationRules = [
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'telpon' => 'required',
            'alamat' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'telpon' => $this->request->getPost('telpon'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $foto = $this->request->getFile('foto_anggota');
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                // Proses upload foto
                $newName = $foto->getRandomName();
                $path = FCPATH . 'public/upload/anggota/';

                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }

                if ($foto->move($path, $newName)) {
                    $data['foto_anggota'] = $newName;
                } else {
                    return redirect()->back()->withInput()->with('error', 'Gagal mengunggah foto');
                }
            }

        // Update data anggota
        $memberModel->update($profil['id'], $data);

        return redirect()->to('/anggota/dashboard')->with('success', 'Profil berhasil diperbarui');
    }

    return redirect()->to('/anggota/profil')->with('error', 'Metode yang digunakan tidak valid');
}



// public function updateProfil($id_user)
// {
//     $memberModel = new MemberModel();
//     $profil = $memberModel->find($id_user);

//     // Tambahkan penanganan kesalahan jika profil tidak ditemukan
//     if ($profil === null) {
//         return redirect()->to('/anggota/profil')->with('error', 'Profil tidak ditemukan');
//     }

//     if ($this->request->getMethod() === 'post') {
//         $data = [
//             'nama' => $this->request->getPost('nama'),
//             'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
//             'tempat_lahir' => $this->request->getPost('tempat_lahir'),
//             'tgl_lahir' => $this->request->getPost('tgl_lahir'),
//             'telpon' => $this->request->getPost('telpon'),
//             'alamat' => $this->request->getPost('alamat'),
//         ];

//         // Proses upload foto
//         $foto = $this->request->getFile('foto_anggota');
//         if ($foto->isValid() && !$foto->hasMoved()) {
//             $newName = $foto->getRandomName();
//             $path = FCPATH . 'public/upload/anggota/';

//             if (!is_dir($path)) {
//                 mkdir($path, 0777, true);
//             }

//             if ($foto->move($path, $newName)) {
//                 $data['foto_anggota'] = $newName;
//             } else {
//                 return redirect()->back()->withInput()->with('error', 'Gagal mengunggah foto');
//             }
//         }

//         // Log untuk debugging
//         log_message('info', 'Data yang akan disimpan: ' . print_r($data, true));

//         $memberModel->update($profil['id'], $data);

//         return redirect()->to('/anggota/profil')->with('success', 'Profil berhasil diperbarui');
//     }

//     return redirect()->to('/anggota/profil')->with('error', 'Metode yang digunakan tidak valid');
// }


    public function prosesPinjam()
    {
        // Pastikan user sudah login dan dapatkan ID user dari sesi
        $id_user = session()->get('id');
    
        // Ambil data yang dikirimkan dari form
        $id_buku = $this->request->getPost('id_buku');
        $tanggal_pinjam = $this->request->getPost('tanggal_pinjam');
        $tanggal_kembali = $this->request->getPost('tanggal_kembali');

        $bookModel = new BookModel();
        $loanModel = new LoanModel();
    
        // Dapatkan informasi buku yang akan dipinjam
        $book = $bookModel->find($id_buku);
    
        // Pastikan buku tersedia
        if ($book['jumlah_buku'] > 0) {
            // Kurangi jumlah buku yang tersedia di database
            $bookModel->update($id_buku, ['jumlah_buku' => $book['jumlah_buku'] - 1]);
    
            // Data peminjaman yang akan disimpan
            $loanData = [
                'id_user' => $id_user,
                'id_buku' => $id_buku,
                'tgl_peminjaman' => $tanggal_pinjam,
                'tgl_pengembalian' => $tanggal_kembali,
                'status' => 'dipinjam'
            ];
    
            // Simpan informasi peminjaman ke dalam database
            $loanModel->insert($loanData);

            session()->setFlashdata('success', 'Buku berhasil dikembalikan.');
    
            // Redirect ke halaman tertentu setelah berhasil meminjam
            return redirect()->to('/anggota/peminjaman')->with('success', 'Buku berhasil dipinjam.');
        } else {
            return redirect()->to('/anggota/peminjaman')->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }
    }
    

    // Metode untuk melihat daftar buku yang telah dipinjam
    public function bukuDipinjam()
    {
        // Dapatkan ID anggota dari sesi
        $id_user = session()->get('id');

        // Buat instance model
        $loanModel = new LoanModel();
        $bookModel = new BookModel();

        // Dapatkan daftar buku yang sedang dipinjam oleh anggota
        $books = $loanModel->where('id_user', $id_user)
            ->where('status', 'dipinjam')
            ->findAll();
        
             // Ambil informasi buku berdasarkan id_buku
        foreach ($books as &$book) {
            $buku = $bookModel->find($book['id_buku']);
            if ($buku) {
                $book['judul'] = $buku['judul'];
                // Jika informasi judul buku berhasil ditemukan, tambahkan ke dalam array buku
            } else {
                $book['judul'] = 'Judul tidak ditemukan'; // Tambahkan judul default jika tidak ditemukan
            }
    }

        // Tampilkan daftar buku yang sedang dipinjam
        return view('anggota/daftar_buku_pinjam', ['books' => $books]);
    }

    public function peminjaman()
    {
        // Instansiasi model buku untuk mendapatkan daftar buku
        $bukuModel = new BookModel();
        $data['daftarBuku'] = $bukuModel->findAll();

        // Tampilkan halaman peminjaman dengan daftar buku
        return view('anggota/peminjaman', $data);
    }

    public function showFormPinjam($id_buku)
    {
        // Di sini, Anda dapat melakukan logika untuk mengambil informasi buku berdasarkan ID
        // Misalnya menggunakan model atau service
        $data = [
            'id_buku' => $id_buku,
            'id_user' => session()->get('id')
        ];

        return view('anggota/form_pinjam', $data);
    }

}
