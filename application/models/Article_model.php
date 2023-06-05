<?php
class Article_model extends CI_Model {
   public function insert_article($data) {
      $this->db->insert('posting', $data);
      return $this->db->insert_id();
   }
}