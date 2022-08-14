<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('/') ?>">
        <div>
            <img class="logo" src="<?= base_url('assets/img/favicon.ico') ?>" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">SIAO</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- LOOPING MENU-->
    <?php foreach ($sidebar_menu as $m) : ?>
        <div class="sidebar-heading">
            <?= $m['menu'] ?>
        </div>
        <!-- SIAPKAN SUB MENU SESUAI MENU-->
        <?php
        $menu_id = $m['id'];
        $this->db->select('*');
        $this->db->from('akun_sub_menu');
        $this->db->join('akun_menu', 'akun_sub_menu.menu_id = akun_menu.id');
        $this->db->where('akun_sub_menu.menu_id', $menu_id);
        $this->db->where('akun_sub_menu.aktif', 1);
        $subMenu = $this->db->get('')->result_array();
        ?>
        <?php foreach ($subMenu as $sm) : ?>
            <?php if ($title == "SIAO | " . $sm['title']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
                </li>
            <?php endforeach; ?>
            <!-- Divider -->
            <hr class="sidebar-divider mt-3">
        <?php endforeach; ?>
        <!-- Nav Item - User -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/keluar'); ?>" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
                <span> Keluar</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
</ul>
<!-- End of Sidebar -->