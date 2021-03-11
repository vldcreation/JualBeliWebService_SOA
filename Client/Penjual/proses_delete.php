<?php
$id = 0;
$url = "soap_client2.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    try{
        $wsdl_add = "http://localhost:8080/FinalSimpleSoaProject/JualBeliWebServiceService?WSDL";
        $api = new SoapClient($wsdl_add);
        $api->delete(array('id_produk'=>$id));
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