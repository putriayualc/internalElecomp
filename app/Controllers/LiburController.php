<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LiburModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;


class LiburController extends BaseController
{
    protected $liburModel;

    public function __construct()
    {
        $this->liburModel = new LiburModel();
    }

    public function index()
    {
        // Ambil bulan dan tahun dari URL, jika tidak ada, gunakan bulan & tahun saat ini
        $month = $this->request->getGet('month') ?? date('m');
        $year = $this->request->getGet('year') ?? date('Y');

        // Ambil data libur spesifik untuk bulan dan tahun yang dipilih
        $holidays = $this->liburModel->getHolidaysByMonthYear($month, $year);

        // Re-format array agar mudah diakses di view berdasarkan harinya
        $holidaysByDay = [];
        foreach ($holidays as $holiday) {
            $day = (int)date('d', strtotime($holiday['tgl_libur']));
            $holidaysByDay[$day][] = $holiday;
        }

        $data = [
            'title'         => 'Kalender Hari Libur',
            'holidaysByDay' => $holidaysByDay,
            'currentMonth'  => $month,
            'currentYear'   => $year,
        ];

        return view('pages/libur/index', $data); // Arahkan ke file view baru
    }

    public function simpan()
    {
        // 1. Aturan Validasi
        $rules = [
            'keterangan' => [
                'label' => 'Keterangan Libur',
                'rules' => 'required|string|max_length[255]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                    'max_length' => '{field} tidak boleh lebih dari 255 karakter.',
                ],
            ],
            'selected_dates' => [
                'label' => 'Tanggal Libur',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silakan pilih minimal satu tanggal pada kalender.',
                ],
            ],
        ];

        // 2. Lakukan Validasi
        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembali ke halaman sebelumnya dengan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 3. Ambil data dari POST request
        $keterangan = $this->request->getPost('keterangan');
        $selectedDatesStr = $this->request->getPost('selected_dates');

        // 4. Proses data tanggal
        $datesArray = explode(',', $selectedDatesStr);


        // 5. Gunakan Transaksi Database
        // Ini untuk memastikan semua data berhasil disimpan, atau tidak sama sekali.
        // Mencegah data tersimpan sebagian jika terjadi error di tengah jalan.
        $this->liburModel->transStart();

        foreach ($datesArray as $date) {
            // Pastikan format tanggal valid sebelum disimpan
            if (strtotime($date)) {
                $dataToSave = [
                    'tgl_libur'    => trim($date),
                    'keterangan' => $keterangan,
                ];

                // Simpan data menggunakan model
                $this->liburModel->save($dataToSave);
            }
        }

        $this->liburModel->transComplete();

        // 6. Cek status transaksi dan berikan feedback
        if ($this->liburModel->transStatus() === false) {
            // Jika transaksi gagal, berikan pesan error
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan pada database saat menyimpan data.');
        } else {
            // Jika transaksi berhasil, berikan pesan sukses
            $jumlahData = count($datesArray);
            return redirect()->to(base_url('libur'))->with('success', "Berhasil menambahkan {$jumlahData} data hari libur.");
        }
    }

    public function update($id = null)
    {
        // Aturan validasi
        $rules = [
            'tanggal' => 'required|valid_date',
            'keterangan' => 'required|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembali dengan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Siapkan data untuk diupdate
        $data = [
            'tgl_libur'    => $this->request->getVar('tanggal'), // Sesuaikan dengan nama kolom di DB
            'keterangan' => $this->request->getVar('keterangan'),
        ];

        // Lakukan update menggunakan model
        if ($this->liburModel->update($id, $data)) {
            // Jika berhasil, redirect dengan pesan sukses
            return redirect()->to(base_url('libur'))->with('success', 'Data hari libur berhasil diperbarui.');
        } else {
            // Jika gagal, redirect dengan pesan error
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data.');
        }
    }

    public function delete($id = null)
    {
        // Cari data berdasarkan ID, jika tidak ada, tampilkan error 404
        $data = $this->liburModel->find($id);
        if (!$data) {
            throw PageNotFoundException::forPageNotFound('Data libur tidak ditemukan.');
        }

        // Lakukan penghapusan menggunakan model
        if ($this->liburModel->delete($id)) {
            // Jika berhasil, redirect dengan pesan sukses
            return redirect()->to(base_url('libur'))->with('success', 'Data hari libur berhasil dihapus.');
        } else {
            // Jika gagal, redirect dengan pesan error
            return redirect()->to(base_url('libur'))->with('error', 'Gagal menghapus data.');
        }
    }
}
