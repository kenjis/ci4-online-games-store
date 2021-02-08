<?php

declare(strict_types=1);

namespace App\Models;

use Kenjis\CI3Compatible\Core\CI_Model;
use Kenjis\CI3Compatible\Database\CI_DB_query_builder;

/**
 * @property CI_DB_query_builder $db
 */
class Product_model extends CI_Model
{
    public function getAllProduct()
    {
        return $this->db->get('products')->result_array();
    }

    public function getProduct($id)
    {
        return $this->db->get_where('products', ['id' => $id])->row_array();
    }

    public function insertProduct($data): void
    {
        $this->db->insert('products', $data);
    }

    public function updateProduct($id, $data)
    {
        $this->db->update('products', $data, ['id' => $id]);

        return $this->db->affected_rows();
    }

    public function deleteProduct($id): void
    {
        $this->db->delete('products', ['id' => $id]);
    }

    public function uploadImage()
    {
        $config = [
            'upload_path'     => './images/game',
            'encrypt_name'    => true,
            'allowed_types'   => 'jpg|jpeg|png|JPG|PNG|JPEG',
            'max_size'        => 3000,
            'max_width'       => 0,
            'max_height'      => 0,
            'overwrite'       => true,
            'file_ext_tolower' => true,
        ];

         $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data('file_name');
        }

        $this->session->set_flashdata('image_error', 'Uploaded file types are not permitted or the file is too large.');

        return false;
    }
}

/* End of file Product_model.php */
