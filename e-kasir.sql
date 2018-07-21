-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2018 at 04:13 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id_account` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id_account`, `username`, `email`, `password`, `level`) VALUES
(16, 'Admin', 'admin@example.com', '21232f297a57a5a743894a0e4a801fc3', 'super admin');

-- --------------------------------------------------------

--
-- Table structure for table `customer_kasir`
--

CREATE TABLE `customer_kasir` (
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `nomor_kontak` varchar(100) NOT NULL,
  `kode_pos` varchar(100) NOT NULL,
  `alamat_lengkap` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_kasir`
--

INSERT INTO `customer_kasir` (`id_customer`, `nama_customer`, `nomor_kontak`, `kode_pos`, `alamat_lengkap`) VALUES
(1, 'Roni Alfiansyah', '081988898299', '14450', 'Jl.Muara Karang Blok L9 T No.8 Penjaringan Jakarta Utara '),
(2, 'Jumas Ridal', '08888999883', '1550', 'Komplek Ciwaringin Bantar jati kemanggisan jakarta utara'),
(3, 'Sandi Apriyoga', '08777877722', '14569', 'Kp.Sumurwangi Kel.Kayumanis Kec.Tanah Sareal Kota Bogor'),
(4, 'April', '098883888388', '14450', 'Kp.sumurwangi Kel.Kayumanis Kec.Bojong GEDE'),
(6, 'Muhammad Noval', '081289903664', '199999', 'Kp.Sumurwangi Kel.Kayumanis kec Tanah Sareal Kota Bogor  Rt.01 RW 07');

-- --------------------------------------------------------

--
-- Table structure for table `data_penjualan_kasir`
--

CREATE TABLE `data_penjualan_kasir` (
  `id_penjualan` int(11) NOT NULL,
  `no_invoices` varchar(100) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `nomor_kontak` varchar(100) NOT NULL,
  `kode_pos` varchar(100) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `total_kasir` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `nilai_diskon` varchar(100) NOT NULL,
  `hitung_diskon` varchar(100) NOT NULL,
  `nilai_ppn` varchar(100) NOT NULL,
  `nama_biaya_lain` varchar(100) NOT NULL,
  `jumlah_biaya_lain` varchar(100) NOT NULL,
  `jumlah_uang` varchar(100) NOT NULL,
  `kembalian` varchar(100) NOT NULL,
  `metode_pembayaran` varchar(100) NOT NULL,
  `catatan` text NOT NULL,
  `tanggal_transaksi` varchar(100) NOT NULL,
  `waktu_transaksi` varchar(100) NOT NULL,
  `nama_kasir` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_penjualan_kasir`
--

INSERT INTO `data_penjualan_kasir` (`id_penjualan`, `no_invoices`, `nama_customer`, `nomor_kontak`, `kode_pos`, `alamat_lengkap`, `total_kasir`, `total`, `nilai_diskon`, `hitung_diskon`, `nilai_ppn`, `nama_biaya_lain`, `jumlah_biaya_lain`, `jumlah_uang`, `kembalian`, `metode_pembayaran`, `catatan`, `tanggal_transaksi`, `waktu_transaksi`, `nama_kasir`, `status`) VALUES
(1, '0', 'Roni Alfiansyah', '081988898299', '14450', 'Jl.Muara Karang Blok L9 T No.8 Penjaringan Jakarta Utara ', '99000', '99000', '0', '0', '0', '', '0', '99000', '0', 'Bank Transfer', '', '20/07/2018', '17:07:00:28', 'Admin', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `data_produk`
--

CREATE TABLE `data_produk` (
  `id_produk` int(11) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` decimal(65,0) NOT NULL,
  `stok_toko` decimal(65,0) NOT NULL,
  `stok_pabrik` decimal(65,0) NOT NULL,
  `status_produk` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `berat` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `gambar0` varchar(100) NOT NULL,
  `gambar1` varchar(100) NOT NULL,
  `gambar2` varchar(100) NOT NULL,
  `gambar3` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_produk`
--

INSERT INTO `data_produk` (`id_produk`, `barcode`, `nama_produk`, `harga_produk`, `stok_toko`, `stok_pabrik`, `status_produk`, `deskripsi`, `berat`, `kategori`, `gambar0`, `gambar1`, `gambar2`, `gambar3`) VALUES
(1, '1112323123', 'Bubuk pembersih membran RO Citric Acid Food Grade', '33000', '97', '100', 'Aktif', 'Citric Acid ini adalah bubuk pencuci membrane RO.\nCara penggunaannya:\nDicampur dengan air bersih (air RO dianjurkan).\nGunakan pH tester dan test pH hingga larutan campuran citric acid dan air RO ini menjadi pH 3.\nKemudian sirkulasikan pada system RO. Pastikan seluruh filter dilepas terlebih dahulu.\nSirkulasikan selama 30 menit hingga 1 jam. Kemudian, sirkulasikan kembali sistem RO anda dengan air RO untuk membersihkan sisa larutan dari sistem RO.\nLakukan sirkulasi dengan air RO selama 30 menit.\nSetelah itu pembersihan RO selesai dilakukan, kembali pasang filter-filter anda.\nNote:\nBubuk ini dipacking per 1 Kg.', '1005', 'Home', 'f89d7d071d534fa84870a76958774ab7.jpg', 'f9601516f09549436ccbda9579a59975.jpg', '7567bbe601bdaa532c8fd23d0c8f418e.jpg', '90c4456172a304649c57772d86fbd437.jpg'),
(2, '1112323124', 'Housing Filter Biru 20 " ( In Out 1/4 " )', '110000', '101', '101', 'Aktif', 'Housing Filter Biru 20 " ( In Out 1/4 " )', '2000', 'Home', '', '', '', ''),
(3, '1112323125', 'Housing Filter Biru 20 " ( In Out 3/8 " )', '110000', '102', '102', 'Aktif', 'Housing Filter Biru 20 " ( In Out 3/8 " )', '2000', 'Home', '', '', '', ''),
(4, '1112323126', 'Filter Air Carbon 2-in-1 20" ( Big Blue )', '198000', '103', '103', 'Aktif', 'Filter Air Carbon 2-in-1 20" ( Big Blue )\nFilter Air sediment dan Carbon menjadi satu!\nFilter air sediment 5 micron yang berfungsi menyaring kotoran tidak terlarut dalam air dipadu dengan Activated Carbon dari batok kelapa asli yang berfungsi mengurangi kadar organik, kadar kimia, dan residue chlorine dari dalam air. \nFilter ini merupakan inovasi baru yang dapat juga menggantikan fungsi CTO atau Carbon Block!\nSangat cocok untuk pre filter ataupun post filter.\nCoba pesan dan rasakan manfaatnya!', '1700', 'Home', '', '', '', ''),
(5, '1112323127', 'Filter Air Carbon 2-in-1 20"', '61600', '104', '104', 'Aktif', 'Filter Air Sediment + Carbon 2-in-1 20"\nFilter Air sediment dan Carbon menjadi satu!\nFilter air sediment 5 micron yang berfungsi menyaring kotoran tidak terlarut dalam air dipadu dengan Activated Carbon dari batok kelapa asli yang berfungsi mengurangi kadar organik, kadar kimia, dan residue chlorine dari dalam air. \nFilter ini merupakan inovasi baru yang dapat juga menggantikan fungsi CTO atau Carbon Block!\nSangat cocok untuk pre filter ataupun post filter.\nCoba pesan dan rasakan manfaatnya!', '1000', 'Home', '', '', '', ''),
(6, '1112323128', 'Housing Filter Big Blue 20" (In Out 1" )', '253000', '105', '105', 'Aktif', 'Housing Filter Big Blue 20" (In Out 1" )', '5500', 'Home', '', '', '', ''),
(7, '1112323129', 'Union Elbow Connector Quick Connect 1/4 - 1/4"\n', '4000', '106', '106', 'Aktif', 'Union Elbow Connector Quick Connect 1/4 - 1/4"\n', '10', 'Home', '5c3c06da9a0eb3529bfaab0bb63e5e24.jpg', 'e13eb8aaf3f5a983f74b41590b562697.jpg', '5c6e55caf4ed70bc13caf27d471c4a9e.jpg', '442da028ad788a4136ac8b8063933a11.jpg'),
(8, '1112323130', 'Union Elbow Connector Quick Connect 3/8 - 1/4"', '5000', '107', '107', 'Aktif', 'Union Elbow Connector Quick Connect 3/8 - 1/4"', '10', 'Home', 'd49e793eb159c125c13e34447b05d41a.jpg', '5d680a40f8559f87f0adb9f1db48cc50.jpg', 'e2995f8d827180fc9e2cbbb734ed62cf.jpg', '3259b0db41e0f8150114f73ca3d6986e.jpg'),
(9, '1112323131', 'Housing Filter Air Transparant 10" (In Out 1/4" )', '55000', '108', '108', 'Aktif', 'Housing Filter Transparant 10" (In Out 1/4" )', '1200', 'Home', '', '', '', ''),
(10, '1112323132', 'Housing Filter Air Blue 10" (In Out 1/4" )', '49500', '109', '109', 'Aktif', 'Housing Filter Air Blue 10" (In Out 1/4" )', '1000', 'Home', '', '', '', ''),
(11, '1112323133', 'Housing Filter Air Blue 10" (In Out 3/8" )', '49500', '110', '110', 'Aktif', 'Housing Filter Air Blue 10" (In Out 3/8" )', '1200', 'Home', '', '', '', ''),
(12, '1112323134', 'Housing Filter Air Transparant 10" (In Out 3/8" )\n', '55000', '111', '111', 'Aktif', 'Housing Filter Transparant 10" (In Out 3/8" )', '200', 'Filter', '', '', '', ''),
(13, '1112323135', 'Housing Filter Air 10" White 1/4" Model Ekonomis', '44000', '112', '112', 'Aktif', 'Housing Filter Air 10" White 1/4" Model Ekonomis Max Working Pressure 90 psi.', '1200', 'Filter', '', '', '', ''),
(14, '1112323136', 'Housing Filter Air 10" Transparant 1/4" Model Ekonomis\n', '49500', '113', '113', 'Aktif', 'Housing Filter Air 10" Transparant 1/4" Model Ekonomis \nMax Working Pressure 60 PSI', '1250', 'Filter', '', '', '', ''),
(15, '1112323137', 'Solenoid KSD AC 220 V 1/4"', '79200', '114', '114', 'Aktif', 'Solenoid KSD AC 220 V 1/4"', '200', 'Filter', 'a90af5385adbde4f3a43d7953553b9f5.jpg', '4a6bae59eef59a67587bf1d5343e6535.jpg', 'ba110463e8f4e418135910a586ee79af.jpg', '0abd26782635c1d40daf060c196a869e.jpg'),
(16, '1112323138', 'Solenoid Valve Plastic DC24 V Quick Connect 1/4"\n', '66600', '115', '115', 'Aktif', 'Solenoid Valve Plastic DC24 V 1/4" dengan connecting quick connect.', '200', 'Filter', 'd432ec18dcd81eb9c4265a6815cb6fe3.jpg', '5d2bf4361749db042fd2e37ad9050780.jpg', '5c2104f3230417be3c2f97f8e4b4eed3.jpg', '86e23f1b5974a945db79d04303f16f51.jpg'),
(17, '1112323139', 'Housing Filter Biru 20 " ( In Out 1/2 " )', '110000', '116', '116', 'Aktif', 'Housing Filter Biru 20 " ( In Out 1/2 " )', '2000', 'Home', '', '', '', ''),
(18, '1112323140', 'Housing Filter Biru 20 " ( In Out 3/4 " )', '111100', '117', '117', 'Aktif', 'Housing Filter Biru 20 " ( In Out 3/4 " )', '2000', 'Home', '', '', '', ''),
(19, '1112323141', 'Housing Filter Big Blue 20" (In Out 1 1/4" )\n', '253000', '118', '118', 'Aktif', 'Housing Filter Big Blue 20" (In Out 1 1/4" )\n', '5500', 'Home', '', '', '', ''),
(20, '1112323142', 'Housing Filter Big Blue 20" (In Out 1 1/2" )', '253000', '119', '119', 'Aktif', 'Housing Filter Big Blue 20" (In Out 1 1/2" )', '5500', 'Home', '', '', '', ''),
(21, '1112323143', 'Male Elbow 1/4 - 3/8 Quick Connect', '2800', '120', '120', 'Aktif', 'Male Elbow 1/4 - 3/8 Quick Connect', '25', 'Home', '7bcbdc97769a4f71f6c91e1e95fa654f.jpg', '3fcdd203324d72984d10cbef42e92e08.jpg', '29d9915d5c3f622197bba16a8caf818a.jpg', '2b524d77bd53283ca9d1ed38f0cbfeb3.jpg'),
(22, '1112323144', 'Male Elbow 3/8 - 1/4 Quick Connect', '3700', '121', '121', 'Aktif', 'Male Elbow 3/8 - 1/4 Quick Connect', '25', 'Home', '51b8edabafeb08f748d54e76da435c03.jpg', '530171578f43a143e50556cced3525d9.jpg', '70076605ecb37457104cc1321cf43397.jpg', ''),
(23, '1112323145', 'Kunci Wrench Housing Filter Big Blue\n', '12100', '122', '122', 'Aktif', 'O Wrench ZZB-0001W (BB)\n\nKunci ini digunakan untuk membuka Filter Housing Big Blue 20"\nDiameter antara gigi ke gigi pada kunci lebih kurang 14.8 cm\nKuat, kokoh, dan tahan lama. \nMade in Taiwan dengan bahan plastik terbaik.', '180', 'Home', '', '', '', ''),
(24, '1112323146', 'Kunci Wrench Housing RO - 300 GPD (3012)', '6100', '123', '123', 'Aktif', 'O Wrench RO3-004W\n\nKunci Pembuka Filter Housing Reverse Osmosis 300 GPD ukuran membran 2812/3012.\nJarak Diameter dari gigi ke gigi 10.6 cm\nKuat, kokoh, dan high quality\nMade in Taiwan', '6100', 'Filter', '', '', '', ''),
(25, '1112323147', 'Kunci Wrench Housing Filter 20 inch\n', '10100', '124', '124', 'Aktif', 'O Wrench ZZ20-0001W (Medium)\n\nKunci Pembuka Filter Housing/Wrench Pembuka Filter Housing 20" \nCocok untuk housing filter 20" \nJarak diameter dari gigi ke gigi pada kunci lebih kurang 10.5 cm\nKokoh, kuat, dan tahan lama.\nMade in Taiwan\n', '100', 'Ro', '', '', '', ''),
(26, '1112323148', 'Kunci Wrench Filter Housing 10"', '6100', '125', '125', 'Aktif', 'O Wrench P-15W (Standard)\n\nKunci Pembuka Filter Housing/ Wrench pembuka Filter Housing 10"\nCocok untuk filter housing 10"\nJarak diameter dari gigi ke gigi pada kunci lebih kurang 9.1 cm\nKuat, kokoh, high quality, dan tahan lama.\nMade in Taiwan \n', '100', 'Ro', '', '', '', ''),
(27, '1112323149', 'Kunci Wrench Housing RO 50, 75, 100 GPD', '3100', '126', '126', 'Aktif', 'Kunci Wrench Housing RO 50, 75, 100 GPD', '80', 'Ro', 'f038658e9e2bbef5ab8dfaf7c0d9ee72.jpg', '66b40fb56a91663708971c0390c98fc1.jpg', '77e3b1fe79abe0a92769bc520d7559b1.jpg', '094744184113dd2877e6440fa58fb169.jpg'),
(28, '1112323150', 'Baut Stainless Steel Bracket Housing Filter Air 10" dan 20"\n', '2800', '127', '127', 'Aktif', 'Baut Bracket Housing Stainless steel untuk filter housing air ukuran 10 inch dan 20 inch.\nPada 1 buah housing diperlukan 4 pcs baut', '2', 'Ro', '', '', '', ''),
(29, '1112323151', 'Flow Restrictor 1200cc,1/4 Quick Connect', '13200', '128', '128', 'Aktif', 'Flow Restrictor 1200cc,1/4 Quick Connect', '100', 'Ro', '', '', '', ''),
(30, '1112323152', 'Flow Restrictor 1600cc,1/4 Quick Connect\n', '13200', '129', '129', 'Aktif', 'Flow Restrictor 1600cc,1/4 Quick Connect\n', '100', '', '', '', '', ''),
(31, '1112323153', 'Flow Restrictor 2000 cc 1/4 Quick Connect', '12100', '130', '130', 'Aktif', 'Flow Restrictor 2000 cc 1/4 Quick Connect', '100', '', '', '', '', ''),
(32, '1112323154', 'Flow Restrictor 150cc,1/4 Jaco Fitting Drat', '12100', '131', '131', 'Aktif', 'Flow Restrictor 150cc,1/4 Jaco Fitting Drat', '100', '', '', '', '', ''),
(33, '1112323155', 'Flow Restrictor 1200cc,1/4 Jaco Fitting Drat', '12100', '132', '132', 'Aktif', 'Flow Restrictor 1200cc,1/4 Jaco Fitting Drat', '100', '', '', '', '', ''),
(34, '1112323156', 'Flow Restrictor 1600cc,1/4 Jaco Fitting Drat\n', '12100', '133', '133', 'Aktif', 'Flow Restrictor 1600cc,1/4 Jaco Fitting Drat Z-FR-J1600', '100', '', '', '', '', ''),
(35, '1112323157', 'Flow Restrictor 2000cc,1/4 Jaco Fitting Drat', '12100', '134', '134', 'Aktif', 'Flow Restrictor 2000cc,1/4 Jaco Fitting Drat', '100', '', '', '', '', ''),
(36, '1112323158', 'Booster Pump Pompa RO Headon 400 GPD', '847000', '135', '135', 'Aktif', 'Pump HF-9600-A36 With Electronic Transformer 36-VDC -1.5 A\nPompa Booster RO merk Headon made in Taiwan\nKapasitas open flow 4.2 liter per menit. \nFlow@ 60 psi 3.6 liter per menit.\nLengkap dengan adaptor 36V \nCocok utk RO kapasitas up to 400 GPD', '3000', '', '', '', '', ''),
(37, '1112323159', 'Booster Pump Pompa RO Headon 300 GPD', '693000', '136', '136', 'Aktif', 'Pump HF -9200 With Electronic Transformer-30VDC\nPompa Booster RO merk Headon made in Taiwan\nKapasitas open flow 3.1 liter per menit. \nFlow@ 60 psi 2.1 liter per menit.\nLengkap dengan adaptor 30V \nCocok utk RO kapasitas up to 300 GPD', '3000', '', '', '', '', ''),
(38, '1112323160', 'Booster Pump Pompa RO Headon 50 GPD', '350900', '137', '137', 'Aktif', 'Pump HF -9050 lengkap dengan Electronic Transformer/adaptor -24VDC\nPompa Booster RO merk Headon made in Taiwan\nKapasitas open flow 1.2 liter per menit. \nFlow@ 60 psi 0.68 liter per menit.\nLengkap dengan adaptor 24V \nCocok utk RO kapasitas up to 50 GPD', '4000', '', '', '', '', ''),
(39, '1112323161', 'Booster Pump Pompa RO Headon 200 GPD', '665500', '138', '138', 'Aktif', 'Pump HF -9200 With Electronic Transformer-24VDC\nPompa Booster RO merk Headon made in Taiwan\nKapasitas open flow 2.8 liter per menit. \nFlow@ 60 psi 1.85 liter per menit.\nLengkap dengan adaptor 24V \nCocok utk RO kapasitas up to 200 GPD', '3000', '', '', '', '', ''),
(40, '1112323162', 'Drain Saddle-Quick 1/4 "', '7900', '139', '139', 'Aktif', 'Drain Saddle-Quick 1/4 " \nTidak perlu lagi bingung menyambung selang pembuangan dari RO System!\nGunakan drain saddle ini untuk menyambung selang air buangan dari RO anda. \nCukup disambung dengan pipa pembuangan sink/wastafel anda yang berbahan PVC dan berukuran 1 inch maka anda sudah bisa menyambung pembuangan dengan rapi dan aman tanpa ada masalah.', '45', '', '', '', '', ''),
(41, '1112323163', 'Drain Saddle-Quick 3/8 "', '8500', '140', '140', 'Aktif', 'Drain Saddle-Quick 3/8 " \nTidak perlu lagi bingung menyambung selang pembuangan dari RO System!\nGunakan drain saddle ini untuk menyambung selang air buangan dari RO anda. \nCukup disambung dengan pipa pembuangan sink/wastafel anda yang berbahan PVC dan berukuran 1 inch maka anda sudah bisa menyambung pembuangan dengan rapi dan aman tanpa ada masalah.', '35', '', '', '', '', ''),
(42, '1112323164', 'Male Elbows W check Valve Tube O.D 1/4" Pipe Thd.1/8"\n', '12100', '141', '141', 'Aktif', 'Male Elbows W check Valve Tube O.D 1/4" Pipe Thd.1/8"', '20', '', '0fa0ab6949ac4c007a56d06a001245eb.jpg', '96ceb3663ad4c1b0ff6fe43e9896ce1f.jpg', '34d8f96ec4b17c5629834377dd217758.jpg', '9736fea3bd3eaf983a9c7ad0e548d020.jpg'),
(43, '1112323165', 'Feed Water Connector 1/4"-1/2"', '8800', '142', '142', 'Aktif', 'Feed Water Connector 1/4"-1/2"', '50', '', '', '', '', ''),
(44, '1112323166', 'Feed Water Connector 3/8-1/2"\n', '9100', '143', '143', 'Aktif', 'Feed Water Connector 3/8-1/2" Z-Q-KFA0608', '50', '', '', '', '', ''),
(45, '1112323167', 'Filter Air model Benang Gulung 10 Micron 10 inch', '17600', '144', '144', 'Aktif', 'Filter Air model Benang Gulung 10 Micron\n\nFilter benang kami menggunakan proses penggulungan tidak terputus yang memberikan kualitas konsisten dan daya tampung kotoran yang tinggi, daya tahan yang tinggi, dan flow rate yang lancar\nTeknik produksi berteknologi tinggi yang memaksimalkan luas permukaan filter dan geometris\n\nUKURAN 10 MICRON\n', '250', '', '', '', '', ''),
(46, '1112323168', 'Filter Air model Benang Gulung 5 Micron Big Blue 20"-110mm', '198000', '145', '145', 'Aktif', 'Filter Air model Benang Gulung 5 Micron Big Blue 20"-110mm\nFilter benang kami menggunakan proses penggulungan tidak terputus yang memberikan kualitas konsisten dan daya tampung kotoran yang tinggi, daya tahan yang tinggi, dan flow rate yang lancar\nTeknik produksi berteknologi tinggi yang memaksimalkan luas permukaan filter dan geometris\n\nUKURAN 5 MICRON \nDiameter 110mm Panjang 20"\n', '1700', '', '', '', '', ''),
(47, '1112323169', 'Filter Air model Benang Gulung 5micron 20"-63mm', '36300', '146', '146', 'Aktif', 'Filter Air model Benang Gulung 5micron 20"-63mm\nFilter benang kami menggunakan proses penggulungan tidak terputus yang memberikan kualitas konsisten dan daya tampung kotoran yang tinggi, daya tahan yang tinggi, dan flow rate yang lancar\nTeknik produksi berteknologi tinggi yang memaksimalkan luas permukaan filter dan geometris\n\nUKURAN 5 MICRON\nPanjang 20" Diameter 63 mm', '1000', '', '', '', '', ''),
(48, '1112323170', 'Male Elbows/Konekting Filter Elbow model Jaco drat 3/8" - 1/4"', '3700', '147', '147', 'Aktif', 'Male Elbows/Konekting Filter Elbow model Jaco drat 3/8" - 1/4"', '25', '', '09a5514656238a2023939727df4457a4.jpg', '35ca99a757dbe6ccba19a4769249e875.jpg', 'a42df1fa65014071f9b88734aba7c00c.jpg', '23b04b0e628b0fd3159dcad5ab5aebf3.jpg'),
(49, '1112323171', 'Male Elbows/Konekting Filter Elbow model Jaco drat 3/8"1/2"', '3900', '148', '148', 'Aktif', 'Male Elbows/Konekting Filter Elbow model Jaco drat 3/8"1/2"', '30', '', '4f3c7920615ec0c43c2195e942ea7bb3.jpg', 'fe3982e277b42c150f0e055fb990e764.jpg', 'd38915566a37abf7ae48a971ed7573b9.jpg', 'e9476a89d28d560923dfee82ff14fefd.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `data_produk_kasir`
--

CREATE TABLE `data_produk_kasir` (
  `id_penjulan_produk` int(11) NOT NULL,
  `no_invoices` varchar(100) NOT NULL,
  `id_produk` varchar(100) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `harga_produk` varchar(100) NOT NULL,
  `jumlah_produk` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_produk_kasir`
--

INSERT INTO `data_produk_kasir` (`id_penjulan_produk`, `no_invoices`, `id_produk`, `barcode`, `nama_produk`, `qty`, `harga_produk`, `jumlah_produk`, `status`) VALUES
(1, '0', '1', '1112323123', 'Bubuk pembersih membran RO Citric Acid Food Grade', '1', '33000', '33000', ''),
(2, '0', '1', '1112323123', 'Bubuk pembersih membran RO Citric Acid Food Grade', '2', '33000', '66000', '');

--
-- Triggers `data_produk_kasir`
--
DELIMITER $$
CREATE TRIGGER `kurangi_stok_toko` AFTER INSERT ON `data_produk_kasir` FOR EACH ROW BEGIN 
   UPDATE data_produk SET stok_toko=stok_toko-NEW.qty
   WHERE id_produk = NEW.id_produk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_stok_toko` AFTER UPDATE ON `data_produk_kasir` FOR EACH ROW BEGIN 
   UPDATE data_produk SET stok_toko=stok_toko+NEW.qty
   WHERE id_produk = NEW.id_produk;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `menu_toko`
--

CREATE TABLE `menu_toko` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_toko`
--

INSERT INTO `menu_toko` (`id_menu`, `nama_menu`) VALUES
(1, 'Home'),
(2, 'Filter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_account`);

--
-- Indexes for table `customer_kasir`
--
ALTER TABLE `customer_kasir`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `data_penjualan_kasir`
--
ALTER TABLE `data_penjualan_kasir`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `no_invoices` (`no_invoices`);

--
-- Indexes for table `data_produk`
--
ALTER TABLE `data_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `data_produk_kasir`
--
ALTER TABLE `data_produk_kasir`
  ADD PRIMARY KEY (`id_penjulan_produk`),
  ADD KEY `no_invoices` (`no_invoices`);

--
-- Indexes for table `menu_toko`
--
ALTER TABLE `menu_toko`
  ADD PRIMARY KEY (`id_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `customer_kasir`
--
ALTER TABLE `customer_kasir`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `data_penjualan_kasir`
--
ALTER TABLE `data_penjualan_kasir`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `data_produk`
--
ALTER TABLE `data_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `data_produk_kasir`
--
ALTER TABLE `data_produk_kasir`
  MODIFY `id_penjulan_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu_toko`
--
ALTER TABLE `menu_toko`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
