cara penggunaan: 
===============================================================================
ubah data di .env :
db_name=db_jig (db_jig diganti dengan database yang digunakan)

===============================================================================
ubah data di middleware
===============================================================================
// *******************************************
di folder php/queryList.js : 
datalist diubah sesuai dengan database 
// -------------------
// jika database yang sama dengan di .env file 
$jig_master_query = 'SELECT * FROM jig_master';

// -------------------
// jika bukan database yang sama dengan di .env file 
$access= 'SELECT * FROM access_config.access_wbd'; 

$codeList = array(
    'access'=>$access,
    'jig_master_query'=>$jig_master_query,
);

// *******************************************
di folder js/class.js : 
export const di bawah di ganti menyesuaikan list di folder /php/queryList.php 
// -------------------
export const access = new Data('access');
export const jig_master_query = new Data('jig_master_query');

// *******************************************
di folder js/api.js : 
ganti semua const response (4x utk getData,fetchDataFilter, insertData, updateData);
mennyesuaikan nama folder awal

const response = await fetch('http://192.168.2.103:8080/wbd/routing/api.php', {
    menjadi : 
const response = await fetch('http://192.168.2.103:8080/wbd/??????/api.php', {
