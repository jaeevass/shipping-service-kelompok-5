<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateShippingTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'order_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
            'recipient_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'recipient_address' => [
                'type' => 'TEXT',
            ],
            'recipient_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'courier_service' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'shipping_cost' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'weight' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'processing', 'shipped', 'in_transit', 'delivered', 'cancelled'],
                'default'    => 'pending',
            ],
            'tracking_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'estimated_delivery' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addKey('order_id');
        $this->forge->createTable('shipping');
    }

    public function down()
    {
        $this->forge->dropTable('shipping');
    }
}
