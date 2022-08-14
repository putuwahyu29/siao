<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 mt-5 text-gray-800 text-center">Daftar Anggota</h1>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTabelKeanggotaan" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Nama Lengkap</th>
              <th>Nama Panggilan</th>
              <th>Jenis Kelamin</th>
              <th>Tanggal Lahir</th>
              <th>NIM</th>
              <th>Kelas</th>
              <th>Angkatan</th>
              <th>UKM</th>
              <th>No Hp</th>
              <th>Email</th>
              <th>Asal Kab/Kota</th>
              <th>Alamat Kos</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($anggota as $agt) : ?>
              <tr>
                <td><?= ($agt['nama'] != '') ? $agt['nama'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['nama_panggilan'] != '') ? $agt['nama_panggilan'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['jenis_kelamin'] != '') ? $agt['jenis_kelamin'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['tgl_lahir'] != '') ? $agt['tgl_lahir'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['nim'] != '') ? $agt['nim'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['kelas'] != '') ? $agt['kelas'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['angkatan'] != '') ? $agt['angkatan'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['ukm'] != '') ? $agt['ukm'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['no_hp'] != '') ? $agt['no_hp'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['email'] != '') ? $agt['email'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['asal_kabkot'] != '') ? $agt['asal_kabkot'] : 'Belum tersedia';  ?></td>
                <td><?= ($agt['alamat_kos'] != '') ? $agt['alamat_kos'] : 'Belum tersedia';  ?></td>
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
<script>
  window.print();
</script>
<style type="text/css" media="print">
  @page {
    size: landscape;
  }
</style>