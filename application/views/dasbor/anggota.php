<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= str_replace("SIAO | ", "", $title); ?></h1>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <a href="<?= base_url('dasbor/cetak') ?>" class="btn btn-info btn-sm mb-3"><i class="fa fa-print"></i> Cetak</a>
        <a href="<?= base_url('dasbor/ekspor') ?>" class="btn btn-success btn-sm mb-3"><i class="fa fa-download"></i> Ekspor Excel</a>
        <table class="table table-bordered" id="dataTabelKeanggotaan" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nama Lengkap</th>
              <th>Nama Panggilan</th>
              <th>NIM</th>
              <th>Kelas</th>
              <th>Angkatan</th>
              <th>Asal Kab/Kota</th>
              <th>Alamat Kos</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($anggota as $agt) : ?>
              <tr>
                <td><?= ($agt['nama'] != '') ? $agt['nama'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['nama_panggilan'] != '') ? $agt['nama_panggilan'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['nim'] != '') ? $agt['nim'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['kelas'] != '') ? $agt['kelas'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['angkatan'] != '') ? $agt['angkatan'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['asal_kabkot'] != '') ? $agt['asal_kabkot'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['alamat_kos'] != '') ? $agt['alamat_kos'] : 'Belum tersedia';  ?></td>
                <td>
                  <a href="" class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#detailModal<?= $agt['id']; ?>">
                    <span class="icon text-white-50">
                      <i class="fas fa-info-circle"></i>
                    </span>
                    <span class="text">Lihat</span>
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
                  <p class="card-text">Email : <?= ($agt['email'] != '') ? $agt['email'] : 'Belum tersedia';  ?></p>
                  <p class="card-text">No Hp : <?= ($agt['no_hp'] != '') ? $agt['no_hp'] : 'Belum tersedia';  ?></p>
                  <p class="card-text">UKM : <?= ($agt['ukm'] != '') ? $agt['ukm'] : 'Belum tersedia';  ?></p>
                  <p class="card-text">NIM : <?= ($agt['nim'] != '') ? $agt['nim'] : 'Belum tersedia';  ?></p>
                  <p class="card-text">Jenis Kelamin : <?= ($agt['jenis_kelamin'] != '') ? $agt['jenis_kelamin'] : 'Belum tersedia';  ?></p>
                  <p class="card-text">Jabatan : <?= ($agt['jabatan'] != '') ? $agt['jabatan'] : 'Belum tersedia';  ?></p>
                  <p class="card-text">Kelas : <?= ($agt['kelas'] != '') ? $agt['kelas'] : 'Belum tersedia';  ?></p>
                  <p class="card-text">Angkatan : <?= ($agt['angkatan'] != '') ? $agt['angkatan'] : 'Belum tersedia';  ?></p>
                  <p class="card-text">Tanggal Lahir : <?= ($agt['tgl_lahir'] != '') ? date("d/m/Y", strtotime($agt['tgl_lahir']))  : 'Belum tersedia';  ?></p>
                  <p class="card-text">Asal Kabupaten/Kota : <?= ($agt['asal_kabkot'] != '') ? $agt['asal_kabkot'] : 'Belum tersedia';  ?></p>
                  <p class="card-text">Alamat Rumah : <?= ($agt['alamat_rmh'] != '') ? $agt['alamat_rmh'] : 'Belum tersedia';  ?></p>
                  <p class="card-text">Alamat Kos : <?= ($agt['alamat_kos'] != '') ? $agt['alamat_kos'] : 'Belum tersedia';  ?></p>
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