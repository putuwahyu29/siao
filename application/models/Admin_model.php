<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    public function getAdmin()
    {
        $this->db->select('*');
        $this->db->from('akun');
        $this->db->join('detail_anggota', 'detail_anggota.username = akun.username');
        return $this->db->get_where('', ['akun.akun_id' => 1])->result_array();
    }

    public function getNonAdmin()
    {
        $this->db->select('*');
        $this->db->from('akun');
        $this->db->join('detail_anggota', 'detail_anggota.username = akun.username');
        return $this->db->get_where('', ['akun.akun_id' => 2])->result_array();
    }

    public function getMenuNonSuperAdmin()
    {
        $this->db->where('akun_menu.menu !=', 'admin');
        return $this->db->get('akun_menu')->result_array();
    }


    public function tambahAdmin()
    {
        // input data
        $data = array(
            'akun_id' => $this->input->post('akun_id', true),
        );
        // update data
        $this->db->update('akun', $data, ['username' => $this->input->post('username')]);
    }
    public function hapusAdmin()
    {
        // input data
        $data = array(
            'akun_id' => $this->input->post('akun_id', true),
        );
        // update data
        $this->db->update('akun', $data, ['username' => $this->input->post('username')]);
    }
    public function getNonSuperAdmin()
    {
        $this->db->select('*');
        $this->db->from('akun');
        $this->db->join('detail_anggota', 'detail_anggota.username = akun.username');
        $this->db->where('akun.akun_id !=', 3);
        return $this->db->get('')->result_array();
    }
    public function aktifkan($username)
    {
        $this->db->set('aktif', 1);
        $this->db->where('username', $username);
        $this->db->update('akun');
    }
    public function nonaktifkan($username)
    {
        $this->db->set('aktif', 0);
        $this->db->where('username', $username);
        $this->db->update('akun');
    }
    public function cadangkan()
    {
        $this->load->dbutil();
        $prefs = array(
            'format' => 'zip',
            'filename' => 'rinjani_stis_' . date('Y-m-d') . '.sql'
        );
        $backup = &$this->dbutil->backup($prefs);
        $db_name = 'rinjani_stis_' . date('Y-m-d') . '.zip';
        $save = './assets/db_backup/' . $db_name;
        $this->load->helper('file');
        write_file($save, $backup);
        $this->load->helper('download');
        force_download($db_name, $backup);
    }

    public function ubahAksesPeran($result, $data)
    {
        if ($result->num_rows() < 1) {
            $this->db->insert('akun_access_menu', $data);
        } else {
            $this->db->delete('akun_access_menu', $data);
        }
    }
}
