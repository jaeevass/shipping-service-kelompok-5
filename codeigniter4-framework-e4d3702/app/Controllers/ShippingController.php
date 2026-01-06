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
}
