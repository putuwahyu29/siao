<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public function getSubMenu()
    {
        $this->db->select('akun_sub_menu.*,akun_menu.menu');
        $this->db->from('akun_sub_menu');
        $this->db->join('akun_menu', 'akun_sub_menu.menu_id = akun_menu.id');
        return $this->db->get('')->result_array();
    }

    public function getAllMenu($akun_id)
    {
        $this->db->select('akun_menu.id,menu');
        $this->db->from('akun_menu');
        $this->db->join('akun_access_menu', 'akun_menu.id = akun_access_menu.menu_id');
        $this->db->where('akun_access_menu.akun_id', $akun_id);
        $this->db->order_by('akun_access_menu.menu_id', 'ASC');
        return $this->db->get('')->result_array();
    }
}
