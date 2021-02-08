<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Order_model;
use Kenjis\CI3Compatible\Core\CI_Controller;
use Kenjis\CI3Compatible\Core\CI_Input;
use Kenjis\CI3Compatible\Library\CI_Session;

/**
 * @property Order_model $order
 * @property CI_Session $session
 * @property CI_Input $input
 */
class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('order_model', 'order');
    }

    public function index(): void
    {
        $data['title']  = 'Orders';
        $data['page']   = 'pages/order/index';
        $data['orders'] = $this->order->getOrders();
        $this->load->view('layouts/app', $data);
    }

    public function detail($id): void
    {
        $data['title']              = 'Order Detail';
        $data['page']               = 'pages/order/detail';
        $data['order']          = $this->order->getOrderDetailById($id);
        $data['order_detail']   = $this->order->getOrderDetail($id);

        if ($data['order']['status'] != 'waiting') {
            $data['order_confirm'] = $this->order->getOrderConfirm($data['order']['id']);
        }

        $this->load->view('layouts/app', $data);
    }

    public function update($id): void
    {
        $data['status'] = $this->input->post('status');
        $this->order->updateStatus($id, $data);
        $this->session->set_flashdata('success', 'Data updated successfully.');

        redirect_("order/detail/$id");
    }
}

/* End of file Order.php */
