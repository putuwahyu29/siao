SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `aktif` int(1) NOT NULL,
  `tgl_dibuat` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`nama`, `username`, `email`, `gambar`, `password`, `akun_id`, `aktif`, `tgl_dibuat`) VALUES
('Super Admin', 'admin', 'admin@admin.com', 'default.jpg', '$2y$10$M9pTc47mFPRdq.lX6oSIZuVBru23hty5xNBAgbKaEbVEQaHIBBA/q', 3, 1, 1657381211);

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_access_menu`
--

CREATE TABLE `akun_access_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `akun_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun_access_menu`
--

INSERT INTO `akun_access_menu` (`akun_id`, `menu_id`) VALUES
(1,1),
(1,2),
(1,3),
(2,2),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5);


-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_menu`
--

CREATE TABLE `akun_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data untuk tabel `akun_menu`
--

INSERT INTO `akun_menu` (`menu`) VALUES
('Dasbor'),
('Akun'),
('Keanggotaan'),
('Menu'),
('Admin');



-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_role`
--

CREATE TABLE `akun_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun_role`
--

INSERT INTO `akun_role` (`role`) VALUES
('Administrator'),
('Anggota'),
('Super Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_sub_menu`
--

CREATE TABLE `akun_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `aktif` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data untuk tabel `akun_sub_menu`
--

INSERT INTO `akun_sub_menu` ( `menu_id`, `title`, `url`, `icon`, `aktif`) VALUES
(1, 'Dasbor', 'dasbor', 'fas fa-fw fa-tachometer-alt', 1),
(1, 'Anggota', 'dasbor/anggota', 'fas fa-fw fa-users', 1),
(2, 'Profil Saya', 'akun', 'fas fa-fw fa-user', 1),
(2, 'Edit Profil', 'akun/edit', 'fas fa-fw fa-user-edit', 1),
(2, 'Ubah Kata Sandi', 'akun/ubahkatasandi', 'fas fa-fw fa-key', 1),
(2, 'Pengaturan Akun', 'akun/pengaturan', 'fas fa-fw fa-user-cog', 1),
(3, 'Daftar Anggota', 'keanggotaan', 'fas fa-fw fa-address-book', 1),
(4, 'Pengaturan Menu', 'menu', 'fas fa-fw fa-folder', 1),
(4, 'Pengaturan Submenu', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(5, 'Pengaturan Admin', 'admin', 'fas fa-fw fa-user-secret', 1),
(5, 'Pengaturan Basis Data', 'admin/basisdata', 'fas fa-fw fa-database', 1),
(5, 'Pengaturan Peran', 'admin/peran', 'fas fa-fw fa-user-tie', 1),
(5, 'Pengaturan Pengguna', 'admin/pengguna', 'fas fa-fw fa-users-cog', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_token`
--

CREATE TABLE `akun_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `tgl_dibuat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_anggota`
--

CREATE TABLE `detail_anggota` (
  `nama_panggilan` varchar(125) DEFAULT NULL,
  `nim` varchar(10) DEFAULT NULL,
  `jenis_kelamin` varchar(9) DEFAULT NULL,
  `jabatan` varchar(10) DEFAULT NULL,
  `kelas` varchar(5) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `ukm` varchar(255) DEFAULT NULL,
  `angkatan` int(11) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `asal_kabkot` varchar(13) DEFAULT NULL,
  `alamat_rmh` text,
  `alamat_kos` text,
  `username` varchar(125) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_anggota`
--

INSERT INTO `detail_anggota` (`username`) VALUES
('admin');



