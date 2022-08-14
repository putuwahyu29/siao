<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
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
        $data['title'] = 'SIAO | Profil Saya';
        $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
        $data['akun'] = $this->akun->getDetailByUsername($data['akun']['username']);
        $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('akun/index', $data);
        $this->load->view('templates/footer');
    }

    public function ubahKataSandi()
    {
        $data['title'] = 'SIAO | Ubah Kata Sandi';
        $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
        $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
        $this->form_validation->set_rules('current_password', 'Kata Sandi Lama', 'required|trim', array('required' => '%s tidak boleh kosong!'));
        $this->form_validation->set_rules('new_password1', 'Kata Sandi Baru', 'callback_valid_password|matches[new_password2]', array('matches' => '%s tidak sama dengan konfirmasi kata sandi!'));
        $this->form_validation->set_rules('new_password2', 'Konfirmasi Kata Sandi', 'trim|required|matches[new_password1]', array('required' => '%s tidak boleh kosong!', 'matches' => '%s tidak sama dengan kata sandi baru!'));
        if ($this->form_validation->run() == false) { // jika validasi belum dilakukan atau validasi gagal
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('akun/ubahkatasandi', $data);
            $this->load->view('templates/footer');
        } else { // jika validasi berhasil
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            // jika password lama tidak sesuai
            if (!password_verify($current_password, $data['akun']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kata Sandi lama tidak sesuai!</div>');
                redirect('akun/ubahkatasandi');
            } else { // jika password lama sesuai
                $new_password = $this->input->post('new_password1');
                if ($current_password == $new_password) { // jika password baru sama dengan password lama
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kata Sandi baru tidak boleh sama dengan Kata Sandi lama!</div>');
                    redirect('akun/ubahkatasandi');
                } else { // jika password baru tidak sama dengan password lama, maka ubah password dilakukan
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $username = $this->session->userdata('username');
                    $this->akun->ubahKataSandi($username, $password_hash);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kata Sandi berhasil diubah!</div>');
                    redirect('akun/ubahkatasandi');
                }
            }
        }
    }

    public function valid_password($password = '')
    {
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>ยง~]/';

        if (empty($password)) {
            $this->form_validation->set_message('valid_password', '{field} harus diisi.');
            return FALSE;
        }
        if (preg_match_all($regex_lowercase, $password) < 1) {
            $this->form_validation->set_message('valid_password', '{field} harus setidaknya satu huruf kecil.');
            return FALSE;
        }
        if (preg_match_all($regex_uppercase, $password) < 1) {
            $this->form_validation->set_message('valid_password', '{field} harus setidaknya satu huruf kapital.');
            return FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1) {
            $this->form_validation->set_message('valid_password', '{field} harus setidaknya satu angka.');
            return FALSE;
        }
        if (preg_match_all($regex_special, $password) < 1) {
            $this->form_validation->set_message('valid_password', '{field} harus setidaknya satu spesial karakter' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>ยง~'));
            return FALSE;
        }
        if (strlen($password) < 8) {
            $this->form_validation->set_message('valid_password', '{field} harus setidaknya 8 karakter.');
            return FALSE;
        }
        if (strlen($password) > 32) {
            $this->form_validation->set_message('valid_password', '{field} tidak boleh melebihi 32 karakter.');
            return FALSE;
        }
        return TRUE;
    }

    public function edit()
    {
        $data['title'] = 'SIAO | Edit Profil';
        $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
        $data['detail'] = $this->akun->getDetail(); //get detail anggota rinjani
        $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
        $this->form_validation->set_rules('username', 'Nama Pengguna', 'required|trim', array('required' => '%s tidak boleh kosong!'));
        $this->form_validation->set_rules('id', 'Kotak Centang', 'required', array('required' => '%s harus dicentang untuk menyetujui edit profil!'));
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('akun/edit', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/scriptEditProfil');
        } else {
            $this->akun->editProfil();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil berhasil diperbarui!</div>');
            redirect('akun/edit');
        }
    }
    public function pengaturan()
    {
        $data['title'] = 'SIAO | Pengaturan Akun';
        $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
        $data['detail'] = $this->akun->getDetail(); //get detail anggota rinjani
        $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
        if ($this->input->post('username', true) != $this->session->userdata('username')) {
            $this->form_validation->set_rules('username', 'Nama Pengguna', 'trim|required|is_unique[akun.username]', array('required' => '%s harus diisi!', 'is_unique' => '%s sudah digunakan!'));
        }
        if ($this->input->post('email', true) != $this->session->userdata('email')) {
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[akun.email]', array('required' => '%s harus diisi dan valid!', 'is_unique' => '%s sudah terdaftar!'));
        }
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('akun/pengaturan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->akun->pengaturanAkun($this->session->userdata('username'));
            $this->session->unset_userdata('username');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Silahkan masuk lagi dengan nama pengguna yang baru!</div>');
            redirect('auth');
        }
    }

    public function hapusAkun($username)
    {
        $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
        $verify_password = $this->input->post('verify_password_akundelete');
        if (!password_verify($verify_password, $data['akun']['password'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kata Sandi tidak sesuai! Gagal menghapus akun</div>');
            redirect('akun/edit');
        } else {
            $this->db->delete('detail_anggota', ['username' => $username]);
            $this->db->delete('akun', ['username' => $username]);
            $this->session->unset_userdata('username');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun kamu sudah berhasil dihapus!</div>');
            redirect('auth');
        }
    }
}
