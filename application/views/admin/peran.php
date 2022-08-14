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
          <div class="table-responsive">
            <a href="" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#newRoleModal"><i class="fas fa-plus"></i> Tambah Peran Baru</a>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Peran</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($role as $r) : ?>
                  <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $r['role'] ?></td>
                    <td>
                      <a href="" class="btn btn-warning btn-icon-split btn-sm" data-toggle="modal" data-target="#aksesRoleModal<?= $r['id']; ?>">
                        <span class="icon text-white-50">
                          <i class="fas fa-exclamation-triangle"></i>
                        </span>
                        <span class="text">Akses</span>
                      </a>
                      <div class="my-2"></div>
                      <a href="" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#editRoleModal<?= $r['id']; ?>">
                        <span class="icon text-white-50">
                          <i class="fas fa-edit"></i>
                        </span>
                        <span class="text">Edit</span>
                      </a>
                      <div class="my-2"></div>
                      <a href="" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#deleteRoleModal<?= $r['id']; ?>">
                        <span class="icon text-white-50">
                          <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Hapus</span>
                      </a>
                    </td>
                  </tr>
                  <?php $i++; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Tambah Role Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newRoleModalLabel">Tambah Peran Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('admin/role') ?>" method="post">
          <div class="form-group">
            <input type="text" class="form-control" id="role" name="role" placeholder="Nama Peran">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Kembali</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Role Modal -->
<?php foreach ($role as $r) : ?>
  <div class="modal fade" id="editRoleModal<?= $r['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editRoleModalLabel">Edit Peran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('admin/editperan') ?>" method="post">
            <div class="form-group">
              <input type="hidden" class="form-control" id="id" name="id" value="<?= $r['id']; ?>">
              <input type="text" class="form-control" id="role" name="role" value="<?= $r['role'] ?>">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Kembali</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Edit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<!-- Hapus Role Modal-->
<?php foreach ($role as $r) : ?>
  <div class="modal fade" id="deleteRoleModal<?= $r['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus peran <?= $r['role']; ?> ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik "Hapus" jika Anda ingin hapus.
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Kembali</button>
          <a class="btn btn-danger" href="<?= base_url('admin/hapusperan/') . $r['id']; ?>"><i class="fas fa-trash"></i> Hapus</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- Akses Role Modal-->
<?php foreach ($role as $r) : ?>
  <div class="modal fade" id="aksesRoleModal<?= $r['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="aksesRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Ubah Akses Peran <?= $r['role'] ?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Menu</th>
                  <th scope="col">Akses</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($menu as $m) : ?>
                  <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $m['menu'] ?></td>
                    <td>
                      <div class="form-check">
                        <input class="form-check-input akses-peran" type="checkbox" <?= check_access($r['id'], $m['id']); ?> data-role="<?= $r['id']; ?>" data-menu="<?= $m['id']; ?>">
                      </div>
                    </td>
                  </tr>
                  <?php $i++; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Kembali</button>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>