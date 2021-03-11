<?php
$id = 0;
$url = "keranjang.php";
if(isset($_GET['idCart'])){
    $id = $_GET['idCart'];
    try{
        $wsdl_add = "http://localhost:8080/FinalSimpleSoaProject/JualBeliWebServiceService?WSDL";
        $api = new SoapClient($wsdl_add);
        $api->deleteCart(array('id_keranjang'=>$id));
        header('Location: '.$url);
    }
    catch(SOAPFault $Exception){
        echo $Exception;
    }
}
else{
    header('Location: '.$url);
}


?>