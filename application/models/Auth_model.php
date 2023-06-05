<?php
class Auth_model extends CI_Model
{
    public function register($data)
    {
        $this->db->trans_begin();
        unset($data['confirmationPassword']);
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['ip_address'] = get_client_ip();
        $data['created_on'] = time();
        $data['active'] = 1;
        $this->db->insert('users', $data);
        $this->db->insert('users_groups', ['user_id' => $this->db->insert_id(), 'group_id' => 2]);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();
        return true;
    }
}
