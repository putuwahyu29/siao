<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= str_replace("SIAO | ", "", $title); ?></h1>
  <div class="row">
    <div class="col-lg-12">
      <?= $this->session->flashdata('message'); ?>
      <div class="card shadow mb-4">
        <div class="card-body">
          <form action="<?= base_url('akun/ubahkatasandi'); ?>" method="post">
            <form>
              <div class="form-group">
                <label for="current_password">Kata Sandi Lama</label>
                <input type="password" class="form-control" id="current_password" name="current_password">
                <?= form_error('current_password', '<small class="text-small text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="new_password1">Kata Sandi Baru</label>
                <input type="password" class="form-control" id="new_password1" name="new_password1">
                <?= form_error('new_password1', '<small class="text-small text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="new_password2">Konfirmasi Kata Sandi</label>
                <input type="password" class="form-control" id="new_password2" name="new_password2">
                <?= form_error('new_password2', '<small class="text-small text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Ubah Kata Sandi</button>
              </div>
            </form>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->