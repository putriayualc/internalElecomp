<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
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

        $data = $this->siswaModel->where('id_user', session()->get('id_user'))->first();

        return view('pages/profile/index', $data);
    }
    public function update($id)
    {
        $postData = $this->request->getPost();

        $this->siswaModel->update($id, [
            'nama'          => $postData['nama'],
            'jenis_kelamin' => $postData['jenis_kelamin'],
            'alamat'        => $postData['alamat'],
            'no_telepon'    => $postData['no_telepon'],
            'email'         => $postData['email'],
            'jurusan'       => $postData['jurusan'],
            'asal_instansi' => $postData['asal_instansi'],
            'tgl_masuk'     => $postData['tgl_masuk'],
            'tgl_keluar'    => $postData['tgl_keluar'],
            'keterangan'    => $postData['keterangan'],
        ]);

        return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui.');
    }
    public function updatePassword()
    {
        $idUser = session()->get('id_user');

        $currentPassword = $this->request->getPost('current_password');
        $newPassword     = $this->request->getPost('new_password');

        $user = $this->userModel->where('id_user', $idUser)->first();

        if (!password_verify($currentPassword, $user['password'])) {
            return redirect()->back()->with('error', 'Password lama tidak sesuai.');
        }

        $this->userModel->update($user['id_user'], [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/profile')->with('success', 'Password berhasil diperbarui.');
    }
    public function updateFoto()
    {
        $idUser = session()->get('id_user');
        $fotoBaru = $this->request->getFile('foto');

        // Validasi file
        if ($fotoBaru->isValid() && !$fotoBaru->hasMoved()) {
            $dataSiswa = $this->siswaModel->where('id_user', $idUser)->first();

            // Hapus foto lama jika ada dan bukan default
            if (!empty($dataSiswa['foto']) && $dataSiswa['foto'] !== 'default.png') {
                $fotoLamaPath = FCPATH . 'assets/img/user/' . $dataSiswa['foto'];
                if (file_exists($fotoLamaPath)) {
                    unlink($fotoLamaPath);
                }
            }

            // Simpan foto baru
            $newName = $fotoBaru->getRandomName();
            $fotoBaru->move('assets/img/user/', $newName);

            // Update ke database
            $this->siswaModel->where('id_user', $idUser)->set(['foto' => $newName])->update();

            return redirect()->to('/profile')->with('success', 'Foto profil berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah foto.');
    }
}
