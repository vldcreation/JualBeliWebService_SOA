<?php

session_start();

$username = $_POST['username'];
$password = $_POST['password'];
try{
        $wsdl_add = "http://localhost:8080/FinalSimpleSoaProject/JualBeliWebServiceService?WSDL";
        $api = new SoapClient($wsdl_add);
        if($api->find(array('username'=>$username ,'password'=>$password))->return == 1){
            $_SESSION['username'] = $username;
            $_SESSION['login'] = true;
            header('Location: soap_client2.php');
        }
        else
            header('Location: Login.php');
    // header('Location: '.$url);
}
catch(SOAPFault $Exception){
    echo $Exception;
}
?>
