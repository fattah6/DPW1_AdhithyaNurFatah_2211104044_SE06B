CREATE TABLE `divisi` (
  `id_divisi` int(11) PRIMARY KEY,
  `ketua_divisi_id` int(11),
  `id_user` int(11)
);

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(11) PRIMARY KEY,
  `id_user` int(11),
  `kegiatan` text,
  `tanggal_kegiatan` datetime,
  `status` tinyint(1)
);

CREATE TABLE `role` (
  `id_role` int(11) PRIMARY KEY,
  `nama` varchar(20)
);

CREATE TABLE `user` (
  `id_user` int(11) PRIMARY KEY,
  `id_role` int(11),
  `nama_user` varchar(20),
  `username` varchar(20),
  `password` varchar(20)
);

ALTER TABLE `kegiatan` ADD FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

ALTER TABLE `divisi` ADD FOREIGN KEY (`ketua_divisi_id`) REFERENCES `user` (`id_user`);

ALTER TABLE `divisi` ADD FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

ALTER TABLE `user` ADD FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
