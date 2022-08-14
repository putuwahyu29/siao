<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= str_replace("SIAO | ", "", $title); ?></h1>
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div class="card shadow mb-4" style="max-width:350px">
        <div class="card-header ">
            <div class="d-flex justify-content-between">
                <img src="<?= base_url('assets/img/logo_rinjani.png'); ?>" class="img-fluid rounded-start" style="width:32px">
                <h5> Rinjani E Card</h5>
            </div>
        </div>
        <img src="<?= base_url('assets/img/profile/') . $akun['gambar']; ?>" class="img-fluid rounded-start">
        <div class="card-body">
            <p class="card-text">Nama : <?= ($akun['nama'] != '') ? $akun['nama'] : 'Belum tersedia';  ?></p>
            <p class="card-text">NIM : <?= ($akun['nim'] != '') ? $akun['nim'] : 'Belum tersedia';  ?></p>
            <p class="card-text">Email : <?= ($akun['email'] != '') ? $akun['email'] : 'Belum tersedia';  ?></p>
            <p class="card-text">Kelas : <?= ($akun['kelas'] != '') ? $akun['kelas'] : 'Belum tersedia';  ?></p>
            <p class="card-text">Angkatan : <?= ($akun['angkatan'] != '') ? $akun['angkatan'] : 'Belum tersedia';  ?></p>
        </div>
        <div class="card-footer">
            <p class="card-text"><small class="text-muted">Anggota sejak <?= date('d/m/Y', $akun['tgl_dibuat']); ?> </small></p>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->