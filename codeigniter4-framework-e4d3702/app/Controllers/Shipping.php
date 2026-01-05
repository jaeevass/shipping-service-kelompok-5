<?php

namespace App\Controllers;

use App\Models\ShippingModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Shipping extends ResourceController
{
    protected $modelName = 'App\Models\ShippingModel';
    protected $format    = 'json';

    /**
     * Create a new shipping data
     * POST /api/shipping/create
     *
     * @return ResponseInterface
     */
    public function create()
    {
        try {
            $rules = [
                'order_id'          => 'required|max_length[100]',
                'recipient_name'    => 'required|max_length[255]',
                'recipient_address' => 'required',
                'recipient_phone'   => 'required|max_length[20]',
                'courier_service'   => 'required|max_length[50]',
                'shipping_cost'     => 'required|decimal',
                'weight'            => 'required|decimal',
            ];

            if (!$this->validate($rules)) {
                return $this->failValidationErrors($this->validator->getErrors());
            }

            $data = [
                'order_id'          => $this->request->getPost('order_id'),
                'recipient_name'    => $this->request->getPost('recipient_name'),
                'recipient_address' => $this->request->getPost('recipient_address'),
                'recipient_phone'   => $this->request->getPost('recipient_phone'),
                'courier_service'   => $this->request->getPost('courier_service'),
                'shipping_cost'     => $this->request->getPost('shipping_cost'),
                'weight'            => $this->request->getPost('weight'),
                'status'            => 'pending',
                'tracking_number'   => $this->generateTrackingNumber(),
                'estimated_delivery' => $this->calculateEstimatedDelivery(),
            ];

            $model = new ShippingModel();
            
            // Check if order_id already exists
            if ($model->where('order_id', $data['order_id'])->first()) {
                return $this->fail('Order ID already exists', 400);
            }

            $id = $model->insert($data);

            if ($id === false) {
                return $this->failServerError('Failed to create shipping data');
            }

            $shipping = $model->find($id);

            return $this->respondCreated([
                'status' => 'success',
                'message' => 'Shipping data created successfully',
                'data' => $shipping
            ]);

        } catch (\Exception $e) {
            return $this->failServerError('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Get shipping status by order_id
     * GET /api/shipping/status/{order_id}
     *
     * @param string|null $order_id
     * @return ResponseInterface
     */
    public function status($order_id = null)
    {
        try {
            if (empty($order_id)) {
                return $this->failValidationErrors('Order ID is required');
            }

            $model = new ShippingModel();
            $shipping = $model->where('order_id', $order_id)->first();

            if (!$shipping) {
                return $this->failNotFound('Shipping data not found for order ID: ' . $order_id);
            }

            return $this->respond([
                'status' => 'success',
                'message' => 'Shipping data retrieved successfully',
                'data' => $shipping
            ]);

        } catch (\Exception $e) {
            return $this->failServerError('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Generate a unique tracking number
     *
     * @return string
     */
    private function generateTrackingNumber()
    {
        return 'TRK' . strtoupper(bin2hex(random_bytes(8))) . random_int(1000, 9999);
    }

    /**
     * Calculate estimated delivery date (3-7 days from now)
     *
     * @return string
     */
    private function calculateEstimatedDelivery()
    {
        $days = random_int(3, 7);
        return date('Y-m-d', strtotime("+{$days} days"));
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        try {
            $model = new ShippingModel();
            $shippings = $model->findAll();

            return $this->respond([
                'status' => 'success',
                'message' => 'Shipping data retrieved successfully',
                'data' => $shippings
            ]);

        } catch (\Exception $e) {
            return $this->failServerError('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        try {
            if (empty($id)) {
                return $this->failValidationErrors('ID is required');
            }

            $model = new ShippingModel();
            $shipping = $model->find($id);

            if (!$shipping) {
                return $this->failNotFound('Shipping data not found');
            }

            return $this->respond([
                'status' => 'success',
                'message' => 'Shipping data retrieved successfully',
                'data' => $shipping
            ]);

        } catch (\Exception $e) {
            return $this->failServerError('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        try {
            if (empty($id)) {
                return $this->failValidationErrors('ID is required');
            }

            $model = new ShippingModel();
            $shipping = $model->find($id);

            if (!$shipping) {
                return $this->failNotFound('Shipping data not found');
            }

            $data = $this->request->getJSON(true) ?: $this->request->getPost();

            if (empty($data)) {
                return $this->failValidationErrors('No data provided');
            }

            // Remove fields that shouldn't be updated
            unset($data['id'], $data['order_id'], $data['created_at']);

            if ($model->update($id, $data)) {
                $updatedShipping = $model->find($id);

                return $this->respond([
                    'status' => 'success',
                    'message' => 'Shipping data updated successfully',
                    'data' => $updatedShipping
                ]);
            }

            return $this->failServerError('Failed to update shipping data');

        } catch (\Exception $e) {
            return $this->failServerError('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        try {
            if (empty($id)) {
                return $this->failValidationErrors('ID is required');
            }

            $model = new ShippingModel();
            $shipping = $model->find($id);

            if (!$shipping) {
                return $this->failNotFound('Shipping data not found');
            }

            if ($model->delete($id)) {
                return $this->respondDeleted([
                    'status' => 'success',
                    'message' => 'Shipping data deleted successfully'
                ]);
            }

            return $this->failServerError('Failed to delete shipping data');

        } catch (\Exception $e) {
            return $this->failServerError('An error occurred: ' . $e->getMessage());
        }
    }
}
