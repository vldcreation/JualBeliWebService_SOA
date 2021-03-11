<?php
$curDate    = new DateTime();
$stringDate = $curDate->format('Y-m-d');
$id = 0;
$url = "Keranjang.php";
    $idKeranjang = $_POST['idKeranjang'];
    $idProduk = $_POST['idProduk'];
    $curId = $_POST['idProduk'];
    $curIdUser = $_POST['idUser'];
    $namaProduk = $_POST['namaProduk'];
    $harga = $_POST['harga'];
    $curJumlahProduk = $_POST['jumlahProduk'];
    $jumlahbeli = $_POST['jumlahbeli'];     //3
    $curJlhBeli = $_POST['curJlhBeli'];     //4
    $absJlhBeli = $jumlahbeli - $curJlhBeli; //3 - 4
    $UpdateJumlah = $curJumlahProduk - ($absJlhBeli);
    $deskripsi = $_POST['deskripsi'];
    try{
        $wsdl_add = "http://localhost:8080/FinalSimpleSoaProject/JualBeliWebServiceService?WSDL";
        $api = new SoapClient($wsdl_add);
        $api->updateCart(array('id_keranjang'=>$idKeranjang, 'id_user'=>$curIdUser, 'id_produk'=>$curId ,'jumlah'=>$jumlahbeli , 'tanggal'=>$stringDate ));
        $api->update(array('id_produk'=>$curId ,'nama_produk'=>$namaProduk , 'harga'=>$harga , 'jumlah_produk'=>$UpdateJumlah , 'deskripsi'=>$deskripsi));
        header('Location: '.$url);
    }
    catch(SOAPFault $Exception){
        echo $Exception;
    }


?>