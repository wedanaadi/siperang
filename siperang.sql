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
('0Uk061573568464','SUP1570621511','00037'),
('175Ls1573568464','SUP1570621511','00007'),
('26P9R1573568464','SUP1570621511','00033'),
('4P47U1573568548','SUP1570631905','00015'),
('6s6Sy1573568464','SUP1570621511','00003'),
('atLHR1573568548','SUP1570631905','00018'),
('boQX01573568571','SUP1570632070','00022'),
('Ccrzk1573568515','SUP1570631654','00021'),
('CXJGB1573568464','SUP1570621511','00005'),
('DZnKM1573568464','SUP1570621511','00038'),
('Ew0t11573568515','SUP1570631654','00024'),
('F0VHz1573568464','SUP1570621511','00034'),
('F3bxG1573568548','SUP1570631905','00017'),
('Fwk0q1573568571','SUP1570632070','00040'),
('G07sX1573568464','SUP1570621511','00006'),
('hm1DP1573568515','SUP1570631654','00047'),
('i9Aam1573568548','SUP1570631905','00020'),
('I9kaU1573568464','SUP1570621511','00035'),
('J4SYR1573568515','SUP1570631654','00022'),
('lAHCn1573568464','SUP1570621511','00009'),
('lOrbV1573568548','SUP1570631905','00029'),
('Lt8AL1573568571','SUP1570632070','00032'),
('o17831573568548','SUP1570631905','00013'),
('PcE7l1573568548','SUP1570631905','00019'),
('Pk52r1573568464','SUP1570621511','00002'),
('R2qdV1573568548','SUP1570631905','00014'),
('R3DMy1573568515','SUP1570631654','00050'),
('Rcnxp1573568548','SUP1570631905','00030'),
('Rdrq11573568571','SUP1570632070','00031'),
('SA3or1573568464','SUP1570621511','00008'),
('sBtqM1573568548','SUP1570631905','00026'),
('sNrju1573568548','SUP1570631905','00028'),
('sy4jI1573568515','SUP1570631654','00023'),
('TaoQL1573568464','SUP1570621511','00036'),
('U6jpT1573568548','SUP1570631905','00016'),
('VQSN71573568548','SUP1570631905','00027'),
('Xqvhd1573568464','SUP1570621511','00004'),
('Y8ZTO1573568515','SUP1570631654','00048'),
('z39wE1573568515','SUP1570631654','00025');

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
('BM157356870300001','OR157356857800001','2019-11-12','SUP1570631905',3875000),
('BM157356871800002','OR157356866900003','2019-11-12','SUP1570631654',2550000);

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
('J4qXS1573568731','BM157356871800002','00050','SSD 128 GB',850000,3,2550000),
('UK5KV1573568712','BM157356870300001','00014','HDD EXTERNAL WD 1 TB',775000,5,3875000);

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
('OR157356857800001','SUP1570631905',3875000,'2019-11-10',1),
('OR157356860900002','SUP1570621511',600000,'2019-11-12',0),
('OR157356866900003','SUP1570631654',4250000,'2019-11-12',1);

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
('7mWS51573568618','OR157356860900002','00003','CATRIDGE 680',120000,5,600000,'Ta1951573568183','RQ157356813500001'),
('n3KUs1573568678','OR157356866900003','00050','SSD 128 GB',850000,5,4250000,'bBAuP1573568183','RQ157356813500001'),
('y5S461573568604','OR157356857800001','00014','HDD EXTERNAL WD 1 TB',775000,5,3875000,'7bwpC1573568183','RQ157356813500001');

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
('RQ157356813500001','2019-11-12',9925000,'USR1565667354',1);

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
('7bwpC1573568183','RQ157356813500001','00014','HDD EXTERNAL WD 1 TB',775000,5,3875000,1),
('bBAuP1573568183','RQ157356813500001','00050','SSD 128 GB',850000,5,4250000,1),
('Ta1951573568183','RQ157356813500001','00003','CATRIDGE 680',120000,5,600000,1),
('UHU7k1573568183','RQ157356813500001','00012','Flashdisk 8 Gb',60000,20,1200000,0);

/*Table structure for table `t_returnbarang` */

DROP TABLE IF EXISTS `t_returnbarang`;

