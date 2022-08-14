<?php

function is_logged_in()
{
  $ci = get_instance();
  if (!$ci->session->userdata('username')) { // jika tidak ada session username
    redirect('auth');
  } else { // jika ada session username
    $akun_id = $ci->session->userdata('akun_id');
    $menu = $ci->uri->segment(1);
    $queryMenu = $ci->db->get_where('akun_menu', ['menu' => $menu])->row_array();
    $menu_id = $queryMenu['id'];
    $userAccess = $ci->db->get_where('akun_access_menu', ['akun_id' => $akun_id, 'menu_id' => $menu_id]);
    if ($userAccess->num_rows() < 1) { // jika tidak ada akses
      redirect('auth/aksesblokir');
    }
  }
}

function check_access($role_id, $menu_id)
{
  $ci = get_instance();
  $ci->db->where('akun_id', $role_id);
  $ci->db->where('menu_id', $menu_id);
  $result = $ci->db->get('akun_access_menu');
  if ($result->num_rows() > 0) {
    return "checked='checked'";
  }
}
