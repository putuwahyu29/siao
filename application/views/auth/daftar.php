    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <a href="/"><img src="<?= base_url('assets/img/favicon.ico') ?>" alt="">
                                    <h1 class="h2 text-gray-900 font-weight-bold">SIAO</h1>
                                </a>
                                <h1 class="h4 text-gray-900 mb-4 mt-4">Halaman Daftar</h1>
                            </div>
                            <form class="user" method="post" action="<?= base_url('auth/daftar'); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Nama Pengguna" value="<?= set_value('username') ?>">
                                    <?= form_error('username', '<small class="text-small text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama') ?>">
                                    <?= form_error('nama', '<small class="text-small text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Alamat Email" value="<?= set_value('email') ?>">
                                    <?= form_error('email', '<small class="text-small text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Kata Sandi">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Konfirmasi Kata Sandi">
                                    </div>
                                    <?= form_error('password1', '<small class="text-small text-danger pl-3">', '</small>'); ?>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Daftar</button>
                                <hr>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth'); ?>">Sudah punya Akun? Silahkan masuk!</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth/lupakatasandi'); ?>">Lupa Kata Sandi?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright text-center text-white mb-5">
            <span>Copyright &copy; SIAO <?= date('Y'); ?></span>
        </div>
    </div>