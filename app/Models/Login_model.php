<?php

declare(strict_types=1);

namespace App\Models;

use Kenjis\CI3Compatible\Core\CI_Model;
use Kenjis\CI3Compatible\Database\CI_DB_query_builder;

/**
 * @property CI_DB_query_builder $db
 */
class Login_model extends CI_Model
{
    public function checkEmail($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row_array();
    }
}

/* End of file Login_model.php */
