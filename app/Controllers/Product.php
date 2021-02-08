<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Product_model;
use Kenjis\CI3Compatible\Core\CI_Controller;
use Kenjis\CI3Compatible\Core\CI_Input;
use Kenjis\CI3Compatible\Library\CI_Form_validation;
use Kenjis\CI3Compatible\Library\CI_Session;

use function file_exists;
use function unlink;

/**
 * @property Product_model $product
 * @property CI_Form_validation $form_validation
 * @property CI_Session $session
 * @property CI_Input $input
 */
class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_admin();
        $this->load->model('product_model', 'product');
    }

    public function index(): void
    {
        $data['title']      = 'Products';
        $data['product']    = $this->product->getAllProduct();
        $data['page']       = 'pages/product/index';

        $this->load->view('layouts/app', $data);
    }

    public function add(): void
    {
        $this->form_validation->set_rules('name', 'Game name', 'required', ['required' => 'Game name is required.']);
        $this->form_validation->set_rules('price', 'Price', 'required|numeric', [
            'required' => 'Price is required.',
            'numeric'  => 'Price must number.',
        ]);
        $this->form_validation->set_rules('description', 'Description', 'required', ['required' => 'Description is required.']);
        $this->form_validation->set_rules('requirements', 'System requriements', 'required', ['required' => 'System requriements is required.']);

        if ($this->form_validation->run() == false) {
            $data['title']  = 'Add Game';
            $data['page']   = 'pages/product/add';
            $this->load->view('layouts/app', $data);
        } else {
            $data = [
                'name'          => $this->input->post('name'),
                'price'         => $this->input->post('price'),
                'edition'       => $this->input->post('edition'),
                'description'   => $this->input->post('description'),
                'requirements'  => $this->input->post('requirements'),
            ];

            if (! empty($_FILES['image']['name'])) {
                $upload = $this->product->uploadImage();
                $data['image'] = $upload;
            }

            $this->product->insertProduct($data);
            $this->session->set_flashdata('success', 'Game succesfully added.');

            redirect_('product');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('name', 'Game name', 'required', ['required' => 'Game name is required.']);
        $this->form_validation->set_rules('price', 'Price', 'required|numeric', [
            'required' => 'Price is required.',
            'numeric'  => 'Price must number.',
        ]);
        $this->form_validation->set_rules('description', 'Description', 'required', ['required' => 'Description is required.']);
        $this->form_validation->set_rules('requirements', 'System requriements', 'required', ['required' => 'System requriements is required.']);

        if ($this->form_validation->run() == false) {
            $data['title']      = 'Update Game';
            $data['page']       = 'pages/product/edit';
            $data['product']    = $this->product->getProduct($id);
            $this->load->view('layouts/app', $data);
        } else {
            $id = $this->input->post('id');
            $data = [
                'name'          => $this->input->post('name'),
                'price'         => $this->input->post('price'),
                'edition'       => $this->input->post('edition'),
                'description'   => $this->input->post('description'),
                'requirements'  => $this->input->post('requirements'),
            ];

            if (! empty($_FILES['image']['name'])) {
                $upload = $this->product->uploadImage();
                if ($upload) {
                    $productImage = $this->product->getProduct($id);
                    if (file_exists('images/game/' . $productImage['image']) && $productImage['image']) {
                        unlink('images/game/' . $productImage['image']);
                    }

                    $data['image'] = $upload;
                } else {
                    redirect_('product/edit');
                }
            }

            $this->product->updateProduct($id, $data);
            $this->session->set_flashdata('success', 'Game succesfully updated.');

//            redirect_('product');
            return redirect()->to('/product');
        }
    }

    public function delete($id): void
    {
        $produk = $this->product->getProduct($id);
        unlink('images/game/' . $produk['image']);
        $this->product->deleteProduct($id);
        $this->session->set_flashdata('success', 'Game succesfully deleted.');

        redirect_('product');
    }
}

/* End of file Product.php */
