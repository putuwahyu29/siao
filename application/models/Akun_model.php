<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun_model extends CI_Model
{

    public function getDetail()
    {
        $this->db->select('*');
        $this->db->from('akun');
        $this->db->join('detail_anggota', 'detail_anggota.username = akun.username');
        return $this->db->get('')->result_array();
    }

    public function getDetailByUsername($username)
    {
        $this->db->select('*');
        $this->db->from('akun');
        $this->db->join('detail_anggota', 'detail_anggota.username = akun.username');
        return $this->db->get_where('', ['akun.username' => $username])->result_array()[0];
    }

    public function editProfil()
    {
        // Cek password
        $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
        $verify_password = $this->input->post('verify_password');
        if (!password_verify($verify_password, $data['akun']['password'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kata Sandi tidak sesuai! Gagal mengedit profil</div>');
            redirect('akun/edit');
        } else {
            // Upload image
            $upload_image = $_FILES['gambar']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '512';
                $config['upload_path'] = './assets/img/profile/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar')) {
                    $old_image = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
                    if ($old_image['gambar'] != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image['gambar']);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Ukuran file atau tipe file tidak didukung. Silahkan coba lagi! </div>');
                    redirect('akun/edit');
                }
            }
            // input data
            $data1 = array(
                'nama' => $this->input->post('nama', true),
                'username' => $this->input->post('username', true),
                'email' => $this->input->post('email', true),
            );
            $data2 = array(
                'nama_panggilan' => $this->input->post('nama_panggilan', true),
                'nim' => $this->input->post('nim', true),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
                'jabatan' => $this->input->post('jabatan', true),
                'kelas' => $this->input->post('kelas', true),
                'no_hp' => $this->input->post('no_hp', true),
                'ukm' => implode(', ', $this->input->post('ukm[]', true)),
                'angkatan' => $this->input->post('angkatan', true),
                'tgl_lahir' => $this->input->post('tgl_lahir', true),
                'asal_kabkot' =>  $this->input->post('asal_kabkot', true),
                'alamat_rmh' => $this->input->post('alamat_rmh', true),
                'alamat_kos' => $this->input->post('alamat_kos', true)
            );
            $this->db->update('akun', $data1, ['username' => $this->input->post('username')]);
            $this->db->update('detail_anggota', $data2, ['username' => $this->input->post('username')]);
        }
    }

    public function pengaturanAkun($usernameAwal)
    {
        $data1  = array(
            'username' => $this->input->post('username', true),
            'email' => $this->input->post('email', true)
        );
        $data2  = array(
            'username' => $this->input->post('username', true)
        );
        $this->db->update('akun', $data1, ['username' => $usernameAwal]);
        $this->db->update('detail_anggota', $data2, ['username' => $usernameAwal]);
    }

    public function getNonSuperAdmin()
    {
        $this->db->select('*');
        $this->db->from('akun');
        $this->db->join('detail_anggota', 'detail_anggota.username = akun.username');
        $this->db->where('akun.akun_id !=', 3);
        return $this->db->get('')->result_array();
    }

    public function ubahKataSandi($password_hash, $username)
    {
        $this->db->set('password', $password_hash);
        $this->db->where('username', $username);
        $this->db->update('akun');
    }
}
