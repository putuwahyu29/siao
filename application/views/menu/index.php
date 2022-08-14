<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= str_replace("SIAO | ", "", $title); ?></h1>
    <div class="row">
        <div class="col-lg-12 col">
            <?= form_error('menu', '<div class="alert alert-danger">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <a href="" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#newMenuModal"><i class="fas fa-plus"></i> Tambah Menu Baru</a>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($menu as $m) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $m['menu'] ?></td>
                                        <td>
                                            <a href="" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#editMenuModal<?= $m['id']; ?>">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                <span class="text">Edit</span>
                                            </a>
                                            <div class="my-2"></div>
                                            <a href="" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#deleteMenuModal<?= $m['id']; ?>">
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
<!--Tambah Menu Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Tambah Menu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('menu') ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Nama Menu">
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
<!--Edit Menu Modal -->
<?php foreach ($menu as $m) : ?>
    <div class="modal fade" id="editMenuModal<?= $m['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('menu/menuedit') ?>" method="post">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $m['id']; ?>">
                            <input type="text" class="form-control" id="menu" name="menu" value="<?= $m['menu']; ?>">
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
<!-- Hapus Menu Modal-->
<?php foreach ($menu as $m) : ?>
    <div class="modal fade" id="deleteMenuModal<?= $m['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus menu <?= $m['menu']; ?>?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik "Hapus" jika Anda ingin hapus.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Kembali</button>
                    <a class="btn btn-danger" href="<?= base_url('menu/menudelete/') . $m['id']; ?>"><i class="fas fa-trash"></i> Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>