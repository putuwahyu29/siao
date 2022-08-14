<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NotFound extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data['title'] = 'SIAO | 404';
    $this->load->view('custom/eror_404', $data);
  }
}
