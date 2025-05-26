<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $table            = 'tb_blog';
    protected $primaryKey       = 'id_blog';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_email',
        'domain_blog'
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
    protected $validationRules      = [];
    protected $validationMessages   = [];
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

    public function getAllBlogWithCountArticle($id_user = null)
    {
        $builder = $this->select(
            'tb_blog.*, ' .
                'COUNT(tb_artikel.id_artikel) AS jumlah_artikel'
        )
            ->join('tb_artikel', 'tb_blog.id_blog = tb_artikel.id_blog', 'left')
            ->join('tb_email', 'tb_blog.id_email = tb_email.id_email', 'left')
            ->groupBy('tb_blog.id_blog');

        if ($id_user !== null) {
            $builder->where('tb_email.id_user', $id_user);
        }

        return $builder->findAll();
    }
}