CREATE TABLE `t_returnbarang` (
  `Kode_Return` varchar(100) NOT NULL,
  `Supplier` varchar(50) DEFAULT NULL,
  `Tanggal` date DEFAULT NULL,
  `Total` float DEFAULT NULL,
  `Kode_Barang_Masuk` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Kode_Return`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_returnbarang` */

insert  into `t_returnbarang`(`Kode_Return`,`Supplier`,`Tanggal`,`Total`,`Kode_Barang_Masuk`) values 
('RB157356878400001','SUP1570631905','2019-11-12',775000,'BM157356870300001');

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
('ItKpC1573568800','RB157356878400001','00014','HDD EXTERNAL WD 1 TB',775000,1,775000);

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
('TS157356884300001','2019-11-12',900000,0,1,'2019-11-12',0,'2019-11-12');

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
('cQsib1573568858','TS157356884300001','00050','SSD 128 GB',1,900000,900000);

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
('00001','ADAPOR UNIVERSAL',90000,115000,0,1),
('00002','CATRIDGE 678',125000,150000,0,1),
('00003','CATRIDGE 680',120000,130000,0,1),
('00004','CATRIDGE 810',200000,210000,0,1),
('00005','CATRIDGE 811',250000,260000,0,1),
('00006','CASSING PC',350000,400000,0,1),
('00007','Cooling Pad',50000,75000,0,1),
('00008','DATA PRINT CANON',35000,50000,0,1),
('00009','DATA PRINT HP',35000,50000,0,1),
('00010','DVD INTERNAL',175000,190000,0,1),
('00011','DVD EXSTERNAL',285000,315000,0,1),
('00012','Flashdisk 8 Gb',60000,80000,0,1),
('00013','HDD EXSTERNAL SEAGATE 1 TB',785000,800000,0,1),
('00014','HDD EXTERNAL WD 1 TB',775000,800000,4,1),
('00015','Harddisk Int 1 TB',70000,750000,0,1),
('00016','Harddisk Int 500 GB',600000,620000,0,1),
('00017','Keyboard Logitech 120',125000,150000,0,1),
('00018','Keyboard Mouse Logitech 120',155000,175000,0,1),
('00019','Keyboard Mouse Wireles Logitech 220',220000,235000,0,1),
('00020','Keyboard USB Votre',35000,50000,0,1),
('00021','Asus E203MA',3500000,3750000,0,1),
('00022','HP 360x',4500000,4750000,0,1),
('00023','Asus A407MA',4000000,4250000,0,1),
('00024','Asus A412',7000000,7250000,0,1),
('00025','Asus X441MA',4100000,4350000,0,1),
('00026','\"LED LG 19\"\"\"',875000,900000,0,1),
('00027','\"LED LG 20\"\"\"',1000000,1050000,0,1),
('00028','Mouse Logitech M170',130000,150000,0,1),
('00029','Mouse Logitech M185',160000,175000,0,1),
('00030','Motherboard',1000000,1050000,0,1),
('00031','Mouse Logitech B100',60000,75000,0,1),
('00032','Mouse Votre',25000,50000,0,1),
('00033','Printer Epson L120',1500000,1550000,0,1),
('00034','Printer Canon G2010',1800000,1850000,0,1),
('00035','Printer HP 2135',650000,675000,0,1),
('00036','Printer Canon 2770',650000,675000,0,1),
('00037','Printer Canon 287',950000,1000000,0,1),
('00038','Printer Epson L3110',2100000,2150000,0,1),
('00039','PROC AMD A4',425000,450000,0,1),
('00040','Proc Dual Core',650000,700000,0,1),
('00041','Proc I3',800000,850000,0,1),
('00042','PROC I5',3300000,3350000,0,1),
('00043','MEMORY DDR3 2 GB',350000,375000,0,1),
('00044','Tinta Epson 003',85000,95000,0,1),
('00045','Tinta Epson 664',80000,90000,0,1),
('00046','TINTA INK CANON',35000,50000,0,1),
('00047','TP-LINK 3420',320000,350000,0,1),
('00048','TP-LINK 722',100000,125000,0,1),
('00049','TP-LINK 855',350000,375000,0,1),
('00050','SSD 128 GB',850000,900000,2,1);

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
('SUP1570621511','PT Multi Sarana Computer','Jl Tukad Pakerisan No.12','08155700832',NULL),
('SUP1570631654','Bintang Satu Computer','Jl. Pulau Kawe No.45','085338253831',NULL),
('SUP1570631905','PT Bali Computindo','Jl. Pulau Kawe No 11','083114671275',NULL),
('SUP1570632070','Sanwan','Jl. Pulau Button No.03','085253831478',NULL),
('SUP1570632218','SCK','Jl. Genteng Biru','083114671275',NULL),
('SUP1571580354','PT ERA JAYA','JL. SESETAN NO.38','085337253835',NULL),
('SUP1571580500','OMEGA','JL.GATSU TIMUR NO.37','085253831478',NULL);

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
