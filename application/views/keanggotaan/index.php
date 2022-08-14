<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= str_replace("SIAO | ", "", $title); ?></h1>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTabelKeanggotaan" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Foto Profil</th>
              <th>Nama Lengkap</th>
              <th>Nama Panggilan</th>
              <th>NIM</th>
              <th>Kelas</th>
              <th>Angkatan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($anggota as $agt) : ?>
              <tr>
                <td><img src="<?= base_url('assets/img/profile/') . $agt['gambar']; ?>" class="img-fluid rounded-start" width="100x"></td>
                <td><?= ($agt['nama'] != '') ? $agt['nama'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['nama_panggilan'] != '') ? $agt['nama_panggilan'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['nim'] != '') ? $agt['nim'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['kelas'] != '') ? $agt['kelas'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['angkatan'] != '') ? $agt['angkatan'] : 'Belum tersedia';  ?></td>
                <td><a href="" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#detailModal<?= $agt['id']; ?>">
                    <span class="icon text-white-50">
                      <i class="fas fa-info-circle"></i>
                    </span>
                    <span class="text">Lihat</span>
                  </a></td>
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
<!-- Detail Modal-->
<?php foreach ($anggota as $agt) : ?>
  <div class="modal fade" id="detailModal<?= $agt['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalLabel">Detail Anggota</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $agt['gambar']; ?>" class="img-fluid rounded-start">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h4 class="card-title"><?= $agt['nama'] ?></h4>
                  <p class="card-text">Nama Panggilan : <?= ($agt['nama_panggilan'] != '') ? $agt['nama_panggilan'] : 'Belum tersedia';  ?></p>
                  <p class="card-text">UKM : <?= ($agt['ukm'] != '') ? $agt['ukm'] : 'Belum tersedia';  ?></p>
                  <p class="card-text">NIM : <?= ($agt['nim'] != '') ? $agt['nim'] : 'Belum tersedia';  ?></p>
                  <p class="card-text">Jenis Kelamin : <?= ($agt['jenis_kelamin'] != '') ? $agt['jenis_kelamin'] : 'Belum tersedia';  ?></p>
                  <p class="card-text">Jabatan : <?= ($agt['jabatan'] != '') ? $agt['jabatan'] : 'Belum tersedia';  ?></p>
                  <p class="card-text">Kelas : <?= ($agt['kelas'] != '') ? $agt['kelas'] : 'Belum tersedia';  ?></p>
                  <p class="card-text">Angkatan : <?= ($agt['angkatan'] != '') ? $agt['angkatan'] : 'Belum tersedia';  ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Kembali</button>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<!-- Hapus Anggota Modal-->
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