<?php

declare(strict_types=1);

namespace App\Models;

use Kenjis\CI3Compatible\Core\CI_Model;
use Kenjis\CI3Compatible\Database\CI_DB_query_builder;

/**
 * @property CI_DB_query_builder $db
 */
class Register_model extends CI_Model
{
    public function register($data): void
    {
        $this->db->insert('users', $data);
    }
}

/* End of file Register_model.php */
