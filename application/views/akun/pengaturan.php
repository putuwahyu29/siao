<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= str_replace("SIAO | ", "", $title); ?></h1>
  <div class="row">
    <div class="col-lg-12">
      <?= $this->session->flashdata('message'); ?>
      <div class="card shadow mb-4">
        <div class="card-body">
          <form action="<?= base_url('akun/pengaturan'); ?>" method="post">
            <?php foreach ($detail as $dt) : ?>
              <?php if ($akun['username'] == $dt['username']) : ?>
                <div class="form-group">
                  <label for="username">Nama Pengguna</label>
                  <input type="text" class="form-control" value="<?= $dt['username'] ?>" id="username" name="username">
                  <?= form_error('username', '<small class="text-small text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" value="<?= $dt["email"]; ?>">
                  <?= form_error('email', '<small class="text-small text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group d-flex justify-content-between">
                  <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#verifyPasswordModal"><i class="fas fa-save"></i> Simpan Perubahan</a>
                  <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteAkunModal<?= $akun['username']; ?>"><i class="fas fa-trash"></i> Hapus Akun</a>
                </div>
                <!-- Start Modal Konfirm Password -->
                <div class="modal fade" id="verifyPasswordModal" tabindex="-1" role="dialog" aria-labelledby="verifyPasswordModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="verifyPasswordModal">Konfirmasi Kata Sandi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="current_password">Kata Sandi</label>
                          <input type="password" class="form-control" id="verify_password" name="verify_password">
                          <small>Untuk menyimpan perubahan, silahkan masukkan kata sandi</small>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary " data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Kembali</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Konfirmasi</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!--  End Modal Konfirm Password-->
              <?php endif; ?>
            <?php endforeach; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- Hapus Akun Modal-->
<form action="<?= base_url('akun/hapusakun/') . $akun['username']; ?>" method="post">
  <div class="modal fade" id="deleteAkunModal<?= $akun['username']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteAkunModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus akun anda dengan nama pengguna <?= $akun['username']; ?> ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            Masukkan kata sandi dan klik "Hapus" jika Anda ingin hapus.
          </div>
          <div class="form-group">
            <label for="verify_password_akundelete">Kata Sandi</label>
            <input type="password" class="form-control" id="verify_password_akundelete" name="verify_password_akundelete">
            <small>Untuk menghapus akun, silahkan masukkan kata sandi</small>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Kembali</button>
          <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus Akun</button>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- Akhir Akun Modal -->