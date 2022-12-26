<?php
// konek db
$conn = mysqli_connect("localhost", 'id20065522_localhost', 'chd0eV|f6cKu[?/!', 'id20065522_invento');

//menambah barang baru
if (isset($_POST['addnewbarang'])) {
    $kdbarang = $_POST['kdbarang'];
    $namabarang = $_POST['namabarang'];
    $harga = $_POST['harga'];

    $addtotable = mysqli_query($conn, "insert into stock (kdbarang, namabarang, harga) values('$kdbarang','$namabarang','$harga')");
    if ($addtotable) {
        header('location:index.php');
    } else {
        echo "Gagal";
        header('location:index.php');
    }
};
//mengupdate barang baru
if (isset($_POST['updatebarang'])) {
    $idb = $_POST['idb'];
    $kdbarang = $_POST['kdbarang'];
    $namabarang = $_POST['namabarang'];
    $harga = $_POST['harga'];

    $cekqty = mysqli_query($conn, "select * from  mutasi where idbarang ='$idb'");
    $ambildata = mysqli_fetch_array($cekqty);

    $qtysekarang = $ambildata['qty'];
    $saldo = $harga * $qtysekarang;
    $updatesaldo = mysqli_query($conn, "update mutasi set saldo='$saldo' where idbarang ='$idb'");

    $update = mysqli_query($conn, "update stock set kdbarang='$kdbarang',namabarang='$namabarang',harga='$harga' where idbarang='$idb'");
    if ($update) {
        header('location:index.php');
    } else {
        echo "Gagal";
        header('location:index.php');
    }
};

//menghapus barang
if (isset($_POST['hapusbarang'])) {
    $idb = $_POST['idb'];
   

    $hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
    if ($hapus) {
        header('location:index.php');
    } else {
        echo "Gagal";
        header('location:index.php');
    }
};

if (isset($_POST['addnewmutasi'])) {
    $nobukti = $_POST['nobukti'];
    $barangnya = $_POST['barangnya'];
    $statusbarang = $_POST['statusbarang'];
    $qty = $_POST['qty'];

    $cekharga = mysqli_query($conn, "select * from  stock where idbarang ='$barangnya'");
    $ambildata = mysqli_fetch_array($cekharga);

    $hargasekarang = $ambildata['harga'];
    $saldo = $hargasekarang * $qty;

    $addtotable = mysqli_query($conn, "insert into mutasi (nobukti,idbarang, statusbarang, qty, saldo) values('$nobukti','$barangnya','$statusbarang','$qty','$saldo')");
    if ($addtotable) {
        header('location:mutasi.php');
    } else {
        echo "Gagal";
        header('location:mutasi.php');
    }
};

if (isset($_POST['updatemutasi'])) {
    $id = $_POST['id'];
    $nobukti = $_POST['nobukti'];
    $barangnya = $_POST['barangnya'];
    $statusbarang = $_POST['statusbarang'];
    $qty = $_POST['qty'];

    $cekharga = mysqli_query($conn, "select * from  stock where idbarang ='$barangnya'");
    $ambildata = mysqli_fetch_array($cekharga);

    $hargasekarang = $ambildata['harga'];
    $saldo = $hargasekarang * $qty;

    $update = mysqli_query($conn,  "update mutasi set nobukti='$nobukti',idbarang='$barangnya',statusbarang='$statusbarang',qty='$qty',saldo='$saldo' where id='$id'");
    if ($update) {
        header('location:mutasi.php');
    } else {
        echo "Gagal";
        header('location:mutasi.php');
    }
};

//menghapus barang
if (isset($_POST['hapusmutasi'])) {
    $id = $_POST['id'];
   

    $hapus = mysqli_query($conn, "delete from mutasi where id='$id'");
    if ($hapus) {
        header('location:mutasi.php');
    } else {
        echo "Gagal";
        header('location:mutasi.php');
    }
};