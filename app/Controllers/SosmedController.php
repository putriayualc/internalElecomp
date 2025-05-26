<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BisnisModel;
use App\Models\SosmedModel;
use App\Models\UsersModel;
use App\Models\UserSosmedModel;
use CodeIgniter\HTTP\ResponseInterface;

class SosmedController extends BaseController
{
    protected $sosmedModel;
    protected $bisnisModel;
    protected $userSosmedModel;
    protected $usersModel;

    public function __construct()
    {
        $this->sosmedModel = new SosmedModel();
        $this->bisnisModel = new BisnisModel();
        $this->userSosmedModel = new UserSosmedModel();
        $this->usersModel = new UsersModel();
    }

    public function index($id_bisnis = null)
    {
        $allSosmed = $this->sosmedModel->getSosmedWithJumlahKonten();
        $allBisnis = $this->bisnisModel->findAll();
        $allUserSosmed = $this->userSosmedModel->getSosmedWithUserInfo();

        if (!empty($id_bisnis) && $id_bisnis) {
            $allSosmed = $this->sosmedModel->getSosmedWithJumlahKonten($id_bisnis);
        } else {
            $allSosmed = $this->sosmedModel->getSosmedWithJumlahKonten();
        }
        // dd($allBisnis);
        $data = [
            'allSosmed' => $allSosmed,
            'allBisnis' => $allBisnis,
            'id_bisnis' => $id_bisnis,
            'allUserSosmed' => $allUserSosmed
        ];
        // dd($data);

        return view('pages/sosmed/index', $data);
    }

    public function tambah()
    {
        $allBisnis = $this->bisnisModel->findAll();
        $allUser = $this->usersModel->getUsersWithNamaSiswa();
        $data = [
            'allUsers' => $allUser,
            'allBisnis' => $allBisnis,
        ];
        // dd($data);
        return view('pages/sosmed/tambah', $data);
    }

    public function simpan()
    {
        $postData = $this->request->getPost();

        // Siapkan data untuk tb_sosmed
        $sosmedData = [
            'username'   => $postData['username'],
            'platform'   => $postData['platform'],
            'id_bisnis'  => $postData['id_bisnis'],
            'updated_at' => date('Y-m-d'),
        ];

        // Simpan ke tb_sosmed
        if (!$this->sosmedModel->save($sosmedData)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $this->sosmedModel->errors()));
        }

        // Ambil ID sosmed terakhir yang disimpan
        $idSosmed = $this->sosmedModel->getInsertID();

        if (isset($postData['id_user']) && is_array($postData['id_user'])) {
            foreach ($postData['id_user'] as $idUser) {
                if (!empty($idUser)) {
                    $this->userSosmedModel->insert([
                        'id_sosmed' => $idSosmed,
                        'id_user'   => $idUser,
                    ]);
                }
            }
        }

        return redirect()->to(route_to('sosmed'))
            ->with('success', 'Akun sosial media dan user pengelola berhasil ditambahkan.');
    }


    public function delete($id_sosmed)
    {
        $this->sosmedModel->delete($id_sosmed);
        return redirect()->to(route_to('sosmed'))->with('success', 'Data berhasil dihapus.');
    }

    public function edit($id_sosmed)
    {
        $sosmed = $this->sosmedModel->find($id_sosmed);
        if (!$sosmed) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $allUsers = $this->usersModel->getUsersWithNamaSiswa();
        $allBisnis = $this->bisnisModel->findAll();
        $selectedUsers = $this->userSosmedModel
            ->where('id_sosmed', $id_sosmed)
            ->findColumn('id_user');

        return view('pages/sosmed/edit', [
            'sosmed' => $sosmed,
            'allUsers' => $allUsers,
            'allBisnis' => $allBisnis,
            'selectedUsers' => $selectedUsers ?? []
        ]);
    }

    public function update($id_sosmed)
    {
        $data = $this->request->getPost([
            'username',
            'id_bisnis',
            'platform'
        ]);

        $data['updated_at'] = date('Y-m-d');

        if (!$this->sosmedModel->validate($data)) {
            return redirect()->back()->withInput()->with('error', $this->sosmedModel->errors());
        };

        $this->sosmedModel->update($id_sosmed, $data);

        // Update relasi user-sosmed
        $this->userSosmedModel->where('id_sosmed', $id_sosmed)->delete();

        $idUsers = $this->request->getPost('id_user');
        if ($idUsers) {
            foreach ($idUsers as $idUser) {
                $this->userSosmedModel->insert([
                    'id_sosmed' => $id_sosmed,
                    'id_user' => $idUser
                ]);
            }
        }

        return redirect()->route('sosmed')->with('success', 'Data berhasil diperbarui');
    }
}
