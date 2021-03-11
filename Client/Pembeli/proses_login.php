<?php

session_start();

$username = $_POST['username'];
$password = $_POST['password'];
try{
    // $dataAPI =  simplexml_load_file("http://localhost:8080/simple_soap/webresources/com.mywebsite.database.akun/username/$username"); 
    $wsdl_add = "http://localhost:8080/FinalSimpleSoaProject/JualBeliWebServiceService?WSDL";
    $api = new SoapClient($wsdl_add);
        if($api->find(array('username'=>$username ,'password'=>$password))->return == 1){
            $_SESSION['username'] = $username;
            $_SESSION['login'] = true;
            header('Location: soap_client2.php');
        }
        else{
            header('Location: Login.php');
        }
}
catch(SOAPFault $Exception){
    echo $Exception;
}
?>
