<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in(); //cek apakah user sudah login atau belum, fungsi ada di helpers
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Menu_model', 'menu');
    }

    public function index()
    {
        $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'SIAO | Pengaturan Admin';
        $data['admin'] = $this->admin->getAdmin(); //get detail admin anggota rinjani
        $data['anggota'] = $this->admin->getNonAdmin(); //get detail anggota rinjani
        $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
        $this->form_validation->set_rules('username', 'Nama Pengguna Admin Baru', 'required', array('required' => '%s tidak boleh kosong!'));
        $this->form_validation->set_rules('akun_id', 'Kotak Centang', 'required', array('required' => '%s harus dicentang!'));
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->admin->tambahAdmin();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil! Admin berhasil ditambahkan!</div>');
            redirect('admin');
        }
    }


    public function peran()
    {
        $data['title'] = 'SIAO | Pengaturan Peran';
        $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->db->get('akun_role')->result_array();
        $data['menu'] = $this->admin->getMenuNonSuperAdmin();
        $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
        $this->form_validation->set_rules('role', 'Nama Peran Baru', 'required', array('required' => '%s tidak boleh kosong!'));
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/peran', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/scriptAksesPeran');
        } else {
            $this->db->insert('akun_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil! Peran berhasil ditambahkan!</div>');
            redirect('admin/peran');
        }
    }

    public function hapusPeran($role_id)
    {
        $this->db->delete('akun_role', ['id' => $role_id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil! Peran berhasil dihapus!</div>');
        redirect('admin/peran');
    }

    public function editPeran()
    {
        $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'SIAO | Pengaturan Peran';
        $data['role'] = $this->db->get('akun_role')->result_array();
        $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
        $this->form_validation->set_rules('role', 'Nama Peran', 'required', array('required' => '%s tidak boleh kosong!'));
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/peran', $data);
            $this->load->view('templates/footer');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Gagal! Peran gagal diedit!</div>');
            redirect('admin/peran');
        } else {
            $this->db->update('akun_role', ['role' => $this->input->post('role')], ['id' => $this->input->post('id')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil! Peran berhasil diedit!</div>');
            redirect('admin/peran');
        }
    }

    public function ubahAksesPeran()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');
        $data = [
            'akun_id' => $role_id,
            'menu_id' => $menu_id
        ];
        $result = $this->db->get_where('akun_access_menu', $data);
        $this->admin->ubahAksesPeran($result, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil! Akses Peran telah diedit </div>');
    }

    public function hapusAdmin()
    {
        $data['title'] = 'SIAO | Pengaturan Admin';
        $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
        $data['admin'] = $this->admin->getAdmin(); //get detail admin anggota rinjani
        $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
        $this->form_validation->set_rules('username', 'Nama Pengguna Admin Baru', 'required', array('required' => '%s tidak boleh kosong!'));
        $this->form_validation->set_rules('akun_id', 'Akun_id Admin Baru', 'required', array('required' => '%s harus dicentang!'));
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->admin->hapusAdmin();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil! Admin berhasil dihapus!</div>');
            redirect('admin');
        }
    }

    public function hapusAnggota($username)
    {
        $this->db->delete('akun', ['username' => $username]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil! Pengguna berhasil dihapus!</div>');
        redirect('admin/pengguna');
    }

    public function basisdata()
    {
        $data['title'] = 'SIAO | Pengaturan Basis Data';
        $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
        $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/basisdata', $data);
        $this->load->view('templates/footer');
    }

    public function cadangkan()
    {
        $this->admin->cadangkan();
    }

    public function pengguna()
    {
        $data['title'] = 'SIAO | Pengaturan Pengguna';
        $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
        $data['anggota'] = $this->admin->getNonSuperAdmin(); //get detail anggota rinjani
        $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pengguna', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/scriptKeanggotaan');
    }

    public function aktifkan($username)
    {
        $this->admin->aktifkan($username);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil! Pengguna berhasil diaktifkan!</div>');
        redirect('admin/pengguna');
    }
    public function nonaktifkan($username)
    {
        $this->admin->nonaktifkan($username);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil! Pengguna berhasil dinonaktifkan!</div>');
        redirect('admin/pengguna');
    }
}
