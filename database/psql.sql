--
-- Struktur dari tabel `akun`
--

create table akun
(
    id         serial
        primary key,
    nama       varchar(128) not null,
    username   varchar(128) not null
        unique,
    email      varchar(128) not null,
    gambar     varchar(128) not null,
    password   varchar(256) not null,
    akun_id    integer      not null,
    aktif      integer      not null,
    tgl_dibuat integer      not null
);


--
-- Dumping data untuk tabel `akun`
--

insert into public.akun (nama, username, email, gambar, password, akun_id, aktif, tgl_dibuat)
values  ('Super Admin', 'admin', 'admin@admin.com', 'default.jpg', '$2y$10$M9pTc47mFPRdq.lX6oSIZuVBru23hty5xNBAgbKaEbVEQaHIBBA/q', 3, 1, 1657381211);

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_access_menu`
--


create table akun_access_menu
(
    id      serial
        primary key,
    akun_id integer not null,
    menu_id integer not null
);



--
-- Dumping data untuk tabel `akun_access_menu`
--
insert into public.akun_access_menu (akun_id, menu_id)
values 
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

create table akun_menu
(
    id   serial
        primary key,
    menu varchar(128) not null
);



--
-- Dumping data untuk tabel `akun_menu`
--

insert into public.akun_menu (menu)
values  ('dasbor'),
        ('akun'),
        ('keanggotaan'),
        ('menu'),
        ('admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_role`
--

create table akun_role
(
    id   serial
        primary key,
    role varchar(100) not null
);



--
-- Dumping data untuk tabel `akun_role`
--
insert into public.akun_role (role)
values  ('Administrator'),
        ('Anggota'),
        ('Super Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_sub_menu`
--

create table akun_sub_menu
(
    id      serial
        primary key,
    menu_id integer      not null,
    title   varchar(128) not null,
    url     varchar(128) not null,
    icon    varchar(128) not null,
    aktif   integer      not null
);




--
-- Dumping data untuk tabel `akun_sub_menu`
--
insert into public.akun_sub_menu (menu_id, title, url, icon, aktif)
values  
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

--
-- Struktur dari tabel `akun_token`
--

create table akun_token
(
    id         serial
        primary key,
    email      varchar(128) not null,
    token      varchar(128) not null,
    tgl_dibuat integer      not null
);




--
-- Struktur dari tabel `detail_anggota`
--

create table detail_anggota
(
    nama_panggilan varchar(125) default NULL::character varying,
    nim varchar(10) default NULL::character varying,
    jenis_kelamin  varchar(9)   default NULL::character varying,
    jabatan        varchar(10)  default NULL::character varying,
    kelas          varchar(5)   default NULL::character varying,
    no_hp          varchar(15)   default NULL::character varying,
    ukm          varchar(255)   default NULL::character varying,
    angkatan       integer,
    tgl_lahir      date,
    asal_kabkot    varchar(13)  default NULL::character varying,
    alamat_rmh     text,
    alamat_kos     text,
    username       varchar(125) not null
        primary key
);



--
-- Dumping data untuk tabel `detail_anggota`
--

insert into public.detail_anggota (username)
values  ('admin');