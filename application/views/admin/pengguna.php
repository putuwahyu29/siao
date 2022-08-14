<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= str_replace("SIAO | ", "", $title); ?></h1>
  <?= $this->session->flashdata('message'); ?>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTabelKeanggotaan" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nama Lengkap</th>
              <th>Nama Pengguna</th>
              <th>Bergabung Sejak</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($anggota as $agt) : ?>
              <tr>
                <td><?= ($agt['nama'] != '') ? $agt['nama'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['username'] != '') ? $agt['username'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['tgl_dibuat'] != '') ?  date('d/m/Y', $agt['tgl_dibuat']) : 'Belum tersedia';  ?></td>
                <td>
                  <?= ($agt['aktif'] == 0) ? '<a href="" class="btn btn-success btn-icon-split btn-sm" data-toggle="modal" data-target="#aktifkanModal' . $agt["id"] . '">
                    <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Aktifkan</span>
                  </a>' : '';  ?>
                  <div class="my-2"></div>
                  <?= ($agt['aktif'] == 1) ? '<a href="" class="btn btn-warning btn-icon-split btn-sm" data-toggle="modal" data-target="#nonaktifkanModal' . $agt["id"] . '">
                    <span class="icon text-white-50">
                      <i class="fas fa-times"></i>
                    </span>
                    <span class="text">Nonaktifkan</span>
                  </a>' : '';  ?>
                  <div class="my-2"></div>
                  <a href="" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#deleteModal<?= $agt['id']; ?>">
                    <span class="icon text-white-50">
                      <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Hapus</span>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Hapus Pengguna Modal-->
<?php foreach ($anggota as $agt) : ?>
  <div class="modal fade" id="deleteModal<?= $agt['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus anggota <?= $agt['username']; ?> ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik "Hapus" jika Anda ingin hapus.
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Kembali</button>
          <a class="btn btn-danger" href="<?= base_url('admin/hapusanggota/') . $agt['username']; ?>"><i class="fas fa-trash"></i> Hapus</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- Aktifkan Penggunqa Modal-->
<?php foreach ($anggota as $agt) : ?>
  <div class="modal fade" id="aktifkanModal<?= $agt['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="aktifkanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin mengaktifkan pengguna <?= $agt['username']; ?> ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik "Aktifkan" jika Anda ingin aktifkan.
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Kembali</button>
          <a class="btn btn-success" href="<?= base_url('admin/aktifkan/') . $agt['username']; ?>"><i class="fas fa-check"></i> Aktifkan</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- Nonaktifkan Penggunqa Modal-->
<?php foreach ($anggota as $agt) : ?>
  <div class="modal fade" id="nonaktifkanModal<?= $agt['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="nonaktifkanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin mengnonaktifkan pengguna <?= $agt['username']; ?> ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik "Nonaktifkan" jika Anda ingin nonaktifkan.
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Kembali</button>
          <a class="btn btn-warning" href="<?= base_url('admin/nonaktifkan/') . $agt['username']; ?>"><i class="fas fa-times"></i> Nonaktifkan</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>