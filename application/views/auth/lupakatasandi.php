<div class="container">
  <!-- Outer Row -->
  <div class="row justify-content-center">
    <div class="col-lg-7">
      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Lupa Kata Sandi ?</h1>
                </div>
                <?= $this->session->flashdata('message');
                session_destroy() ?>
                <form class="user" method="post" action="<?= base_url('auth/lupakatasandi'); ?>">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Masukkan Email..." value="<?= set_value('username'); ?>">
                    <?= form_error('email', '<small class="text-small text-danger pl-3">', '</small>'); ?>
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Atur Ulang Kata Sandi
                  </button>
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="<?= base_url('auth'); ?>">Kembali</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>