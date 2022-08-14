<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'auth');
    }
    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('akun');
        }
        $this->form_validation->set_rules('username', 'Nama Pengguna', 'required|trim', array('required' => '%s harus diisi!'));
        $this->form_validation->set_rules('password', 'Kata Sandi', 'required|trim', array('required' => '%s harus diisi!'));
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'SIAO | Masuk';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/masuk');
        } else {
            $this->_masuk();
        }
    }

    private function _masuk()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $akun = $this->db->get_where('akun', ['username' => $username])->row_array();
        if ($akun) {
            if ($akun['aktif'] == 1) {
                if (password_verify($password, $akun['password'])) {
                    $data = [
                        'username' => $akun['username'],
                        'akun_id' => $akun['akun_id'],
                        'email' => $akun['email']
                    ];
                    $this->session->set_userdata($data);
                    if ($akun['akun_id'] == 2) {
                        redirect('akun');
                    } else {
                        redirect('dasbor');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Masuk Gagal! Informasi yang anda berikan tidak benar! Silahkan masukkan nama pengguna dan kata sandi dengan benar</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Masuk Gagal! Akun belum diaktifkan! Silahkan cek email untuk aktivasi akun atau hubungi admin</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Masuk Gagal! Informasi yang anda berikan tidak benar!  Silahkan masukkan nama pengguna dan kata sandi dengan benar</div>');
            redirect('auth');
        }
    }
    public function keluar()
    {
        $this->session->unset_userdata('username');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kamu sudah berhasil keluar!</div>');
        redirect('auth');
    }


    public function daftar()
    {
        if ($this->session->userdata('username')) {
            redirect('akun');
        }
        $this->form_validation->set_rules('username', 'Nama Pengguna', 'trim|required|is_unique[akun.username]', array('required' => '%s harus diisi!', 'is_unique' => '%s sudah digunakan!'));
        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => '%s harus diisi!'));
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[akun.email]', array('required' => '%s harus diisi dan valid!', 'is_unique' => '%s sudah terdaftar!'));
        $this->form_validation->set_rules('password1', 'Kata Sandi', 'callback_valid_password|matches[password2]', array('matches' => '%s tidak sama dengan konfirmasi kata sandi!'));
        $this->form_validation->set_rules('password2', 'Konfirmasi Kata Sandi', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'SIAO | Daftar';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/daftar');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'email' => htmlspecialchars($email),
                'gambar' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'akun_id' => 2,
                'aktif' => '0',
                'tgl_dibuat' => time()
            ];
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'tgl_dibuat' => time()
            ];
            $data_detail = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'nama_panggilan' => '',
                'nim' => '',
                'jenis_kelamin' => '',
                'jabatan' => '',
                'kelas' => '',
                'no_hp' => '',
                'ukm' => '',
                'angkatan' => NULL,
                'tgl_lahir' => NULL,
                'asal_kabkot' => '',
                'alamat_rmh' => '',
                'alamat_kos' => '',
            ];
            $this->auth->daftar($data, $user_token, $data_detail);
            $this->_kirimEmail($token, 'verify');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Berhasil! Akun berhasil ditambahkan! Silahkan aktivasi akun melalui email yang telah terdaftarkan atau hubungi admin. </div>');
            redirect('auth');
        }
    }

    //Buat kata sandi kuat 
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

    private function _kirimEmail($token, $type)
    {
        $config = [
            'mailtype'  => 'html', // Mengatur format email menjadi HTML
            'charset'   => 'utf-8',
            'protocol'  => 'smtp', // Mengatur protokol email menjadi SMTP
            'smtp_host' => 'smtp.zoho.com', // atau smptp lainnya                
            'smtp_user' => 'himadarinjanistis@zohomail.com',  // Email pengirim
            'smtp_pass'   => 'rinjani2022',  // Password email pengirim
            'smtp_crypto' => 'ssl', // Mengatur enkripsi email menjadi SSL
            'smtp_port'   => 465, // Mengatur port email menjadi 465
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];
        $this->load->library('email', $config); // panggil library email dan konfigurasinya
        $this->email->initialize($config); // inisialisasi library email dengan konfigurasi yang telah dibuat diatas
        $this->email->from('himadarinjanistis@zohomail.com', 'Rinjani STIS'); // Email pengirim
        $this->email->to($this->input->post('email')); // Email penerima
        // kondisi ketika mengirim email verifikasi
        if ($type == 'verify') {
            $this->email->subject('Verifikasi Akun');
            $this->email->message('
            <h1> Verifikasi Akun SIAO </h1>
            Klik link ini untuk verifikasi akun : <a href="' . base_url() . 'auth/aktivasi?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Verifikasi</a>');
        } else if ($type == 'forgot') { // kondisi ketika mengirim email forgot password
            $this->email->subject('Atur Ulang Kata Sandi');
            $this->email->message('
            <h1> Reset Password Akun SIAO </h1>
            Klik link ini untuk mengatur ulang kata sandi akun : <a href="' . base_url() . 'auth/aturulangkatasandi?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Atur Ulang Kata Sandi</a>');
        }
        if ($this->email->send()) {
            return true;
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Gagal! Terjadi kesalahan pada sistem. Ulangi beberapa saat lagi. </div>');
            redirect('auth');
            die;
        }
    }

    public function aktivasi()
    {
        $email = $this->input->get('email'); // Ambil email dari link
        $token = $this->input->get('token'); // Ambil token dari link
        $user = $this->db->get_where('akun', ['email' => $email])->row_array(); // Cocokan email di database
        if ($user) { //kondisi jika email ada di database
            $user_token = $this->db->get_where('akun_token', ['token' => $token])->row_array();
            if ($user_token) { // kondisi jika token ada di database
                if (time() - $user_token['tgl_dibuat'] < (60 * 60 * 24)) { // kondisi jika token masih aktif
                    $this->auth->aktivasiAkunSukses($email);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Akun ' . $email . ' berhasil diverifikasi! Silahkan Login. </div>');
                } else { // kondisi jika token sudah tidak aktif
                    $this->auth->aktivasiAkunGagal($email);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Akun gagal diverifikasi! Token kadaluarsa. Silahkan mendaftar akun lagi </div>');
                }
                redirect('auth');
            } else { // kondisi jika token salah
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Aktivasi akun gagal. Token salah!
                </div>');
                redirect('auth');
            }
        } else { // kondisi jika email tidak ada di database
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Aktivasi akun gagal. Akun tidak ditemukan!
            </div>');
            redirect('auth');
        }
    }


    public function aksesBlokir()
    {
        $data['title'] = 'SIAO | 403';
        $this->load->view('custom/eror_403', $data); // tampilkan view jika hak akses tidak sah
    }

    public function lupaKataSandi()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array('required' => '%s harus diisi dan valid!', 'valid_email' => '%s tidak valid!'));
        if ($this->form_validation->run() == false) {
            $data['title'] = 'SIAO | Lupa Kata Sandi';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/lupakatasandi');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('akun', ['email' => $email, 'aktif' => 1])->row_array();
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'tgl_dibuat' => time()
                ];
                $this->db->insert('akun_token', $user_token);
                $this->_kirimEmail($token, 'forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Silahkan cek email anda untuk mengatur ulang kata sandi. </div>');
                redirect('auth/lupakatasandi');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email tidak ditemukan atau belum diaktivasi! </div>');
                redirect('auth/lupakatasandi');
            }
        }
    }

    public function aturUlangKataSandi()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('akun', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('akun_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->ubahKataSandi();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Reset password gagal. Token salah!
            </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Reset password gagal. Akun tidak ditemukan!
            </div>');
            redirect('auth');
        }
    }

    public function ubahKataSandi()
    {
        if (!$this->session->userdata('reset_email')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Password gagal diubah! Silahkan atur ulang kata sandi lagi. </div>');
            redirect('auth');
        }
        $this->form_validation->set_rules('password1', 'Password Baru', 'required|trim|min_length[4]|matches[password2]', array('required' => '%s tidak boleh kosong!', 'min_length' => '%s minimal 4 karakter!', 'matches' => '%s tidak sama dengan %s!'));
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|min_length[4]|matches[password1]', array('required' => '%s tidak boleh kosong!', 'min_length' => '%s minimal 4 karakter!', 'matches' => '%s tidak sama dengan %s!'));
        if ($this->form_validation->run() == false) {
            $data['title'] = 'SIAO | Ubah Kata Sandi';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/ubahkatasandi');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');
            if (!$email) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password gagal diubah! Silahkan reset password lagi. </div>');
                redirect('auth');
            } else {
                $this->auth->ubahKataSandi($email, $password);
                $this->session->unset_userdata('reset_email');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah! Silahkan Login. </div>');
                redirect('auth');
            }
        }
    }
}
