<?php

declare(strict_types=1);

namespace App\Models;

use Kenjis\CI3Compatible\Core\CI_Model;
use Kenjis\CI3Compatible\Database\CI_DB_query_builder;

/**
 * @property CI_DB_query_builder $db
 */
class Checkout_model extends CI_Model
{
    public function getCart($id)
    {
        $this->db->select('cart.id, cart.subtotal,
		products.name, products.image, products.price');
        $this->db->from('cart');
        $this->db->join('products', 'cart.product_id = products.id');
        $this->db->where('cart.user_id', $id);

        return $this->db->get()->result_array();
    }

    public function total($id)
    {
        $this->db->select_sum('subtotal');
        $this->db->from('cart');
        $this->db->where('user_id', $id);

        return $this->db->get()->row()->subtotal;
    }

    public function insertOrder($data)
    {
        $this->db->insert('orders', $data);

        return $this->db->insert_id();
    }

    public function getCartByIdUser($id)
    {
        return $this->db->get_where('cart', ['user_id' => $id])->result_array();
    }

    public function insertOrdersDetail($data): void
    {
        $this->db->insert('orders_detail', $data);
    }

    public function deleteCart($id): void
    {
        $this->db->delete('cart', ['user_id' => $id]);
    }
}

/* End of file Checkout.php */
