<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BisnisModel;
use App\Models\DetailKontenModel;
use App\Models\KontenModel;
use App\Models\KontenSosmedModel;
use App\Models\SosmedModel;
use App\Models\UserSosmedModel;
use CodeIgniter\HTTP\ResponseInterface;

class KontenController extends BaseController
{

    protected $sosmedModel;
    protected $bisnisModel;
    protected $kontenModel;
    protected $detailKontenModel;
    protected $kontenSosmedModel;
    protected $userSosmedModel;

    public function __construct()
    {
        $this->sosmedModel = new SosmedModel();
        $this->bisnisModel = new BisnisModel();
        $this->kontenModel = new KontenModel();
        $this->detailKontenModel = new DetailKontenModel();
        $this->kontenSosmedModel = new KontenSosmedModel();
        $this->userSosmedModel = new UserSosmedModel();
    }

    public function index($id_bisnis = null)
    {
        $id_user = session()->get('id_user');

        $idSosmedUser = $this->userSosmedModel->getSosmedIdsByUser($id_user);

        $allBisnis = $this->bisnisModel->findAll();
        $platformParam = $this->request->getGet('platform');
        $selectedPlatforms = $platformParam ? explode(',', $platformParam) : [];

        $allKonten = $id_bisnis
            ? $this->kontenModel->getKontenWithPlatforms($id_bisnis)
            : $this->kontenModel->getKontenWithPlatforms();

        // Hanya tampilkan konten milik akun sosmed user login
        if (session()->get('role') !== 'admin') {
            $allKonten = array_filter($allKonten, function ($konten) use ($idSosmedUser) {
                $kontenSosmedIds = explode(',', $konten['id_sosmed'] ?? '');
                foreach ($kontenSosmedIds as $id) {
                    if (in_array($id, $idSosmedUser)) {
                        return true;
                    }
                }
                return false;
            });
        }

        if (!empty($selectedPlatforms)) {
            $allKonten = array_filter($allKonten, function ($konten) use ($selectedPlatforms) {
                $kontenPlatforms = explode(',', $konten['platforms'] ?? '');
                foreach ($selectedPlatforms as $plat) {
                    if (in_array($plat, $kontenPlatforms)) {
                        return true;
                    }
                }
                return false;
            });
        }

        foreach ($allKonten as &$konten) {
            $konten['platforms'] = explode(',', $konten['platforms'] ?? '');
            $konten['akun_platform'] = explode(',', $konten['akun_platform'] ?? '');
        }

        $data = [
            'allKonten'      => $allKonten,
            'allBisnis'      => $allBisnis,
            'id_bisnis'      => $id_bisnis,
            'platformFilter' => $platformParam
        ];

        return view('pages/konten_sosmed/index', $data);
    }

    public function tambah()
    {
        $allBisnis = $this->bisnisModel->findAll();
        $data = [
            'allBisnis' => $allBisnis,
        ];
        return view('pages/konten_sosmed/tambah', $data);
    }

    public function simpan()
    {
        // Ambil data dari form
        $data['judul'] = $this->request->getPost('judul');
        $data['caption'] = $this->request->getPost('caption');
        $data['tgl_upload'] = $this->request->getPost('tgl_upload');

        // Tangani upload cover
        // Validasi file cover secara manual sebelum save model
        $cover = $this->request->getFile('cover');
        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            // Cek tipe file dan ukuran manual
            if (!in_array($cover->getExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                return redirect()->back()->with('error', 'Format file cover tidak didukung')->withInput();
            }
            if ($cover->getSize() > 2048 * 1024) {
                return redirect()->back()->with('error', 'Ukuran file cover maksimal 2MB')->withInput();
            }
            $nama_cover = $cover->getRandomName();
            $cover->move('assets/sosmed/cover', $nama_cover);
            $data['cover'] = $nama_cover;
        }

        // dd($data);

        if (!$this->kontenModel->save($data)) {
            // Ambil error validasi
            $errors = $this->kontenModel->errors();

            return redirect()->back()
                ->with('error', 'Gagal menyimpan konten.')
                ->with('validation', $errors)
                ->withInput();
        }

        $id_konten = $this->kontenModel->insertID();

        // Simpan ke kontenSosmedModel
        $id_sosmed_list = $this->request->getPost('id_sosmed');
        $tgl_upload = $this->request->getPost('tgl_upload');

        if (!empty($id_sosmed_list)) {
            foreach ($id_sosmed_list as $id_sosmed) {
                $this->kontenSosmedModel->save([
                    'id_sosmed' => $id_sosmed,
                    'id_konten' => $id_konten,
                    'tgl_upload' => $tgl_upload
                ]);
            }
        }

        $konten_files = $this->request->getFileMultiple('konten_file');
        // dd($konten_files);

        if ($konten_files) {
            foreach ($konten_files as $konten_file) {
                // Validasi manual
                if (!$konten_file->isValid()) {
                    return redirect()->back()
                        ->with('error', 'Salah satu file tidak valid.')
                        ->withInput();
                }

                // Validasi ekstensi
                $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'video/mp4', 'video/mpeg'];
                if (!in_array($konten_file->getClientMimeType(), $allowedTypes)) {
                    return redirect()->back()
                        ->with('error', 'Tipe file tidak didukung (hanya gambar/video).')
                        ->withInput();
                }

                // Validasi ukuran (misal maksimal 5MB)
                if ($konten_file->getSize() > 5 * 1024 * 1024) {
                    return redirect()->back()
                        ->with('error', 'Ukuran file terlalu besar. Maksimal 5MB.')
                        ->withInput();
                }

                // Tentukan tipe media berdasarkan MIME type
                $tipe_media = (strpos($konten_file->getClientMimeType(), 'image') !== false) ? 'foto' : 'video';

                // Simpan file
                $nama_file = $konten_file->getRandomName();
                $konten_file->move('assets/sosmed/konten', $nama_file);

                // Simpan ke database
                if (!$this->detailKontenModel->save([
                    'id_konten' => $id_konten,
                    'media' => $nama_file,
                    'tipe_media' => $tipe_media
                ])) {
                    $errors = $this->detailKontenModel->errors();
                    return redirect()->back()
                        ->with('error', 'Gagal menyimpan media.')
                        ->with('validation', $errors)
                        ->withInput();
                }
            }
        }


