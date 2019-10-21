/*
SQLyog Ultimate
MySQL - 10.1.34-MariaDB : Database - siperang
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `t_barang_supplier` */

DROP TABLE IF EXISTS `t_barang_supplier`;

CREATE TABLE `t_barang_supplier` (
  `Id_PK` varchar(100) NOT NULL,
  `Id_Supplier` varchar(100) DEFAULT NULL,
  `Kode_Barang` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id_PK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_barang_supplier` */

insert  into `t_barang_supplier`(`Id_PK`,`Id_Supplier`,`Kode_Barang`) values 
('NUBS71570619736','SUP1568150805','FD1'),
('O208S1570619482','SUP1570605710','HD15'),
('R46D11570619482','SUP1570605710','FD1');

/*Table structure for table `t_barangmasuk` */

DROP TABLE IF EXISTS `t_barangmasuk`;

CREATE TABLE `t_barangmasuk` (
  `Kode_BarangMasuk` varchar(100) NOT NULL,
  `Kode_Order` varchar(100) DEFAULT NULL,
  `Tanggal` date DEFAULT NULL,
  `Supplier` varchar(50) DEFAULT NULL,
  `Total` float DEFAULT NULL,
  PRIMARY KEY (`Kode_BarangMasuk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_barangmasuk` */

insert  into `t_barangmasuk`(`Kode_BarangMasuk`,`Kode_Order`,`Tanggal`,`Supplier`,`Total`) values 
('BM156814697200001','OR156813852400001','2019-09-11','SUP1565351612',130000),
('BM156821164500002','OR156821147000002','2019-09-11','SUP1568150805',600000);

/*Table structure for table `t_barangmasuk_detil` */

DROP TABLE IF EXISTS `t_barangmasuk_detil`;

CREATE TABLE `t_barangmasuk_detil` (
  `id` varchar(50) NOT NULL,
  `Kode_BarangMasuk` varchar(50) DEFAULT NULL,
  `Kode_Barang` varchar(50) DEFAULT NULL,
  `Nama_Barang` varchar(100) DEFAULT NULL,
  `Harga_Barang` float DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Subtotal` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_barangmasuk_detil` */

insert  into `t_barangmasuk_detil`(`id`,`Kode_BarangMasuk`,`Kode_Barang`,`Nama_Barang`,`Harga_Barang`,`Quantity`,`Subtotal`) values 
('1568148556','BM156814697200001','FD1','Flashdisk',130000,1,130000),
('1568211665','BM156821164500002','FD1','Flashdisk',120000,5,600000);

/*Table structure for table `t_order` */

DROP TABLE IF EXISTS `t_order`;

CREATE TABLE `t_order` (
  `Kode_Order` varchar(100) NOT NULL,
  `Supplier` varchar(50) DEFAULT NULL,
  `Total` float DEFAULT NULL,
  `Tanggal_Order` date DEFAULT NULL,
  `isStatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`Kode_Order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_order` */

insert  into `t_order`(`Kode_Order`,`Supplier`,`Total`,`Tanggal_Order`,`isStatus`) values 
('OR156813852400001','SUP1565351612',130000,'2019-09-11',1),
('OR156821147000002','SUP1568150805',600000,'2019-09-11',1),
('OR157061962100003','SUP1570605710',900000,'2019-10-09',0);

/*Table structure for table `t_order_detil` */

DROP TABLE IF EXISTS `t_order_detil`;

CREATE TABLE `t_order_detil` (
  `id` varchar(50) NOT NULL,
  `Kode_Order` varchar(50) DEFAULT NULL,
  `Kode_Barang` varchar(50) DEFAULT NULL,
  `Nama_Barang` varchar(100) DEFAULT NULL,
  `Harga_Barang` float DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Subtotal` float DEFAULT NULL,
  `id_detil_req` text,
  `kode_req` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_order_detil` */

insert  into `t_order_detil`(`id`,`Kode_Order`,`Kode_Barang`,`Nama_Barang`,`Harga_Barang`,`Quantity`,`Subtotal`,`id_detil_req`,`kode_req`) values 
('1568138543','OR156813852400001','FD1','Flashdisk',130000,1,130000,'1567831871','RQ156610469400001'),
('1568211502','OR156821147000002','FD1','Flashdisk',120000,5,600000,'1568211410','RQ156821126400002'),
('cjhTM1570619640','OR157061962100003','HD15','Harddisk',900000,1,900000,'','');

/*Table structure for table `t_requestbarang` */

DROP TABLE IF EXISTS `t_requestbarang`;

CREATE TABLE `t_requestbarang` (
  `Kode_Request` varchar(100) NOT NULL,
  `Tanggal_Request` date DEFAULT NULL,
  `Total` float DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `isStatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`Kode_Request`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_requestbarang` */

insert  into `t_requestbarang`(`Kode_Request`,`Tanggal_Request`,`Total`,`user`,`isStatus`) values 
('RQ156610469400001','2019-09-07',130000,'USR1565240213',1),
('RQ156821126400002','2019-09-11',600000,'USR1565240213',1);

/*Table structure for table `t_requestbarang_detil` */

DROP TABLE IF EXISTS `t_requestbarang_detil`;

CREATE TABLE `t_requestbarang_detil` (
  `id` varchar(50) NOT NULL,
  `Kode_Request` varchar(50) DEFAULT NULL,
  `Kode_Barang` varchar(50) DEFAULT NULL,
  `Nama_Barang` varchar(100) DEFAULT NULL,
  `Harga_Barang` float DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Subtotal` float DEFAULT NULL,
  `isStatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_requestbarang_detil` */

insert  into `t_requestbarang_detil`(`id`,`Kode_Request`,`Kode_Barang`,`Nama_Barang`,`Harga_Barang`,`Quantity`,`Subtotal`,`isStatus`) values 
('1567831871','RQ156610469400001','HD15','Flashdisk',130000,1,130000,0),
('1568211410','RQ156821126400002','HD15','Flashdisk',120000,5,600000,0);

/*Table structure for table `t_returnbarang` */

DROP TABLE IF EXISTS `t_returnbarang`;

CREATE TABLE `t_returnbarang` (
  `Kode_Return` varchar(100) NOT NULL,
  `Supplier` varchar(50) DEFAULT NULL,
  `Tanggal` date DEFAULT NULL,
  `Total` float DEFAULT NULL,
  PRIMARY KEY (`Kode_Return`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_returnbarang` */

insert  into `t_returnbarang`(`Kode_Return`,`Supplier`,`Tanggal`,`Total`) values 
('RB156815027200001','SUP1565351612','2019-09-11',130000),
('RB156821179100002','SUP1568150805','2019-09-11',240000);

/*Table structure for table `t_returnbarang_detil` */

DROP TABLE IF EXISTS `t_returnbarang_detil`;

CREATE TABLE `t_returnbarang_detil` (
  `id` varchar(50) NOT NULL,
  `Kode_Return` varchar(50) DEFAULT NULL,
  `Kode_Barang` varchar(50) DEFAULT NULL,
  `Nama_Barang` varchar(100) DEFAULT NULL,
  `Harga_Barang` float DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Subtotal` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_returnbarang_detil` */

insert  into `t_returnbarang_detil`(`id`,`Kode_Return`,`Kode_Barang`,`Nama_Barang`,`Harga_Barang`,`Quantity`,`Subtotal`) values 
('1568172258','RB156815027200001','FD1','Flashdisk',130000,1,130000),
('1568211880','RB156821179100002','FD1','Flashdisk',120000,2,240000);

/*Table structure for table `t_stockopname` */

DROP TABLE IF EXISTS `t_stockopname`;

CREATE TABLE `t_stockopname` (
  `id` varchar(100) NOT NULL,
  `Kode_Barang` varchar(100) DEFAULT NULL,
  `Nama_Barang` varchar(255) DEFAULT NULL,
  `Quantity` float DEFAULT NULL,
  `Harga` float DEFAULT NULL,
  `Selisih` float DEFAULT NULL,
  `Input_Stok` float DEFAULT NULL,
  `Tanggal` date DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_stockopname` */

insert  into `t_stockopname`(`id`,`Kode_Barang`,`Nama_Barang`,`Quantity`,`Harga`,`Selisih`,`Input_Stok`,`Tanggal`,`status`) values 
('6DBwO1569469006','HD15','Harddisk',5,900000,5,10,'2019-09-26',0),
('XULwI1569469006','FD1','Flashdisk',3,120000,7,10,'2019-09-26',0);

/*Table structure for table `t_transaksipenjualan` */

DROP TABLE IF EXISTS `t_transaksipenjualan`;

CREATE TABLE `t_transaksipenjualan` (
  `Kode_Transaksi` varchar(100) NOT NULL,
  `Tanggal_Transaksi` date DEFAULT NULL,
  `Total` float DEFAULT NULL,
  `DP` float DEFAULT NULL,
  `StatusTransaksi` int(1) DEFAULT NULL,
  `Tanggal_JatuhTempo` date DEFAULT NULL,
  `Sisa` float DEFAULT NULL,
  `Tanggal_Pelunasan` date DEFAULT NULL,
  PRIMARY KEY (`Kode_Transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_transaksipenjualan` */

insert  into `t_transaksipenjualan`(`Kode_Transaksi`,`Tanggal_Transaksi`,`Total`,`DP`,`StatusTransaksi`,`Tanggal_JatuhTempo`,`Sisa`,`Tanggal_Pelunasan`) values 
('TS156592741800001','2019-08-16',650000,0,1,'2019-09-16',0,'2019-09-15'),
('TS156821853900002','2019-09-12',260000,0,1,'2019-09-12',0,'2019-09-15'),
('TS156822179900003','2019-09-12',1260000,0,1,'2019-10-12',0,'2019-09-22'),
('TS156914894400004','2019-09-22',1000000,0,1,'2019-09-22',0,'2019-09-22'),
('TS156914895700005','2019-09-22',18000000,5000000,2,'2019-10-22',13000000,'2019-09-22'),
('TS156967004200006','2019-09-28',3000000,0,1,'2019-09-28',0,'2019-09-28');

/*Table structure for table `t_transaksipenjualan_detil` */

DROP TABLE IF EXISTS `t_transaksipenjualan_detil`;

CREATE TABLE `t_transaksipenjualan_detil` (
  `IdDetil` varchar(50) NOT NULL,
  `Kode_Transaksi` varchar(50) DEFAULT NULL,
  `Kode_Barang` varchar(50) DEFAULT NULL,
  `Nama_Barang` varchar(100) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Harga_Barang` float DEFAULT NULL,
  `Subtotal` float DEFAULT NULL,
  PRIMARY KEY (`IdDetil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_transaksipenjualan_detil` */

insert  into `t_transaksipenjualan_detil`(`IdDetil`,`Kode_Transaksi`,`Kode_Barang`,`Nama_Barang`,`Quantity`,`Harga_Barang`,`Subtotal`) values 
('1565933855','TS156592741800001','FD1','Flashdisk',5,130000,650000),
('1568218564','TS156821853900002','FD1','Flashdisk',2,130000,260000),
('3mGtT1569672664','TS156967004200006','HD15','Harddisk',3,1000000,3000000),
('FCUjE1568222229','TS156822179900003','HD15','Harddisk',1,1000000,1000000),
('MC52u1569670298','TS156914895700005','HD15','Harddisk',5,1000000,5000000),
('qM4a51569670298','TS156914895700005','FD1','Flashdisk',100,130000,13000000),
('qUcJY1569148953','TS156914894400004','HD15','Harddisk',1,1000000,1000000),
('yvjsk1568222229','TS156822179900003','FD1','Flashdisk',2,130000,260000);

/*Table structure for table `tbl_bagian` */

DROP TABLE IF EXISTS `tbl_bagian`;

CREATE TABLE `tbl_bagian` (
  `Kode_bagian` varchar(100) NOT NULL,
  `Nama_bagian` varchar(100) DEFAULT NULL,
  `isAktif` int(1) DEFAULT '1',
  PRIMARY KEY (`Kode_bagian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_bagian` */

insert  into `tbl_bagian`(`Kode_bagian`,`Nama_bagian`,`isAktif`) values 
('1','Admin',1),
('2','Kasir',1),
('3','Gudang',1),
('4','Direktur',1);

/*Table structure for table `tbl_databarang` */

DROP TABLE IF EXISTS `tbl_databarang`;

CREATE TABLE `tbl_databarang` (
  `Kode_Barang` varchar(50) NOT NULL,
  `Nama_Barang` varchar(100) DEFAULT NULL,
  `Harga_Beli` float DEFAULT NULL,
  `Harga_Jual` float DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `isAktif` int(1) DEFAULT '1',
  PRIMARY KEY (`Kode_Barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_databarang` */

insert  into `tbl_databarang`(`Kode_Barang`,`Nama_Barang`,`Harga_Beli`,`Harga_Jual`,`Quantity`,`isAktif`) values 
('FD1','Flashdisk',120000,130000,10,1),
('HD15','Harddisk',900000,1000000,7,1);

/*Table structure for table `tbl_supplier` */

DROP TABLE IF EXISTS `tbl_supplier`;

CREATE TABLE `tbl_supplier` (
  `Kode_Supplier` varchar(100) NOT NULL,
  `Nama_Supplier` varchar(100) DEFAULT NULL,
  `Alamat_Supplier` varchar(255) DEFAULT NULL,
  `No_Tlp` varchar(255) DEFAULT NULL,
  `isAktif` int(1) DEFAULT NULL,
  PRIMARY KEY (`Kode_Supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_supplier` */

insert  into `tbl_supplier`(`Kode_Supplier`,`Nama_Supplier`,`Alamat_Supplier`,`No_Tlp`,`isAktif`) values 
('SUP1565351612','Supplier Test','fdkdbk','57488',NULL),
('SUP1568150805','Supplier Test Update','Gianyar','0897653335635',NULL),
('SUP1570605710','PT Adi Sanjaya','Denpasar','0897653335635',NULL);

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `Kode_User` varchar(25) NOT NULL,
  `Nama_User` varchar(50) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Nomor_Telepon` varchar(20) NOT NULL,
  `Bagian` varchar(50) NOT NULL,
  PRIMARY KEY (`Kode_User`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`Kode_User`,`Nama_User`,`Username`,`Password`,`Nomor_Telepon`,`Bagian`) values 
('USR1565240213','Admin','admin','$2y$10$1Wk04bvU48xjVyhI7CF93OsL29.fVDdvNE3V4rpyZ9As7UKufc/bS','089669724863','1'),
('USR1565667354','Gudang','gudang','$2y$10$IepuaIaLQkmXQul.iL37KudHpPlKPOj707KNygx6C.1oPXdHkERgO','084343858','3'),
('USR1568231861','Direktur','direktur','$2y$10$c3fFSkz.zO941pn.Kvy83eu8t30Jh/UYYK2dcR1nAU7Xd0SBoqfAW','089669724863','4'),
('USR1568231885','Kasir','kasir','$2y$10$6T.VAL.dioLeW6DbX6Dt9ucFhqtjCmcWD.oDoT6BnRCvz.vD0fSUi','089669724863','2');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
