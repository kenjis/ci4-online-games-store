<?php

declare(strict_types=1);

namespace App\Models;

use Kenjis\CI3Compatible\Core\CI_Model;
use Kenjis\CI3Compatible\Database\CI_DB_query_builder;

/**
 * @property CI_DB_query_builder $db
 */
class Home_model extends CI_Model
{
    public function getAllGame()
    {
        return $this->db->get('products')->result_array();
    }

    public function getAllBanner()
    {
        return $this->db->get('banners')->result_array();
    }

    public function getGameById($id)
    {
        return $this->db->get_where('products', ['id' => $id])->row_array();
    }
}

/* End of file Home_model.php */
