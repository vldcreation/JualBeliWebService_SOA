<?php
    $inpBase = $_POST['base'];
    $inpHeight = $_POST['height'];
try{
    $wsdl_add = "http://localhost:84/getArea?wsdl";
    $api = new SoapClient($wsdl_add);
    echo $api->getArea(array('base'=>$inpBase,'height'=>$inpHeight))->return;
}
catch(SOAPFault $Exception){
    echo $Exception;
}


?>