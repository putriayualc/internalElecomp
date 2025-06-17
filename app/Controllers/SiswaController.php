<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class SiswaController extends BaseController
{
    protected $siswaModel;
    protected $userModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->userModel = new UsersModel();
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
        $sosmedModel = new \App\Models\SosmedSiswaModel();
        $platformList = $sosmedModel->getEnumPlatform();
        $jenisKelaminList = $this->siswaModel->getEnumJenisKelamin();

        return view('pages/siswa/tambah', [
            'platformList' => $platformList,
            'jenisKelaminList' => $jenisKelaminList
        ]);
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

        // TAMBAH USER DULU
        // Pisahkan berdasarkan spasi
        $namaParts = explode(' ', trim($nama));

        // Bersihkan karakter selain huruf/angka dan ubah ke huruf kecil
        $usn = strtolower(preg_replace('/[^a-z0-9]/i', '', $namaParts[0] . ($namaParts[1] ?? '')));

        $userData = [
            'username' => $usn,
            'password' => password_hash('12345', PASSWORD_DEFAULT),
            'role'     => 'user',
        ];

        if (!$this->userModel->insert($userData)) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }
        // Ambil ID user yang baru disimpan
        $id_user = $this->userModel->getInsertID();

        // Hitung status otomatis berdasarkan tanggal masuk dan keluar
        $today = date('Y-m-d');

        if ($tglMasuk > $today) {
            $status = 'NonAktif';
        } elseif ($tglKeluar < $today) {
            $status = 'Selesai';
        } else {
            $status = 'Aktif';
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
            'id_user'       => $id_user
        ];

        // Simpan data ke database
        $siswaModel = new SiswaModel();
        $siswaModel->save($data);

        // Ambil ID siswa yang baru disimpan
        $id_siswa = $siswaModel->getInsertID();

        // Simpan data sosial media siswa (jika ada)
        $sosmedList = $this->request->getPost('sosmed');
        $sosmedModel = new \App\Models\SosmedSiswaModel();

        if ($sosmedList && is_array($sosmedList)) {
            // Hapus data lama dulu (jika ingin full replace)
            $sosmedModel->where('id_siswa', $id_siswa)->delete();

            foreach ($sosmedList as $sosmed) {
                $platform = strtolower(trim($sosmed['platform']));
                $input    = trim($sosmed['username_sosmed']);

                // Deteksi apakah input adalah link valid
                $link = filter_var($input, FILTER_VALIDATE_URL)
                    ? $input
                    : match ($platform) {
                        'instagram' => 'https://instagram.com/' . ltrim($input, '@'),
                        'facebook'  => 'https://facebook.com/' . ltrim($input, '@'),
                        'linkedin'  => 'https://linkedin.com/in/' . ltrim($input, '@'),
                        'tiktok'    => 'https://tiktok.com/@' . ltrim($input, '@'),
                        default     => '#',
                    };

                $sosmedModel->save([
                    'id_siswa'        => $id_siswa,
                    'platform'        => $platform,
                    'username_sosmed' => $input,
                    'link'            => $link,
                ]);
            }
        }


        // Redirect dengan pesan sukses
        return redirect()->to('siswa')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit($id_siswa)
    {
        $siswa = $this->siswaModel->find($id_siswa);
        if (!$siswa) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data siswa tidak ditemukan.');
        }

        $sosmedModel = new \App\Models\SosmedSiswaModel();
        $platformList = $sosmedModel->getEnumPlatform();

        $sosmed = $sosmedModel->where('id_siswa', $id_siswa)->findAll();

        $jenisKelaminList = $this->siswaModel->getEnumJenisKelamin();

        return view('pages/siswa/edit', [
            'siswa' => $siswa,
            'sosmed' => $sosmed,
            'platformList' => $platformList,
            'jenisKelaminList' => $jenisKelaminList
        ]);
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

        // Hitung status otomatis berdasarkan tanggal masuk dan keluar
        $today = date('Y-m-d');

        if ($data['tgl_masuk'] > $today) {
            $data['status'] = 'NonAktif';
        } elseif ($data['tgl_keluar'] < $today) {
            $data['status'] = 'Selesai';
        } else {
            $data['status'] = 'Aktif';
        }


        $this->siswaModel->update($id_siswa, $data);


        // ============================
        // Tambahkan logika update sosmed
        // ============================
        $sosmedModel = new \App\Models\SosmedSiswaModel();
        $sosmedList  = $this->request->getPost('sosmed');

        if ($sosmedList && is_array($sosmedList)) {
            // Hapus semua data sosmed lama
            $sosmedModel->where('id_siswa', $id_siswa)->delete();

            foreach ($sosmedList as $sosmed) {
                $platform = strtolower(trim($sosmed['platform']));
                $input    = trim($sosmed['username_sosmed']);

                // Deteksi apakah input adalah link
                $link = filter_var($input, FILTER_VALIDATE_URL)
                    ? $input
                    : match ($platform) {
                        'instagram' => 'https://instagram.com/' . ltrim($input, '@'),
                        'facebook'  => 'https://facebook.com/' . ltrim($input, '@'),
                        'linkedin'  => 'https://linkedin.com/in/' . ltrim($input, '@'),
                        'tiktok'    => 'https://tiktok.com/@' . ltrim($input, '@'),
                        default     => '#',
                    };

                $sosmedModel->insert([
                    'id_siswa'        => $id_siswa,
                    'platform'        => $platform,
                    'username_sosmed' => $input,
                    'link'            => $link,
                ]);
            }
        }

        return redirect()->to('siswa')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function delete($id_siswa)
    {
        $siswa = $this->siswaModel->find($id_siswa);
        // $this->siswaModel->delete($id_siswa);
        $this->userModel->delete($siswa['id_user']);
        return redirect()->to(route_to('siswa'))->with('success', 'Data berhasil dihapus');
    }

    public function detail($id_siswa)
    {
        // $sosmedModel = new \App\Models\SosmedSiswaModel();

        // $data = [
        //     'siswa'  => $this->siswaModel->find($id_siswa),
        //     'sosmed' => $sosmedModel->where('id_siswa', $id_siswa)->findAll()
        // ];


        // return view('pages/siswa/detail', $data);


        $sosmedModel = new \App\Models\SosmedSiswaModel();
        $userModel = new \App\Models\UsersModel();

        // Ambil data siswa
        $siswa = $this->siswaModel->find($id_siswa);

        if (!$siswa) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Siswa tidak ditemukan.');
        }

        // Ambil username dari tabel user berdasarkan id_user
        $username = $userModel->where('id_user', $siswa['id_user'])->select('username')->first();

        $data = [
            'siswa'   => $siswa,
            'username' => $username['username'] ?? '-', // fallback kalau tidak ditemukan
            'sosmed'  => $sosmedModel->where('id_siswa', $id_siswa)->findAll(),
        ];

        return view('pages/siswa/detail', $data);
    }
}
