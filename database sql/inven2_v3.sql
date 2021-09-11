/*
 Navicat Premium Data Transfer

 Source Server         : LOCALHOST SERVER
 Source Server Type    : MySQL
 Source Server Version : 100417
 Source Host           : localhost:3306
 Source Schema         : inven2

 Target Server Type    : MySQL
 Target Server Version : 100417
 File Encoding         : 65001

 Date: 28/07/2021 10:36:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ms_barang
-- ----------------------------
DROP TABLE IF EXISTS `ms_barang`;
CREATE TABLE `ms_barang`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_barang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga_beli` bigint NULL DEFAULT NULL,
  `harga_jual` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_barang
-- ----------------------------
INSERT INTO `ms_barang` VALUES (2, 'BRG00001', 'barang satu', 1000, 1500);
INSERT INTO `ms_barang` VALUES (3, 'BRG00002', 'item kedua', 1500, 2000);

-- ----------------------------
-- Table structure for ms_customer
-- ----------------------------
DROP TABLE IF EXISTS `ms_customer`;
CREATE TABLE `ms_customer`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_customer` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_customer` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_customer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `tlp_customer` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_customer
-- ----------------------------
INSERT INTO `ms_customer` VALUES (2, 'CST00001', 'customer satu', 'alamat customer satu', '081');
INSERT INTO `ms_customer` VALUES (3, 'CST00002', 'customer dua', 'alamat customer dua', '085');

-- ----------------------------
-- Table structure for ms_jenis_trx
-- ----------------------------
DROP TABLE IF EXISTS `ms_jenis_trx`;
CREATE TABLE `ms_jenis_trx`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis_kas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'pemasukan dan pengeluaran',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ms_jenis_trx
-- ----------------------------
INSERT INTO `ms_jenis_trx` VALUES (1, 'Kas Masuk');
INSERT INTO `ms_jenis_trx` VALUES (2, 'Kas Keluar');

-- ----------------------------
-- Table structure for ms_kartu_stok
-- ----------------------------
DROP TABLE IF EXISTS `ms_kartu_stok`;
CREATE TABLE `ms_kartu_stok`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `tgl_dokumen` date NULL DEFAULT NULL,
  `kode_dokumen` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `type_dokumen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `item_id` int NULL DEFAULT NULL,
  `item_qty` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_kartu_stok
-- ----------------------------
INSERT INTO `ms_kartu_stok` VALUES (3, '2021-07-26', 'TRX-GR-00001', 'GR', 2, 1);
INSERT INTO `ms_kartu_stok` VALUES (4, '2021-07-26', 'TRX-SO-00001', 'SO', 2, 1);

-- ----------------------------
-- Table structure for ms_periode
-- ----------------------------
DROP TABLE IF EXISTS `ms_periode`;
CREATE TABLE `ms_periode`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `bulan_periode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tahun_periode` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ms_periode
-- ----------------------------
INSERT INTO `ms_periode` VALUES (1, 'Januari', 2021);
INSERT INTO `ms_periode` VALUES (2, 'Februari', 2021);
INSERT INTO `ms_periode` VALUES (3, 'Maret', 2021);
INSERT INTO `ms_periode` VALUES (4, 'April', 2021);
INSERT INTO `ms_periode` VALUES (5, 'Mei', 2021);
INSERT INTO `ms_periode` VALUES (6, 'Juni', 2021);
INSERT INTO `ms_periode` VALUES (7, 'Juli', 2021);
INSERT INTO `ms_periode` VALUES (8, 'Agustus', 2021);
INSERT INTO `ms_periode` VALUES (9, 'September', 2021);
INSERT INTO `ms_periode` VALUES (10, 'Oktober', 2021);
INSERT INTO `ms_periode` VALUES (11, 'November', 2021);
INSERT INTO `ms_periode` VALUES (12, 'Desember', 2021);
INSERT INTO `ms_periode` VALUES (13, 'Januari', 2022);
INSERT INTO `ms_periode` VALUES (14, 'Februari', 2022);
INSERT INTO `ms_periode` VALUES (15, 'Maret', 2022);
INSERT INTO `ms_periode` VALUES (16, 'April', 2022);
INSERT INTO `ms_periode` VALUES (17, 'Mei', 2022);
INSERT INTO `ms_periode` VALUES (18, 'Juni', 2022);
INSERT INTO `ms_periode` VALUES (19, 'Juli', 2022);
INSERT INTO `ms_periode` VALUES (20, 'Agustus', 2022);
INSERT INTO `ms_periode` VALUES (21, 'September', 2022);
INSERT INTO `ms_periode` VALUES (22, 'Oktober', 2022);
INSERT INTO `ms_periode` VALUES (23, 'November', 2022);
INSERT INTO `ms_periode` VALUES (24, 'Desember', 2022);

-- ----------------------------
-- Table structure for ms_role
-- ----------------------------
DROP TABLE IF EXISTS `ms_role`;
CREATE TABLE `ms_role`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of ms_role
-- ----------------------------
INSERT INTO `ms_role` VALUES (1, 'admin');
INSERT INTO `ms_role` VALUES (2, 'direktur');

-- ----------------------------
-- Table structure for ms_suplier
-- ----------------------------
DROP TABLE IF EXISTS `ms_suplier`;
CREATE TABLE `ms_suplier`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_suplier` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_suplier` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_suplier` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `tlp_suplier` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ms_suplier
-- ----------------------------
INSERT INTO `ms_suplier` VALUES (2, 'SPL0001', 'suplier 1', 'alamat', '086');

-- ----------------------------
-- Table structure for ms_user
-- ----------------------------
DROP TABLE IF EXISTS `ms_user`;
CREATE TABLE `ms_user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NULL DEFAULT NULL,
  `nama` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `username` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of ms_user
-- ----------------------------
INSERT INTO `ms_user` VALUES (3, 1, 'Gagas Agus Bahtiar', 'admin', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `ms_user` VALUES (5, 2, 'tes user', 'password', '5f4dcc3b5aa765d61d8327deb882cf99');

-- ----------------------------
-- Table structure for tr_gr_d
-- ----------------------------
DROP TABLE IF EXISTS `tr_gr_d`;
CREATE TABLE `tr_gr_d`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `gr_id` int NULL DEFAULT NULL,
  `gr_po_id` int NULL DEFAULT NULL,
  `gr_item_id` int NULL DEFAULT NULL,
  `gr_item_qty` int NULL DEFAULT NULL,
  `gr_harga_beli_item` bigint NULL DEFAULT NULL,
  `gr_harga_jual_item` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tr_gr_d
-- ----------------------------
INSERT INTO `tr_gr_d` VALUES (3, 3, 3, 2, 1, 1000, 1500);

-- ----------------------------
-- Table structure for tr_gr_h
-- ----------------------------
DROP TABLE IF EXISTS `tr_gr_h`;
CREATE TABLE `tr_gr_h`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_gr` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_gr` date NULL DEFAULT NULL,
  `suplier_gr` int NULL DEFAULT NULL,
  `keterangan_gr` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `total_harga_beli_gr` bigint NULL DEFAULT NULL,
  `total_harga_jual_gr` bigint NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tr_gr_h
-- ----------------------------
INSERT INTO `tr_gr_h` VALUES (3, 'TRX-GR-00001', '2021-07-26', 0, 'teasdf ', 1000, 1500, 3);

-- ----------------------------
-- Table structure for tr_po_d
-- ----------------------------
DROP TABLE IF EXISTS `tr_po_d`;
CREATE TABLE `tr_po_d`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `po_id` int NULL DEFAULT NULL,
  `po_item_id` int NULL DEFAULT NULL,
  `po_item_qty` int NULL DEFAULT NULL,
  `po_harga_beli_item` bigint NULL DEFAULT NULL,
  `po_harga_jual_item` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tr_po_d
-- ----------------------------
INSERT INTO `tr_po_d` VALUES (3, 3, 2, 1, 1000, 1500);
INSERT INTO `tr_po_d` VALUES (4, 4, 2, 5, 1000, 1500);
INSERT INTO `tr_po_d` VALUES (5, 4, 3, 10, 1500, 2000);

-- ----------------------------
-- Table structure for tr_po_h
-- ----------------------------
DROP TABLE IF EXISTS `tr_po_h`;
CREATE TABLE `tr_po_h`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_po` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_po` date NULL DEFAULT NULL,
  `suplier_po` int NULL DEFAULT NULL,
  `keterangan_po` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `total_harga_beli_po` bigint NULL DEFAULT NULL,
  `total_harga_jual_po` bigint NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tr_po_h
-- ----------------------------
INSERT INTO `tr_po_h` VALUES (3, 'TRX-PO-00001', '2021-07-26', 2, 'tesat asdf', 1000, 1500, 3);
INSERT INTO `tr_po_h` VALUES (4, 'TRX-PO-00002', '2021-07-28', 2, 'test', 20000, 27500, 3);

-- ----------------------------
-- Table structure for tr_so_d
-- ----------------------------
DROP TABLE IF EXISTS `tr_so_d`;
CREATE TABLE `tr_so_d`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `so_id` int NULL DEFAULT NULL,
  `so_item_id` int NULL DEFAULT NULL,
  `so_item_qty` int NULL DEFAULT NULL,
  `so_item_harga_beli` bigint NULL DEFAULT NULL,
  `so_item_harga_jual` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tr_so_d
-- ----------------------------
INSERT INTO `tr_so_d` VALUES (1, 1, 2, 1, 1000, 1500);

-- ----------------------------
-- Table structure for tr_so_h
-- ----------------------------
DROP TABLE IF EXISTS `tr_so_h`;
CREATE TABLE `tr_so_h`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `tgl_so` date NULL DEFAULT NULL,
  `kode_so` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan_so` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `customer_so` int NULL DEFAULT NULL,
  `so_total_harga_beli` bigint NULL DEFAULT NULL,
  `so_total_harga_jual` bigint NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tr_so_h
-- ----------------------------
INSERT INTO `tr_so_h` VALUES (1, '2021-07-26', 'TRX-SO-00001', 'tesate', 2, 1000, 1500, 3);

-- ----------------------------
-- Table structure for tr_sr_d
-- ----------------------------
DROP TABLE IF EXISTS `tr_sr_d`;
CREATE TABLE `tr_sr_d`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `sr_id` int NULL DEFAULT NULL,
  `sr_so_id` int NULL DEFAULT NULL,
  `sr_item_id` int NULL DEFAULT NULL,
  `sr_item_qty` int NULL DEFAULT NULL,
  `sr_harga_beli_item` bigint NULL DEFAULT NULL,
  `sr_harga_jual_item` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tr_sr_d
-- ----------------------------

-- ----------------------------
-- Table structure for tr_sr_h
-- ----------------------------
DROP TABLE IF EXISTS `tr_sr_h`;
CREATE TABLE `tr_sr_h`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_sr` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_sr` date NULL DEFAULT NULL,
  `customer_sr` int NULL DEFAULT NULL,
  `keterangan_sr` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `total_harga_beli_sr` bigint NULL DEFAULT NULL,
  `total_harga_jual_sr` bigint NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tr_sr_h
-- ----------------------------

-- ----------------------------
-- Table structure for tr_trx
-- ----------------------------
DROP TABLE IF EXISTS `tr_trx`;
CREATE TABLE `tr_trx`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_trx` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_trx` date NULL DEFAULT NULL,
  `periode_trx_id` int NULL DEFAULT NULL,
  `jenis_trx_id` int NULL DEFAULT NULL,
  `detail_trx` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `nilai_trx` bigint NULL DEFAULT NULL,
  `user_create` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tr_trx
-- ----------------------------
INSERT INTO `tr_trx` VALUES (2, 'TRX00001', '2021-07-15', 7, 1, 'penjualan pertama', 2000000, 3);
INSERT INTO `tr_trx` VALUES (3, 'TRX00002', '2021-07-15', 7, 1, 'pembayaran piutang CV.blablablabla', 200000, 3);
INSERT INTO `tr_trx` VALUES (4, 'TRX00003', '2021-07-16', 7, 2, 'Pembayaran listrik bulan juli 2021', 200000, 3);
INSERT INTO `tr_trx` VALUES (6, 'TRX00004', '2021-07-08', 7, 1, 'eta', 1000, 3);
INSERT INTO `tr_trx` VALUES (7, 'TRX00005', '2021-08-02', 8, 1, 'penjualan produk', 1500000, 3);
INSERT INTO `tr_trx` VALUES (8, 'TRX00006', '2021-09-01', 9, 2, 'TESTSDFA ', 150000, 3);
INSERT INTO `tr_trx` VALUES (10, 'TRX00007', '2021-08-12', 8, 2, 'testasdf asdf', 25000, 3);

SET FOREIGN_KEY_CHECKS = 1;
