<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table            = 'tb_artikel';
    protected $primaryKey       = 'id_artikel';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_blog',
        'judul_artikel',
        'tgl_upload',
        'link',
        'link_to',
        'link_type',
        'keywords',
        'anchor_text',
        'indexed',
        'jenis'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'judul_artikel' => 'required|alpha_numeric_space|min_length[3]|max_length[255]',
        'tgl_upload'    => 'required|valid_date',
        'link'          => 'required|valid_url',
        'link_to'       => 'permit_empty|valid_url',
        'link_type'     => 'permit_empty|in_list[img,video,naked_url,text]',
        'keywords'      => 'required|string|max_length[255]',
        'anchor_text'   => 'permit_empty|string|max_length[255]',
        'indexed'       => 'required|in_list[sudah,belum]',
        'jenis'         => 'required|string'
    ];

    protected $validationMessages = [
        'judul_artikel' => [
            'required' => 'Judul artikel wajib diisi.',
            'alpha_numeric_space' => 'Judul hanya boleh mengandung huruf, angka, dan spasi.',
            'min_length' => 'Judul minimal 3 karakter.',
            'max_length' => 'Judul maksimal 255 karakter.'
        ],
        'tgl_upload' => [
            'required' => 'Tanggal upload wajib diisi.',
            'valid_date' => 'Format tanggal tidak valid.'
        ],
        'link' => [
            'valid_url' => 'Link harus berupa URL yang valid.'
        ],
        'link_to' => [
            'valid_url' => 'Link To harus berupa URL yang valid.'
        ],
        'link_type' => [
            'in_list' => 'Link type harus berisi "img", "vide", "naked_url" atau "text".'
        ],
        'indexed' => [
            'required' => 'Indexed artikel wajib diisi.',
            'in_list' => 'Indexed harus berisi "sudah" atau "belum".'
        ],
        'jenis' => [
            'required' => 'Jenis artikel wajib diisi.',
            'required' => 'Jenis artikel wajib dipilih.'
        ]
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
