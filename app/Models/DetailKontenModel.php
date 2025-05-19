<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailKontenModel extends Model
{
    protected $table            = 'tb_detail_konten';
    protected $primaryKey       = 'id_detail_konten';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_konten',
        'media',
        'tipe_media'
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

    // Validation rules
    protected $validationRules = [
        'id_konten'  => 'required|integer',
        'media'      => 'required|string|max_length[255]',
        'tipe_media' => 'required|in_list[foto,video]'
    ];

    protected $validationMessages = [
        'id_konten' => [
            'required' => 'ID konten harus diisi.',
            'integer'  => 'ID konten harus berupa angka.'
        ],
        'media' => [
            'required'   => 'Nama media harus diisi.',
            'max_length' => 'Nama media maksimal 255 karakter.'
        ],
        'tipe_media' => [
            'required' => 'Tipe media harus diisi.',
            'in_list'  => 'Tipe media harus berupa foto atau video.'
        ],
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