        return redirect()->to(route_to('konten'))->with('success', 'Konten sosial media berhasil ditambahkan.');
    }

    public function getByBisnis($id_bisnis)
    {
        $id_user = session()->get('id_user');
        $role = session()->get('role');

        if ($role === 'admin') {
            // Admin bisa melihat semua sosmed dari bisnis tersebut
            $sosmed = $this->sosmedModel
                ->where('id_bisnis', $id_bisnis)
                ->findAll();
        } else {
            // User hanya bisa melihat sosmed miliknya (melalui relasi)
            $idSosmedUser = $this->userSosmedModel->getSosmedIdsByUser($id_user);

            // Ambil sosmed dari bisnis tersebut yang juga dimiliki user
            if (!empty($idSosmedUser)) {
                $sosmed = $this->sosmedModel
                    ->where('id_bisnis', $id_bisnis)
                    ->whereIn('id_sosmed', $idSosmedUser)
                    ->findAll();
            } else {
                $sosmed = []; // tidak punya akses ke sosmed manapun
            }
        }

        return $this->response->setJSON($sosmed);
    }

    public function delete($id_konten)
    {
        $this->kontenModel->delete($id_konten);
        return redirect()->to(route_to('konten'))->with('success', 'Data berhasil dihapus.');
    }

    // Halaman Edit
    public function edit($id_konten)
    {
        $konten = $this->kontenModel->find($id_konten);
        if (!$konten) {
            return redirect()->back()->with('error', 'Data konten tidak ditemukan.');
        }

        $allBisnis = $this->bisnisModel->findAll();

        // Ambil sosmed yang sudah dipilih sebelumnya
        $selectedSosmedRaw = $this->kontenSosmedModel->getSosmedByKonten($id_konten);
        $selectedSosmed = array_column($selectedSosmedRaw, 'id_sosmed');

        // Ambil file konten yang sudah diupload
        $kontenFiles = $this->detailKontenModel->where('id_konten', $id_konten)->findAll();

        // Ambil id_bisnis dari salah satu id_sosmed yang dipilih
        $selectedBisnis = null;
        if (!empty($selectedSosmed)) {
            $selectedBisnis = $selectedSosmedRaw[0]['id_bisnis'] ?? null;
        }

        return view('pages/konten_sosmed/edit', [
            'konten' => $konten,
            'allBisnis' => $allBisnis,
            'selectedSosmed' => $selectedSosmed,
            'kontenFiles' => $kontenFiles,
            'selectedBisnis' => $selectedBisnis
        ]);
    }

    public function update($id_konten)
    {
        // Ambil data lama konten
        $konten = $this->kontenModel->find($id_konten);
        if (!$konten) {
            return redirect()->route('konten')->with('error', 'Konten tidak ditemukan.');
        }

        // Handle cover (jika diunggah)
        $coverFile = $this->request->getFile('cover');
        $coverName = $konten['cover'];

        if ($coverFile && $coverFile->isValid() && !$coverFile->hasMoved()) {
            $coverName = $coverFile->getRandomName();
            $coverFile->move('assets/sosmed/cover', $coverName);

            // Hapus file lama
            if (!empty($konten['cover']) && file_exists('assets/sosmed/cover/' . $konten['cover'])) {
                unlink('assets/sosmed/cover/' . $konten['cover']);
            }
        }

        // Data utama konten yang akan diupdate
        $dataUpdate = [
            'judul'      => $this->request->getPost('judul'),
            'caption'    => $this->request->getPost('caption'),
            'cover'      => $coverName,
            'tgl_upload' => $this->request->getPost('tgl_upload'),
        ];

        // Simpan menggunakan model, validasi otomatis di model
        if (!$this->kontenModel->update($id_konten, $dataUpdate)) {
            return redirect()->back()
                ->withInput()
                ->with('validation', $this->kontenModel->errors());
        }

        // Update relasi platform sosial media
        $this->kontenSosmedModel->where('id_konten', $id_konten)->delete();

        $idSosmeds = $this->request->getPost('id_sosmed') ?? [];
        foreach ($idSosmeds as $idSosmed) {
            $this->kontenSosmedModel->insert([
                'id_konten' => $id_konten,
                'id_sosmed' => $idSosmed,
            ]);
        }

        // Handle file konten (gambar/video)
        $kontenFiles = $this->request->getFiles();
        if (isset($kontenFiles['konten_file'])) {
            foreach ($kontenFiles['konten_file'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $fileName = $file->getRandomName();
                    $file->move('assets/sosmed/konten', $fileName);

                    $this->detailKontenModel->insert([
                        'id_konten' => $id_konten,
                        'media'     => $fileName,
                    ]);
                }
            }
        }

        return redirect()->route('konten.index')->with('success', 'Konten berhasil diperbarui.');
    }
}
