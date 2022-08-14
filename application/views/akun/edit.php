<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= str_replace("SIAO | ", "", $title); ?></h1>
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <?= form_open_multipart('akun/edit') ?>
                    <?php foreach ($detail as $dt) : ?>
                        <?php if ($akun['username'] == $dt['username']) : ?>
                            <div class="form-group">
                                <label for="gambar">Foto Profil</label>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/img/profile/') . $dt["gambar"] ?>" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="my-2"></div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                            <label class="custom-file-label" for="customFile">Pilih file*</label>
                                            <small class="form-text text-muted">*Ukuran file maksimal foto profil sebesar 512KB.</small>
                                            <small class="form-text text-muted">*Format file foto profil yang didukung yaitu jpg, gif dan png.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username">Nama Pengguna</label>
                                <input type="text" class="form-control" value="<?= $dt['username'] ?>" id="username" name="username" readonly="readonly">
                                <?= form_error('username', '<small class="text-small text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="<?= $dt["email"]; ?>" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" value="<?= $dt['nama']; ?>" id="nama" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="nama_panggilan">Nama Panggilan</label>
                                <input type="text" class="form-control" value="<?= $dt['nama_panggilan']; ?>" id="nama_panggilan" name="nama_panggilan">
                            </div>
                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input type="text" class="form-control" value="<?= $dt['nim']; ?>" id="nim" name="nim">
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="form-group">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="jenis_kelamin" id="lk" value="Laki-Laki" <?php if ($dt["jenis_kelamin"] == "Laki-Laki") echo "checked"; ?> class="custom-control-input" checked>
                                        <label class="custom-control-label" for="lk">Laki-laki</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="jenis_kelamin" id="pr" value="Perempuan" <?php if ($dt["jenis_kelamin"] != "Laki-Laki") echo "checked"; ?> class="custom-control-input">
                                        <label class="custom-control-label" for="pr">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <select name="jabatan" class="selectpicker form-control" id="jabatan" title="Pilih Jabatan" data-style-base="form-control" data-style="">
                                    <option value="Ketua" <?php if ($dt["jabatan"] == "Ketua") echo "selected"; ?>>Ketua </option>
                                    <option value="Wakil Ketua" <?php if ($dt["jabatan"] == "Wakil Ketua") echo "selected"; ?>>Wakil Ketua</option>
                                    <option value="Bendahara" <?php if ($dt["jabatan"] == "Bendahara") echo "selected"; ?>>Bendahara</option>
                                    <option value="Sekretaris" <?php if ($dt["jabatan"] == "Sekretaris") echo "selected"; ?>>Sekretaris</option>
                                    <option value="Koordinator" <?php if ($dt["jabatan"] == "Koordinator") echo "selected"; ?>>Koordinator</option>
                                    <option value="Anggota" <?php if ($dt["jabatan"] == "Anggota") echo "selected"; ?>>Anggota</option>
                                    <option value="Alumni" <?php if ($dt["jabatan"] == "Alumni") echo "selected"; ?>>Alumni</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <input type="text" class="form-control" value="<?= $dt['kelas']; ?>" id="kelas" name="kelas">
                            </div>
                            <div class="form-group">
                                <label for="no_hp">Nomor Hp</label>
                                <input type="text" class="form-control" value="<?= $dt['no_hp']; ?>" id="no_hp" name="no_hp">
                            </div>
                            <div class="form-group">
                                <label for="ukm">Unit Kegiatan Mahasiswa</label>
                                <select name="ukm[]" class="selectpicker form-control" id="ukm" multiple title="<?= $dt['ukm'] ?>" data-live-search="true" data-none-results-text="Tidak ditemukan UKM {0}" data-style-base="form-control" data-style="">
                                    <optgroup label="UKM Kerohanian">
                                        <option value="Rohani Islam" <?php if ($dt["ukm"] == "Rohani Islam") echo "selected"; ?>>Rohani Islam </option>
                                        <option value="Rohani Kristen" <?php if ($dt["ukm"] == "Rohani Kristen") echo "selected"; ?>>Rohani Kristen </option>
                                        <option value="Rohani Hindu" <?php if ($dt["ukm"] == "Rohani Hindu") echo "selected"; ?>>Rohani Hindu </option>
                                    </optgroup>
                                    <optgroup label="UKM Kesenian">
                                        <option value="Bidang Excelsior" <?php if ($dt["ukm"] == "Bidang Excelsior") echo "selected"; ?>>Bidang Excelsior </option>
                                        <option value="Bidang Teater Antik" <?php if ($dt["ukm"] == "Bidang Teater Antik") echo "selected"; ?>>Bidang Teater Antik </option>
                                        <option value="Bidang Paradise" <?php if ($dt["ukm"] == "Bidang Paradise") echo "selected"; ?>>Bidang Paradise </option>
                                        <option value="Bidang Xbar" <?php if ($dt["ukm"] == "Bidang Xbar") echo "selected"; ?>>Bidang Xbar </option>
                                    </optgroup>
                                    <option value="UKM Kewirausahaan" <?php if ($dt["ukm"] == "UKM Kewirausahaan") echo "selected"; ?>>UKM Kewirausahaan </option>
                                    <option value="UKM Media Kampus" <?php if ($dt["ukm"] == "UKM Media Kampus") echo "selected"; ?>>UKM Media Kampus </option>
                                    <optgroup label="UKM Olahraga">
                                        <option value="Bidang Bola" disabled>Bidang Bola</option>
                                        <option value="Divisi Futsal" <?php if ($dt["ukm"] == "Divisi Futsal") echo "selected"; ?>>Divisi Futsal </option>
                                        <option value="Divisi Bulstik" <?php if ($dt["ukm"] == "Divisi Bulstik") echo "selected"; ?>>Divisi Bulstik </option>
                                        <option value="Divisi Basket" <?php if ($dt["ukm"] == "Divisi Basket") echo "selected"; ?>>Divisi Basket </option>
                                        <option value="Divisi Voli" <?php if ($dt["ukm"] == "Divisi Voli") echo "selected"; ?>>Divisi Voli </option>
                                        <option value="Divisi Tenis Lapangan" <?php if ($dt["ukm"] == "Divisi Tenis Lapangan") echo "selected"; ?>>Divisi Tenis Lapangan </option>
                                        <option value="Bidang Strategi" disabled>Bidang Strategi</option>
                                        <option value="Divisi Catur" <?php if ($dt["ukm"] == "Divisi Catur") echo "selected"; ?>>Divisi Catur </option>
                                        <option value="Divisi Bridge" <?php if ($dt["ukm"] == "Divisi Bridge") echo "selected"; ?>>Divisi Bridge </option>
                                        <option value="Divisi Billiard" <?php if ($dt["ukm"] == "Divisi Billiard") echo "selected"; ?>>Divisi Billiard </option>
                                        <option value="Bidang Beladiri dan Kebugaran" disabled>Bidang Beladiri dan Kebugaran</option>
                                        <option value="Divisi Silat" <?php if ($dt["ukm"] == "Divisi Silat") echo "selected"; ?>>Divisi Silat </option>
                                        <option value="Divisi Taekwondo" <?php if ($dt["ukm"] == "Divisi Taekwondo") echo "selected"; ?>>Divisi Taekwondo </option>
                                        <option value="Divisi Senam" <?php if ($dt["ukm"] == "Divisi Senam") echo "selected"; ?>>Divisi Senam </option>
                                        <option value="Bidang Esport" <?php if ($dt["ukm"] == "Bidang Esport") echo "selected"; ?>>Bidang Esport </option>
                                    </optgroup>
                                    <optgroup label="UKM Pendidikan dan Kebudayaan">
                                        <option value="Bidang Komnet" <?php if ($dt["ukm"] == "Bidang Komnet") echo "selected"; ?>>Bidang Komnet </option>
                                        <option value="Bidang Bimbel" <?php if ($dt["ukm"] == "Bidang Bimbel") echo "selected"; ?>>Bidang Bimbel </option>
                                        <option value="Bidang Forkas" <?php if ($dt["ukm"] == "Bidang Forkas") echo "selected"; ?>>Bidang Forkas </option>
                                        <option value="Bidang Sastra dan Budaya" disabled>Bidang Sastra dan Budaya</option>
                                        <option value="Divisi SES" <?php if ($dt["ukm"] == "Divisi SES") echo "selected"; ?>>Divisi SES </option>
                                        <option value="Divisi Nihongobu" <?php if ($dt["ukm"] == "Divisi Nihongobu") echo "selected"; ?>>Divisi Nihongobu </option>
                                    </optgroup>
                                    <optgroup label="UKM PMKL">
                                        <option value="KSR PMI" <?php if ($dt["ukm"] == "KSR PMI") echo "selected"; ?>>KSR PMI </option>
                                        <option value="GPA Cheby" <?php if ($dt["ukm"] == "GPA Cheby") echo "selected"; ?>>GPA Cheby </option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" value="<?= $dt['tgl_lahir'] ?>" id=" tgl_lahir" name="tgl_lahir">
                            </div>
                            <div class="form-group">
                                <label for="angkatan">Angkatan</label>
                                <input type="number" class="form-control" name="angkatan" id="angkatan" min="1" max="100" value="<?= $dt['angkatan'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="asal_kabkot">Asal Kab/Kota</label>
                                <select name="asal_kabkot" class="selectpicker form-control" id="asal_kabkot" title="Pilih Asal Kab/Kota" data-live-search="true" data-none-results-text="Tidak ditemukan kabupaten/kota {0}" data-style-base="form-control" data-style="">
                                    <option value="Kota Mataram" <?php if ($dt["asal_kabkot"] == "Kota Mataram") echo "selected"; ?>>Kota Mataram </option>
                                    <option value="Lombok Barat" <?php if ($dt["asal_kabkot"] == "Lombok Barat") echo "selected"; ?>>Lombok Barat</option>
                                    <option value="Lombok Tengah" <?php if ($dt["asal_kabkot"] == "Lombok Tengah") echo "selected"; ?>>Lombok Tengah</option>
                                    <option value="Lombok Timur" <?php if ($dt["asal_kabkot"] == "Lombok Timur") echo "selected"; ?>>Lombok Timur</option>
                                    <option value="Lombok Utara" <?php if ($dt["asal_kabkot"] == "Lombok Utara") echo "selected"; ?>>Lombok Utara</option>
                                    <option value="Sumbawa Barat" <?php if ($dt["asal_kabkot"] == "Sumbawa Barat") echo "selected"; ?>>Sumbawa Barat</option>
                                    <option value="Sumbawa" <?php if ($dt["asal_kabkot"] == "Sumbawa") echo "selected"; ?>>Sumbawa</option>
                                    <option value="Bima" <?php if ($dt["asal_kabkot"] == "Bima") echo "selected"; ?>>Bima </option>
                                    <option value="Dompu" <?php if ($dt["asal_kabkot"] == "Dompu") echo "selected"; ?>>Dompu</option>
                                    <option value="Kota Bima" <?php if ($dt["asal_kabkot"] == "Kota Bima") echo "selected"; ?>>Kota Bima</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat_rmh">Alamat Rumah</label>
                                <div class="form-group">
                                    <textarea name="alamat_rmh" class="form-control" id="alamat_rmh" cols="80" rows="7"><?= $dt["alamat_rmh"]; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat_kos">Alamat Kos</label>
                                <div class="form-group">
                                    <textarea name="alamat_kos" class="form-control" id="alamat_kos" cols="80" rows="7"><?= $dt["alamat_kos"]; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="id" id="id">
                                    <label class="form-check-label" for="id">Saya menyetujui data yang saya isi benar dan akan dipergunakan untuk urusan organinasi Rinjani STIS</label>
                                </div>
                                <?= form_error('id', '<small class="text-small text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#verifyPasswordModal"><i class="fas fa-save"></i> Simpan Perubahan</a>
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