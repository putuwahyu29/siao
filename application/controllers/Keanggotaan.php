<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keanggotaan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in(); //cek apakah user sudah login atau belum, fungsi ada di helpers
    $this->load->model('Akun_model', 'akun');
    $this->load->model('Menu_model', 'menu');
  }

  public function index()
  {
    $data['title'] = 'SIAO | Daftar Anggota';
    $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
    $data['anggota'] = $this->akun->getNonSuperAdmin(); //get detail anggota rinjani
    $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('keanggotaan/index', $data);
    $this->load->view('templates/footer');
    $this->load->view('templates/scriptKeanggotaan');
  }
}
