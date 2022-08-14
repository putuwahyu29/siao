<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model', 'menu');
    }

    public function index()
    {
        $data['title'] = 'SIAO | Pengaturan Menu';
        $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
        $data['menu'] = $this->db->get('akun_menu')->result_array();
        $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
        $this->form_validation->set_rules('menu', 'Nama Menu Baru', 'required', array('required' => '%s tidak boleh kosong!'));
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('akun_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil! Menu berhasil ditambahkan!</div>');
            redirect('menu');
        }
    }

    public function menuEdit()
    {
        $data['title'] = 'SIAO | Pengaturan Menu';
        $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
        $data['menu'] = $this->db->get('akun_menu')->result_array();
        $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
        $this->form_validation->set_rules('menu', 'Nama Menu', 'required', array('required' => '%s tidak boleh kosong!'));
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->update('akun_menu', ['menu' => $this->input->post('menu')], ['id' => $this->input->post('id')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil! Menu berhasil diubah!</div>');
            redirect('menu');
        }
    }

    public function menuDelete($menu_id)
    {
        $this->db->delete('akun_menu', ['id' => $menu_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil! Menu berhasil dihapus!</div>');
        redirect('menu');
    }

    public function submenu()
    {
        $data['title'] = 'SIAO | Pengaturan Submenu';
        $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
        $data['subMenu'] = $this->menu->getSubMenu('akun_sub_menu');
        $data['menu'] = $this->db->get('akun_menu')->result_array();
        $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
        $this->form_validation->set_rules('title', 'Nama Sub Menu Baru', 'required', array('required' => '%s tidak boleh kosong!'));
        $this->form_validation->set_rules('menu_id', 'Menu', 'required', array('required' => '%s harus dipilih!'));
        $this->form_validation->set_rules('url', 'URL', 'required', array('required' => '%s tidak boleh kosong!'));
        $this->form_validation->set_rules('icon', 'Icon', 'required', array('required' => '%s tidak boleh kosong!'));
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'aktif' => $this->input->post('aktif')
            ];
            $this->db->insert('akun_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil! Sub Menu berhasil ditambahkan!</div>');
            redirect('menu/submenu');
        }
    }

    public function submenuEdit()
    {
        $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'SIAO | Pengaturan Submenu';
        $data['subMenu'] = $this->menu->getSubMenu('akun_sub_menu');
        $data['menu'] = $this->db->get('akun_menu')->result_array();
        $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
        $this->form_validation->set_rules('title', 'Nama Sub Menu', 'required', array('required' => '%s tidak boleh kosong!'));
        $this->form_validation->set_rules('menu_id', 'Menu', 'required', array('required' => '%s harus dipilih!'));
        $this->form_validation->set_rules('url', 'URL', 'required', array('required' => '%s tidak boleh kosong!'));
        $this->form_validation->set_rules('icon', 'Icon', 'required', array('required' => '%s tidak boleh kosong!'));
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'aktif' => $this->input->post('aktif')
            ];
            $this->db->update('akun_sub_menu', $data, ['id' => $this->input->post('id')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil! Submenu berhasil diedit!</div>');
            redirect('menu/submenu');
        }
    }
    public function subMenuDelete($subMenu_id)
    {
        $this->db->delete('akun_sub_menu', ['id' => $subMenu_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil! Submenu berhasil dihapus!</div>');
        redirect('menu/submenu');
    }
}
