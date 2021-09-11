<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth/index';

// editor
$route['pengguna'] = 'pengguna_controller/index';
$route['pengguna/tambah'] = 'pengguna_controller/create';
$route['pengguna/simpan'] = 'pengguna_controller/store';
$route['pengguna/edit/(:num)'] = 'pengguna_controller/edit/$1';
$route['pengguna/update'] = 'pengguna_controller/update';
$route['pengguna/delete/(:num)'] ='pengguna_controller/delete/$1';

// item
$route['item'] = 'Barang_controller/index';
$route['item/tambah'] = 'Barang_controller/create';
$route['item/simpan'] = 'Barang_controller/store';
$route['item/edit/(:num)'] = 'Barang_controller/edit/$1';
$route['item/update'] = 'Barang_controller/update';
$route['item/delete/(:num)'] = 'Barang_controller/delete/$1';

// suplier
$route['suplier'] = 'Suplier_controller/index';
$route['suplier/tambah'] = 'Suplier_controller/create';
$route['suplier/simpan'] = 'Suplier_controller/store';
$route['suplier/edit/(:num)'] = 'Suplier_controller/edit/$1';
$route['suplier/update'] = 'Suplier_controller/update';
$route['suplier/delete/(:num)'] = 'Suplier_controller/delete/$1';


// customer
$route['customer'] = 'Customer_controller/index';
$route['customer/tambah'] = 'Customer_controller/create';
$route['customer/simpan'] = 'Customer_controller/store';
$route['customer/edit/(:num)'] = 'Customer_controller/edit/$1';
$route['customer/update'] = 'Customer_controller/update';
$route['customer/delete/(:num)'] = 'Customer_controller/delete/$1';


// PO
$route['po'] = 'Po_controller/index';
$route['po/data'] = 'Po_controller/show';
$route['po/tambah'] = 'Po_controller/create';
$route['po/simpan'] = 'Po_controller/store';
$route['po/delete'] = 'Po_controller/delete';
$route['po/edit/(:num)'] = 'Po_controller/edit/$1';
$route['po/show/(:num)'] = 'Po_controller/show_edit/$1';
$route['po/update'] = 'Po_controller/update';
$route['po/cek_po_gr'] = 'Po_controller/cek_po_gr';

// so
$route['so'] = 'So_controller/index';
$route['so/data'] = 'So_controller/show';
$route['so/tambah'] = 'So_controller/create';
$route['so/simpan'] = 'So_controller/store';
$route['so/delete'] = 'So_controller/delete';
$route['so/edit/(:num)'] = 'So_controller/edit/$1';
$route['so/show/(:num)'] = 'So_controller/show_edit/$1';
$route['so/update'] = 'So_controller/update';
$route['cek_stok'] = 'So_controller/cek_stok';
$route['cek_stok_edit'] = 'So_controller/cek_stok_edit';

// gr
$route['gr'] = 'Gr_controller/index';
$route['gr/data'] = 'Gr_controller/show';
$route['gr/tambah'] = 'Gr_controller/create';
$route['gr/simpan'] = 'Gr_controller/store';
$route['gr/delete'] = 'Gr_controller/delete';
$route['gr/edit/(:num)'] = 'Gr_controller/edit/$1';
$route['gr/show/(:num)'] = 'Gr_controller/show_edit/$1';
$route['gr/update'] = 'Gr_controller/update';
$route['gr/get-po'] = 'Gr_controller/cari_po';
$route['gr/get-po-edit'] = 'Gr_controller/cari_po_edit';

// sr
$route['sr'] = 'Sr_controller/index';
$route['sr/data'] = 'Sr_controller/show';
$route['sr/tambah'] = 'Sr_controller/create';
$route['sr/get-so'] = 'Sr_controller/cari_so';
$route['sr/simpan'] = 'Sr_controller/store';
$route['sr/edit/(:num)'] = 'Sr_controller/edit/$1';
$route['sr/show/(:num)'] = 'Sr_controller/show_edit/$1';
$route['sr/get-so-edit'] = 'Sr_controller/cari_so_edit';
$route['sr/delete'] = 'Sr_controller/delete';

// transaksi
$route['transaksi'] = 'transaksi_controller/index';
$route['transaksi/tambah'] = 'transaksi_controller/create';
$route['transaksi/simpan'] = 'transaksi_controller/store';
$route['transaksi/edit/(:num)'] = 'transaksi_controller/edit/$1';
$route['transaksi/update'] = 'transaksi_controller/update';
$route['transaksi/delete/(:num)'] = 'transaksi_controller/delete/$1';

// report pemasukan
$route['stok'] = 'report_stok/index';
$route['get-stok'] = 'report_stok/getreport';

// report pengeluaran
$route['report-penjualan'] = 'report_penjualan/index';
$route['get-report-penjualan'] = 'report_penjualan/getreport';

// report pemesanan barang
$route['report-pemesanan'] = 'Report_pemesanan/index';
$route['get-report-pemesanan'] = 'Report_pemesanan/getreport';

// report pemesanan barang
$route['report-stok-masuk'] = 'Report_item_masuk/index';
$route['get-stok-masuk'] = 'Report_item_masuk/getreport';

// report laba rugi
$route['report-laba-rugi'] = 'report_labarugi/index';
$route['get-report-laba-rugi'] = 'report_labarugi/getreport';

// Dashboard
$route['dashboard'] = 'app/index';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
