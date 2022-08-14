<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= str_replace("SIAO | ", "", $title); ?></h1>
    <div class="row">
        <div class="col-lg-12 col">
            <?= form_error('title', '<div class="alert alert-danger">', '</div>'); ?>
            <?= form_error('menu_id', '<div class="alert alert-danger">', '</div>'); ?>
            <?= form_error('url', '<div class="alert alert-danger">', '</div>'); ?>
            <?= form_error('icon', '<div class="alert alert-danger">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <a href="" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-plus"></i> Tambah Submenu Baru</a>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Submenu</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Tautan</th>
                                    <th scope="col">Ikon</th>
                                    <th scope="col">Aktif</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($subMenu as $sm) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $sm['title'] ?></td>
                                        <td><?= $sm['menu'] ?></td>
                                        <td><?= $sm['url'] ?></td>
                                        <td><?= $sm['icon'] ?></td>
                                        <td><?= $sm['aktif'] ?></td>
                                        <td>
                                            <a href="" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#editSubMenuModal<?= $sm['id']; ?>">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                <span class="text">Edit</span>
                                            </a>
                                            <div class="my-2"></div>
                                            <a href="" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#deleteSubMenuModal<?= $sm['id']; ?>">
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
<!--Tambah Submenu Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Tambah Submenu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('menu/submenu') ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Nama Sub Menu">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="menu_id" id="menu_id">
                            <option value="">Pilih Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Tautan Submenu">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Ikon Submenu">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="aktif" id="aktif" checked>
                            <label class="form-check-label" for="aktif">Aktif?</label>
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
<!--Edit Submenu Modal -->
<?php foreach ($subMenu as $sm) : ?>
    <div class="modal fade" id="editSubMenuModal<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editSubMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubMenuModalLabel">Edit Submenu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('menu/submenuedit') ?>" method="post">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $sm['id']; ?>">
                            <input type="text" class="form-control" id="title" name="title" value="<?= $sm['title']; ?>">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="menu_id" id="menu_id">
                                <option value="">Pilih Menu</option>
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id']; ?>" <?= $sm['menu_id'] == $m['id'] ? 'selected' : null  ?>><?= $m['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="url" name="url" value="<?= $sm['url']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="icon" name="icon" value="<?= $sm['icon']; ?>">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="aktif" id="aktif" checked>
                                <label class="form-check-label" for="aktif">Aktif?</label>
                            </div>
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

<!-- Hapus Submenu Modal-->
<?php foreach ($subMenu as $sm) : ?>
    <div class="modal fade" id="deleteSubMenuModal<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteSubMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus submenu <?= $sm['title']; ?>?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik "Hapus" jika Anda ingin hapus.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Kembali</button>
                    <a class="btn btn-danger" href="<?= base_url('menu/submenudelete/') . $sm['id']; ?>"><i class="fas fa-trash"></i> Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>