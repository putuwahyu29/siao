<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dasbor extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in(); //cek apakah user sudah login atau belum, fungsi ada di helpers
    $this->load->model('Dasbor_model', 'dasbor');
    $this->load->model('Menu_model', 'menu');
  }

  public function index()
  {
    $data['title'] = 'SIAO | Dasbor';
    $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
    $data['total_anggota'] = $this->dasbor->getCountAnggota();
    $data['jk']['laki'] = $this->dasbor->getCountJenisKelamin('Laki-Laki');
    $data['jk']['perempuan'] = $this->dasbor->getCountJenisKelamin('Perempuan');
    $data['jk']['none'] = $this->dasbor->getCountJenisKelamin('') - 1;
    $data['angkatan']['61'] = $this->dasbor->getCountAngkatan('61');
    $data['angkatan']['62'] = $this->dasbor->getCountAngkatan('62');
    $data['angkatan']['63'] = $this->dasbor->getCountAngkatan('63');
    $data['angkatan']['64'] = $this->dasbor->getCountAngkatan('64');
    $data['asalKabKot']['kotmtr'] = $this->dasbor->getCountAsalKabKot('Kota Mataram');
    $data['asalKabKot']['lobar'] = $this->dasbor->getCountAsalKabKot('Lombok Barat');
    $data['asalKabKot']['loteng'] = $this->dasbor->getCountAsalKabKot('Lombok Tengah');
    $data['asalKabKot']['lotim'] = $this->dasbor->getCountAsalKabKot('Lombok Timur');
    $data['asalKabKot']['klu'] = $this->dasbor->getCountAsalKabKot('Lombok Utara');
    $data['asalKabKot']['ksb'] = $this->dasbor->getCountAsalKabKot('Sumbawa Barat');
    $data['asalKabKot']['sumbawa'] = $this->dasbor->getCountAsalKabKot('Sumbawa');
    $data['asalKabKot']['bima'] = $this->dasbor->getCountAsalKabKot('Bima');
    $data['asalKabKot']['dompu'] = $this->dasbor->getCountAsalKabKot('Dompu');
    $data['asalKabKot']['kotbima'] = $this->dasbor->getCountAsalKabKot('Kota Bima');
    $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('dasbor/index', $data);
    $this->load->view('templates/footer', $data);
    $this->load->view('templates/scriptDasbor');
  }

  public function anggota()
  {
    $data['title'] = 'SIAO | Anggota';
    $data['akun'] = $this->db->get_where('akun', ['username' => $this->session->userdata('username')])->row_array();
    $data['anggota'] = $this->dasbor->getNonSuperAdmin(); //get detail anggota rinjani
    $data['sidebar_menu'] = $this->menu->getAllMenu($this->session->userdata('akun_id')); //get sidebar menu akses berdasarkan akun_id
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('dasbor/anggota', $data);
    $this->load->view('templates/footer');
    $this->load->view('templates/scriptKeanggotaan');
  }

  public function cetak()
  {
    $data['title'] = 'SIAO | Cetak';
    $data['anggota'] = $this->dasbor->getNonSuperAdmin(); //get detail anggota rinjani
    $this->load->view('templates/header', $data);
    $this->load->view('templates/scriptCetak');
    $this->load->view('dasbor/cetak', $data);
  }

  public function ekspor()
  {

    $data['title'] = 'SIAO | Ekspor';
    $data['anggota'] = $this->dasbor->getNonSuperAdmin(); //get detail anggota rinjani

    $spreadsheet = new Spreadsheet();
    $spreadsheet->getProperties()->setCreator("Rinjani STIS")
      ->setLastModifiedBy("Rinjani STIS")
      ->setTitle("Data Anggota Rinjani");
    $objSheet = $spreadsheet->getActiveSheet();

    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = [
      'font' => ['bold' => true], // Set font nya jadi bold
      'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ],
      'borders' => [
        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
      ]
    ];
    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = [
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ],
      'borders' => [
        'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
        'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
        'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
        'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
      ]
    ];


    // Buat header tabel nya pada baris ke 1

    $spreadsheet->setActiveSheetIndex(0);
    $objSheet->setCellValue('A1', 'No');
    $objSheet->setCellValue('B1', 'Nama Lengkap');
    $objSheet->setCellValue('C1', 'Nama Panggilan');
    $objSheet->setCellValue('D1', 'Jenis Kelamin');
    $objSheet->setCellValue('E1', 'Tanggal Lahir');
    $objSheet->setCellValue('F1', 'NIM');
    $objSheet->setCellValue('G1', 'Kelas');
    $objSheet->setCellValue('H1', 'Angkatan');
    $objSheet->setCellValue('I1', 'UKM');
    $objSheet->setCellValue('J1', 'NO HP');
    $objSheet->setCellValue('K1', 'Email');
    $objSheet->setCellValue('L1', 'Asal Kabupaten/Kota');
    $objSheet->setCellValue('M1', 'Alamat Rumah');
    $objSheet->setCellValue('N1', 'Alamat Kos');

    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $objSheet->getStyle('A1')->applyFromArray($style_col);
    $objSheet->getStyle('B1')->applyFromArray($style_col);
    $objSheet->getStyle('C1')->applyFromArray($style_col);
    $objSheet->getStyle('D1')->applyFromArray($style_col);
    $objSheet->getStyle('E1')->applyFromArray($style_col);
    $objSheet->getStyle('F1')->applyFromArray($style_col);
    $objSheet->getStyle('G1')->applyFromArray($style_col);
    $objSheet->getStyle('H1')->applyFromArray($style_col);
    $objSheet->getStyle('I1')->applyFromArray($style_col);
    $objSheet->getStyle('J1')->applyFromArray($style_col);
    $objSheet->getStyle('K1')->applyFromArray($style_col);
    $objSheet->getStyle('L1')->applyFromArray($style_col);
    $objSheet->getStyle('M1')->applyFromArray($style_col);
    $objSheet->getStyle('N1')->applyFromArray($style_col);

    $row = 2;
    $no = 1;

    foreach ($data['anggota'] as $agt) {
      $objSheet->setCellValue('A' . $row, $no++);
      $objSheet->setCellValue('B' . $row, $agt['nama']);
      $objSheet->setCellValue('C' . $row, $agt['nama_panggilan']);
      $objSheet->setCellValue('D' . $row, $agt['jenis_kelamin']);
      $objSheet->setCellValue('E' . $row, $agt['tgl_lahir']);
      $objSheet->setCellValue('F' . $row, $agt['nim']);
      $objSheet->setCellValue('G' . $row, $agt['kelas']);
      $objSheet->setCellValue('H' . $row, $agt['angkatan']);
      $objSheet->setCellValue('I' . $row, $agt['ukm']);
      $objSheet->setCellValue('J' . $row, $agt['no_hp']);
      $objSheet->setCellValue('K' . $row, $agt['email']);
      $objSheet->setCellValue('L' . $row, $agt['asal_kabkot']);
      $objSheet->setCellValue('M' . $row, $agt['alamat_rmh']);
      $objSheet->setCellValue('N' . $row, $agt['alamat_kos']);

      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $objSheet->getStyle('A' . $row)->applyFromArray($style_row);
      $objSheet->getStyle('B' . $row)->applyFromArray($style_row);
      $objSheet->getStyle('C' . $row)->applyFromArray($style_row);
      $objSheet->getStyle('D' . $row)->applyFromArray($style_row);
      $objSheet->getStyle('E' . $row)->applyFromArray($style_row);
      $objSheet->getStyle('F' . $row)->applyFromArray($style_row);
      $objSheet->getStyle('G' . $row)->applyFromArray($style_row);
      $objSheet->getStyle('H' . $row)->applyFromArray($style_row);
      $objSheet->getStyle('I' . $row)->applyFromArray($style_row);
      $objSheet->getStyle('J' . $row)->applyFromArray($style_row);
      $objSheet->getStyle('K' . $row)->applyFromArray($style_row);
      $objSheet->getStyle('L' . $row)->applyFromArray($style_row);
      $objSheet->getStyle('M' . $row)->applyFromArray($style_row);
      $objSheet->getStyle('N' . $row)->applyFromArray($style_row);

      $row++;
    }

    // Set width kolom
    $objSheet->getColumnDimension('A')->setWidth(5);
    $objSheet->getColumnDimension('B')->setWidth(40);
    $objSheet->getColumnDimension('C')->setWidth(30);
    $objSheet->getColumnDimension('D')->setWidth(30);
    $objSheet->getColumnDimension('E')->setWidth(30);
    $objSheet->getColumnDimension('F')->setWidth(15);
    $objSheet->getColumnDimension('G')->setWidth(15);
    $objSheet->getColumnDimension('H')->setWidth(15);
    $objSheet->getColumnDimension('I')->setWidth(40);
    $objSheet->getColumnDimension('J')->setWidth(25);
    $objSheet->getColumnDimension('K')->setWidth(30);
    $objSheet->getColumnDimension('L')->setWidth(30);
    $objSheet->getColumnDimension('M')->setWidth(50);
    $objSheet->getColumnDimension('N')->setWidth(50);

    // Set orientasi kertas jadi LANDSCAPE
    $objSheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    $filename = 'Data Anggota Rinjani ' . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
  }
}
