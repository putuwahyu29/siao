<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dasbor_model extends CI_Model
{

  public function getCountAnggota()
  {
    return $this->db->get('detail_anggota')->num_rows();
  }

  public function getCountJenisKelamin($jk)
  {
    $this->db->where('jenis_kelamin', $jk);
    $this->db->from('detail_anggota');
    return $this->db->count_all_results();
  }
  public function getCountAngkatan($angkatan)
  {
    $this->db->where('angkatan', $angkatan);
    $this->db->from('detail_anggota');
    return $this->db->count_all_results();
  }
  public function getCountAsalKabKot($asalKabKot)
  {
    $this->db->where('asal_kabkot', $asalKabKot);
    $this->db->from('detail_anggota');
    return $this->db->count_all_results();
  }
  public function getNonSuperAdmin()
  {
    $this->db->select('*');
    $this->db->from('akun');
    $this->db->join('detail_anggota', 'detail_anggota.username = akun.username');
    $this->db->where('akun.akun_id !=', 3);
    return $this->db->get('')->result_array();
  }
}
