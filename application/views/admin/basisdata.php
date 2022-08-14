<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= str_replace("SIAO | ", "", $title); ?></h1>
  <div class="row">
    <div class="col-lg-12 col">
      <?= form_error('role', '<div class="alert alert-danger">', '</div>'); ?>
      <?= $this->session->flashdata('message'); ?>
      <div class="card shadow mb-4">
        <div class="card-body">
          <a href="<?= base_url('admin/cadangkan') ?>" class="btn btn-primary btn-sm mb-3"><i class="fas fa-download"></i> Cadangkan</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->