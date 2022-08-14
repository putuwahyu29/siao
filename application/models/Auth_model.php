<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
  public function daftar($data, $user_token, $data_detail)
  {
    $this->db->insert('akun', $data);
    $this->db->insert('akun_token', $user_token);
    $this->db->insert('detail_anggota', $data_detail);
  }
  public function aktivasiAkunSukses($email)
  {
    $this->db->set('aktif', 1);
    $this->db->where('email', $email);
    $this->db->update('akun');
    $this->db->delete('akun_token', ['email' => $email]);
  }
  public function aktivasiAkunGagal($email)
  {
    $this->db->delete('akun', ['email' => $email]); //hapus akun yang belum diverifikasi selama 1 hari
    $this->db->delete('akun_token', ['email' => $email]); //hapus akun yang belum diverifikasi selama 1 hari
  }
  public function ubahKataSandi($email, $password)
  {
    $this->db->set('password', $password);
    $this->db->where('email', $email);
    $this->db->update('akun');
    $this->db->delete('akun_token', ['email' => $email]);
  }
}
