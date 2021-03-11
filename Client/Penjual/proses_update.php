<?php
$id = 0;
$url = "soap_client2.php";
    $curId = $_POST['idProduk'];
    $namaProduk = $_POST['namaProduk'];
    $harga = $_POST['harga'];
    $jumlahProduk = $_POST['jumlahProduk'];
    $deskripsi = $_POST['deskripsi'];
    try{
        $wsdl_add = "http://localhost:8080/FinalSimpleSoaProject/JualBeliWebServiceService?WSDL";
        $api = new SoapClient($wsdl_add);
        $api->update(array('id_produk'=>$curId ,'nama_produk'=>$namaProduk , 'harga'=>$harga , 'jumlah_produk'=>$jumlahProduk , 'deskripsi'=>$deskripsi));
        header('Location: '.$url);
    }
    catch(SOAPFault $Exception){
        echo $Exception;
    }


?>