<?php

namespace App\Models;

use CodeIgniter\Model;

class ShippingModel extends Model
{
    protected $table            = 'shipping';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'order_id',
        'recipient_name',
        'recipient_address',
        'recipient_phone',
        'courier_service',
        'shipping_cost',
        'weight',
        'status',
        'tracking_number',
        'estimated_delivery'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'order_id'          => 'required|max_length[100]|is_unique[shipping.order_id]',
        'recipient_name'    => 'required|max_length[255]',
        'recipient_address' => 'required',
        'recipient_phone'   => 'required|max_length[20]',
        'courier_service'   => 'required|max_length[50]',
        'shipping_cost'     => 'required|decimal',
        'weight'            => 'required|decimal',
    ];
    protected $validationMessages   = [
        'order_id' => [
            'required' => 'Order ID is required',
            'is_unique' => 'Order ID already exists'
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
