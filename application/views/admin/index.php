<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= str_replace("SIAO | ", "", $title); ?></h1>
    <div class="row">
        <div class="col-lg-12 col">
            <?= form_error('username', '<div class="alert alert-danger">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <a href="" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#newRoleModal"><i class="fas fa-plus"></i> Tambah Admin Baru</a>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Nama Pengguna</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($admin as $a) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $a['nama'] ?></td>
                                        <td><?= $a['username'] ?></td>
                                        <td><?= $a['email'] ?></td>
                                        <td>
                                            <a href="" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#deleteRoleModal<?= $a['id']; ?>">
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
<!-- Tambah Role Admin Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Tambah Admin Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin') ?>" method="post">
                    <div class="form-group">
                        <label for="username">Tambah Admin Baru</label>
                        <select name="username" class="form-control selectpicker" id="username" data-live-search="true" title="Pilih Nama Lengkap">
                            <?php foreach ($anggota as $agt) : ?>
                                <option data-subtext="<?= $agt['username']; ?>" value="<?= $agt['username']; ?>">
                                    <?= $agt['nama']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="akun_id" id="akun_id" checked>
                            <label class="form-check-label" for="akun_id">Jadikan Admin?
                            </label>
                        </div>
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
<!-- Hapus Role Admin Modal-->
<?php foreach ($admin as $a) : ?>
    <div class="modal fade" id="deleteRoleModal<?= $a['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus admin ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/hapusadmin/') ?>" method="post">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="2" name="akun_id" id="akun_id" checked>
                                <label class="form-check-label" for="akun_id">
                                    Centang dan Klik "Hapus" jika Anda ingin hapus
                                    <input type="text" class="form-control" value="<?= $a['username'] ?>" id="username" name="username" readonly="readonly">
                                    sebagai admin.
                                </label>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Kembali</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>