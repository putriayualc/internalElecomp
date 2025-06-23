<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DetailProspekModel;
use App\Models\ProspekModel;

class DetailProspekController extends BaseController
{
    protected $detailProspekModel;
    protected $prospekModel;

    public function __construct()
    {
        $this->detailProspekModel = new DetailProspekModel();
        $this->prospekModel = new ProspekModel();
    }

    // Method untuk menampilkan halaman detail prospek
    public function index($id_prospek)
    {
        // Ambil data prospek
        $prospek = $this->prospekModel->find($id_prospek);
        if (!$prospek) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Prospek tidak ditemukan');
        }

        // Ambil detail perusahaan dalam prospek
        $detail_prospek = $this->detailProspekModel->getDetailByProspekId($id_prospek);

        $data = [
            'title' => 'Detail Prospek: ' . $prospek['judul'],
            'prospek' => $prospek,
            'detail_prospek' => $detail_prospek
        ];

        return view('prospek/detail', $data);
    }

    // Method untuk mengambil detail prospek berdasarkan ID prospek (untuk AJAX)
    public function getByProspek($id_prospek)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Invalid request method'
            ]);
        }

        try {
            $detail_prospek = $this->detailProspekModel->where('id_prospek', $id_prospek)->findAll();

            return $this->response->setJSON($detail_prospek);
        } catch (\Exception $e) {
            log_message('error', 'Error getting detail prospek: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan server'
            ]);
        }
    }

    public function store($id_prospek)
    {
        log_message('debug', 'Data received: ' . print_r($this->request->getPost(), true));
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Validasi input
        $validation = \Config\Services::validation();
        $rules = [
            'nama_perusahaan' => 'required|min_length[2]|max_length[255]',
            'email' => 'permit_empty|valid_email',
            'alamat' => 'permit_empty',
            'no_hp' => 'permit_empty|min_length[10]|max_length[15]',
            'no_telepon' => 'permit_empty|min_length[7]|max_length[15]',
            'website' => 'permit_empty|valid_url',
            'tanggal' => 'permit_empty|valid_date',
            'keterangan_lainnya' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors(),
                'message' => 'Validasi gagal'
            ]);
        }

        try {
            $data = [
                'id_prospek' => $id_prospek,
                'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
                'alamat' => $this->request->getPost('alamat') ?? '',
                'email' => $this->request->getPost('email') ?? '',
                'no_hp' => $this->request->getPost('no_hp') ?? '',
                'no_telepon' => $this->request->getPost('no_telepon') ?? '',
                'website' => $this->request->getPost('website') ?? '',
                'tanggal' => $this->request->getPost('tanggal') ?? date('Y-m-d'),
                'keterangan_lainnya' => $this->request->getPost('keterangan_lainnya') ?? ''
            ];

            $saved = $this->detailProspekModel->insert($data);

            if (!$saved) {
                throw new \RuntimeException('Gagal menyimpan data');
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error in store: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function update($id)
    {
        // Cek apakah request adalah AJAX
        if (!$this->request->isAJAX()) {
            return redirect()->back()->with('error', 'Method not allowed');
        }

        $validation = \Config\Services::validation();

        $rules = [
            'nama_perusahaan' => [
                'rules' => 'required|min_length[2]|max_length[255]',
                'errors' => [
                    'required' => 'Nama perusahaan harus diisi',
                    'min_length' => 'Nama perusahaan minimal 2 karakter',
                    'max_length' => 'Nama perusahaan maksimal 255 karakter'
                ]
            ],
            'email' => [
                'rules' => 'permit_empty|valid_email',
                'errors' => [
                    'valid_email' => 'Format email tidak valid'
                ]
            ],
            'website' => [
                'rules' => 'permit_empty|valid_url',
                'errors' => [
                    'valid_url' => 'Format website tidak valid'
                ]
            ],
            'no_hp' => [
                'rules' => 'permit_empty|min_length[10]|max_length[15]',
                'errors' => [
                    'min_length' => 'No HP minimal 10 digit',
                    'max_length' => 'No HP maksimal 15 digit'
                ]
            ],
            'no_telepon' => [
                'rules' => 'permit_empty|min_length[7]|max_length[15]',
                'errors' => [
                    'min_length' => 'No Telepon minimal 7 digit',
                    'max_length' => 'No Telepon maksimal 15 digit'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        $detail = $this->detailProspekModel->find($id);
        if (!$detail) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data perusahaan tidak ditemukan'
            ]);
        }

        $data = [
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'alamat' => $this->request->getPost('alamat') ?: '',
            'no_hp' => $this->request->getPost('no_hp') ?: '',
            'no_telepon' => $this->request->getPost('no_telepon') ?: '',
            'email' => $this->request->getPost('email') ?: '',
            'website' => $this->request->getPost('website') ?: '',
            'tanggal' => $this->request->getPost('tanggal') ?: date('Y-m-d'),
            'keterangan_lainnya' => $this->request->getPost('keterangan_lainnya') ?: ''
        ];

        try {
            $result = $this->detailProspekModel->update($id, $data);
            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Data perusahaan berhasil diperbarui!'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui data perusahaan'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error updating detail prospek: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server: ' . $e->getMessage()
            ]);
        }
    }

    // app/Controllers/DetailProspekController.php

    // app/Controllers/DetailProspekController.php

    public function delete($id_prospek, $id)
    {
        // Langsung coba hapus, karena kita tahu methodnya PASTI POST dari form.
        // Jika ada masalah (bukan dari DB), itu pasti dari Model.

        if ($this->detailProspekModel->delete($id)) {
            // Jika delete() di model berhasil (mengembalikan true)
            return redirect()->to('prospek/detail/' . $id_prospek)
                ->with('success', 'Data perusahaan berhasil dihapus!');
        }

        // Jika delete() di model gagal (mengembalikan false)
        // Ini kemungkinan besar karena ada event $beforeDelete di model yang membatalkan.
        return redirect()->to('prospek/detail/' . $id_prospek)
            ->with('error', 'Gagal menghapus data. Proses dibatalkan oleh Model. Silakan periksa event "beforeDelete" di file DetailProspekModel.php');
    }
    public function getDetail($id)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->to('prospek');
        }

        $detail = $this->detailProspekModel->find($id);

        if (!$detail) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data perusahaan tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $detail
        ]);
    }

    public function import($id_prospek)
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'import_file' => [
                'rules' => 'uploaded[import_file]|ext_in[import_file,xlsx,xls]|max_size[import_file,2048]',
                'errors' => [
                    'uploaded' => 'Harus memilih file Excel',
                    'ext_in' => 'Format file harus .xlsx atau .xls',
                    'max_size' => 'Ukuran file maksimal 2MB'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        $file = $this->request->getFile('import_file');
        $overwrite = $this->request->getPost('overwrite_data') == 'on';

        try {
            // Load file Excel
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getTempName());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            // Hapus header
            array_shift($rows);

            // Jika opsi overwrite dipilih, hapus data lama
            if ($overwrite) {
                $this->detailProspekModel->where('id_prospek', $id_prospek)->delete();
            }

            // Proses setiap baris data
            $imported = 0;
            foreach ($rows as $row) {
                // Skip baris kosong
                if (empty(array_filter($row))) continue;

                $data = [
                    'id_prospek' => $id_prospek,
                    'nama_perusahaan' => $row[0] ?? null,
                    'alamat' => $row[1] ?? null,
                    'email' => $row[2] ?? null,
                    'no_hp' => $row[3] ?? null,
                    'website' => $row[4] ?? null,
                    'keterangan_lainnya' => $row[5] ?? null,
                    'tanggal' => $row[6] ?? date('Y-m-d'),
                    'status_email' => 'Belum',
                    'status_wa' => 'Belum',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                // Simpan ke database
                $this->detailProspekModel->insert($data);
                $imported++;
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => "Berhasil mengimpor $imported data perusahaan"
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses file: ' . $e->getMessage()
            ]);
        }
    }
}
