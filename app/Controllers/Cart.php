<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Cart_model;
use Kenjis\CI3Compatible\Core\CI_Controller;
use Kenjis\CI3Compatible\Core\CI_Input;
use Kenjis\CI3Compatible\Library\CI_Session;

/**
 * @property Cart_model $cart
 * @property CI_Session $session
 * @property CI_Input $input
 */
class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('cart_model', 'cart');
    }

    public function index(): void
    {
        $id                     = $this->session->userdata('id');
        $data['title']  = 'Your Cart';
        $data['product']    = $this->cart->showCart($id);
        $data['page']       = 'pages/cart/index';
        $this->load->view('layouts/app', $data);
    }

    public function add(): void
    {
        $product_id = $this->input->post('product_id');
        $product    = $this->cart->getProductById($product_id);

        $data = [
            'user_id'    => $this->session->userdata('id'),
            'product_id' => $product_id,
            'subtotal'   => $product['price'],
        ];

        $this->cart->addToCart($data);
        $this->session->set_flashdata('success', 'Successfully added to your cart.');
        redirect_('home/detail/' . $product_id);
    }

    public function delete($id): void
    {
        $this->cart->deleteCart($id);
        $this->session->set_flashdata('success', 'Successfully deleted product in your cart.');
        redirect_('cart');
    }
}

/* End of file Cart.php */
