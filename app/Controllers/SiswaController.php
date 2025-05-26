<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class SiswaController extends BaseController
{
    protected $siswaModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $siswa = $this->siswaModel
                ->like('nama', $keyword)
                ->findAll();
        } else {
            $siswa = $this->siswaModel->findAll();
        }
        return view('pages/siswa/index', [
            'siswa' => $siswa,
        ]);
    }



    public function tambah()
    {
        return view('pages/siswa/tambah');
    }

    public function simpan()
    {
        // Validasi input
        if (!$this->validate([
            'nama'          => 'required|max_length[100]',
            'alamat'        => 'required|max_length[255]',
            'jurusan'       => 'required|max_length[100]',
            'asal_instansi' => 'required|max_length[100]',
            'no_telepon'    => 'required|numeric',
            'email'         => 'required|valid_email',
            'jenis_kelamin' => 'required',
            'tgl_masuk'     => 'required',
            'tgl_keluar'    => 'required',
            'status'        => 'required',
            'keterangan'    => 'required|max_length[255]',
            'foto'          => 'uploaded[foto]|is_image[foto]|max_size[foto,2048]', // Validasi foto
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Mengambil data dari form
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $jurusan = $this->request->getPost('jurusan');
        $asalInstansi = $this->request->getPost('asal_instansi');
        $noTelepon = $this->request->getPost('no_telepon');
        $email = $this->request->getPost('email');
        $jenisKelamin = $this->request->getPost('jenis_kelamin');
        $tglMasuk = $this->request->getPost('tgl_masuk');
        $tglKeluar = $this->request->getPost('tgl_keluar');
        $status = $this->request->getPost('status');
        $keterangan = $this->request->getPost('keterangan');

        // Mengambil file foto dari input
        $foto = $this->request->getFile('foto');

        // Cek apakah file foto ada dan valid
        if ($foto->isValid() && !$foto->hasMoved()) {
            // Tentukan nama file baru untuk foto
            $newName = $foto->getRandomName(); // Menghasilkan nama file acak

            // Tentukan folder tujuan dalam folder public/assets/img/user
            $path = 'assets/img/user/' . $newName;

            // Pindahkan file foto ke folder public/assets/img/user
            $foto->move(FCPATH . 'assets/img/user', $newName);

            // Simpan nama file foto ke dalam data array (hanya nama file, bukan path lengkap)
            $data['foto'] = $newName;
        } else {
            // Jika file tidak valid, beri pesan error
            return redirect()->back()->with('error', 'File foto tidak valid atau gagal diupload!');
        }

        // Data untuk disimpan ke database
        $data = [
            'nama'          => $nama,
            'alamat'        => $alamat,
            'jurusan'       => $jurusan,
            'asal_instansi' => $asalInstansi,
            'no_telepon'    => $noTelepon,
            'email'         => $email,
            'jenis_kelamin' => $jenisKelamin,
            'tgl_masuk'     => $tglMasuk,
            'tgl_keluar'    => $tglKeluar,
            'status'        => $status,
            'foto'          => $data['foto'], // Pastikan menggunakan path foto yang disimpan
            'keterangan'    => $keterangan,
        ];

        // Simpan data ke database
        $siswaModel = new SiswaModel();
        $siswaModel->save($data);

        // Redirect dengan pesan sukses
        return redirect()->to('siswa')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit($id_siswa)
    {
        $siswa = $this->siswaModel->find($id_siswa);
        if (!$siswa) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data siswa tidak ditemukan.');
        }

        return view('pages/siswa/edit', ['siswa' => $siswa]);
    }

    public function update($id_siswa)
    {
        $siswa = $this->siswaModel->find($id_siswa);
        if (!$siswa) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data siswa tidak ditemukan.');
        }

        $rules = [
            'nama'          => 'required|max_length[100]',
            'alamat'        => 'required|max_length[255]',
            'jurusan'       => 'required|max_length[100]',
            'asal_instansi' => 'required|max_length[100]',
            'no_telepon'    => 'required|numeric',
            'email'         => 'required|valid_email',
            'jenis_kelamin' => 'required',
            'tgl_masuk'     => 'required',
            'tgl_keluar'    => 'required',
            'status'        => 'required',
            'keterangan'    => 'required|max_length[255]',
        ];

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $rules['foto'] = 'is_image[foto]|max_size[foto,2048]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama'          => $this->request->getPost('nama'),
            'alamat'        => $this->request->getPost('alamat'),
            'jurusan'       => $this->request->getPost('jurusan'),
            'asal_instansi' => $this->request->getPost('asal_instansi'),
            'no_telepon'    => $this->request->getPost('no_telepon'),
            'email'         => $this->request->getPost('email'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tgl_masuk'     => $this->request->getPost('tgl_masuk'),
            'tgl_keluar'    => $this->request->getPost('tgl_keluar'),
            'status'        => $this->request->getPost('status'),
            'keterangan'    => $this->request->getPost('keterangan'),
        ];

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Hapus foto lama jika ada
            if ($siswa['foto'] && file_exists(FCPATH . 'assets/img/user/' . $siswa['foto'])) {
                unlink(FCPATH . 'assets/img/user/' . $siswa['foto']);
            }

            $newName = $foto->getRandomName();
            $foto->move(FCPATH . 'assets/img/user', $newName);
            $data['foto'] = $newName;
        }

        $this->siswaModel->update($id_siswa, $data);
        return redirect()->to('/siswa')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function delete($id_siswa)
    {
        $this->siswaModel->delete($id_siswa);
        return redirect()->to(route_to('siswa'))->with('success', 'Data berhasil dihapus');
    }

    public function detail($id_siswa)
    {
        $data = [
            'siswa' => $this->siswaModel->find($id_siswa)
        ];

        return view('pages/siswa/detail', $data);
    }
}
