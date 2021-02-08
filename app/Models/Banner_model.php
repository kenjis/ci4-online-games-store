<?php

declare(strict_types=1);

namespace App\Models;

use Kenjis\CI3Compatible\Core\CI_Loader;
use Kenjis\CI3Compatible\Core\CI_Model;
use Kenjis\CI3Compatible\Database\CI_DB_query_builder;
use Kenjis\CI3Compatible\Library\CI_Session;
use Kenjis\CI3Compatible\Library\CI_Upload;

/**
 * @property CI_DB_query_builder $db
 * @property CI_Upload $upload
 * @property CI_Loader $load
 * @property CI_Session $session
 */
class Banner_model extends CI_Model
{
    public function getBanners()
    {
        return $this->db->get('banners')->result_array();
    }

    public function getAllGame()
    {
        return $this->db->get('products')->result_array();
    }

    public function insertBanner($data): void
    {
        $this->db->insert('banners', $data);
    }

    public function getBannerById($id)
    {
        return $this->db->get_where('banners', ['id' => $id])->row_array();
    }

    public function updateBanner($id, $data): void
    {
        $this->db->update('banners', $data, ['id' => $id]);
    }

    public function deleteBanner($id): void
    {
        $this->db->delete('banners', ['id' => $id]);
    }

    public function uploadImage()
    {
        $config = [
            'upload_path'     => './images/banner',
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

/* End of file Banner_model.php */
