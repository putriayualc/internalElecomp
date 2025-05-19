<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BisnisModel;
use App\Models\DetailKontenModel;
use App\Models\KontenModel;
use App\Models\KontenSosmedModel;
use App\Models\SosmedModel;
use CodeIgniter\HTTP\ResponseInterface;

class KontenController extends BaseController
{

    protected $sosmedModel;
    protected $bisnisModel;
    protected $kontenModel;
    protected $detailKontenModel;
    protected $kontenSosmedModel;

    public function __construct()
    {
        $this->sosmedModel = new SosmedModel();
        $this->bisnisModel = new BisnisModel();
        $this->kontenModel = new KontenModel();
        $this->detailKontenModel = new DetailKontenModel();
        $this->kontenSosmedModel = new KontenSosmedModel();
    }

    public function index($id_bisnis = null)
    {
        $allBisnis = $this->bisnisModel->findAll();
        $platformParam = $this->request->getGet('platform'); // ambil dari query string, contoh: "ig,fb"
        $selectedPlatforms = $platformParam ? explode(',', $platformParam) : [];

        if (!empty($id_bisnis)) {
            $allKonten = $this->kontenModel->getKontenWithPlatforms($id_bisnis);
        } else {
            $allKonten = $this->kontenModel->getKontenWithPlatforms();
        }

        // Filtering platform jika dipilih
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

        // Format ulang platform dan akun_platform
        foreach ($allKonten as &$konten) {
            $konten['platforms'] = explode(',', $konten['platforms'] ?? '');
            $konten['akun_platform'] = explode(',', $konten['akun_platform'] ?? '');
        }

        $data = [
            'allKonten'      => $allKonten,
            'allBisnis'      => $allBisnis,
            'id_bisnis'      => $id_bisnis,
            'platformFilter' => $platformParam // untuk ditampilkan di view
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
        $id_user = 1;

        if (!empty($id_sosmed_list)) {
            foreach ($id_sosmed_list as $id_sosmed) {
                $this->kontenSosmedModel->save([
                    'id_sosmed' => $id_sosmed,
                    'id_konten' => $id_konten,
                    'id_user' => $id_user,
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
        $sosmed = $this->sosmedModel
            ->where('id_bisnis', $id_bisnis)
            ->where('status', 'aktif')
            ->findAll();

        return $this->response->setJSON($sosmed);
    }

    public function delete($id_konten)
    {
        $this->kontenModel->delete($id_konten);
        return redirect()->to(route_to('konten'))->with('success', 'Data berhasil dihapus.');
    }
}
