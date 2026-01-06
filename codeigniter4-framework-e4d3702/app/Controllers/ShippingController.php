<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class ShippingController extends ResourceController
{
    public function create()
    {
        // Ambil data dari body JSON
        $data = $this->request->getJSON();

        // Proses simpan ke database atau generate shipping_id
        // Untuk contoh, kita hardcode dulu
        $shippingId = 'SHP001';
        $status = 'IN_DELIVERY';
        $estimatedDays = 3;

        return $this->respond([
            'shipping_id' => $shippingId,
            'status' => $status,
            'estimated_days' => $estimatedDays
        ]);
    }

    public function status($order_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('shippings');

        $shipping = $builder->where('order_id', $order_id)->get()->getRow();

        if (!$shipping) {
            return $this->respond([
                'status' => 'error',
                'message' => 'Data shipping tidak ditemukan'
            ], 404);
        }

        return $this->respond([
            'status' => 'success',
            'data' => [
                'order_id' => $shipping->order_id,
                'shipping_status' => $shipping->status,
                'cost' => $shipping->cost,
                'estimated_days' => $shipping->estimated_days
            ]
        ]);
    }

}
