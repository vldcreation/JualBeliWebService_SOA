<?php
session_start();
if($_SESSION['login']==false){
    header('Location: Login.php');
    exit;
}
function http_request($url){
    // persiapkan curl
    $ch = curl_init(); 

    // set url 
    curl_setopt($ch, CURLOPT_URL, $url);
    
    // set user agent    
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

    // return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    // $output contains the output string 
    $output = curl_exec($ch); 

    // tutup curl 
    curl_close($ch);      

    // mengembalikan hasil curl
    return $output;
}


try{
    // $wsdl_add = "http://localhost:8080/simple_soap/webresources/com.mywebsite.database.produk";
    // $client = curl_init($wsdl_add);
    // $response = curl_exec($client);
    // curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
    // echo "<br>";
    // $ch = curl_init();

    // set URL and other appropriate options
    // curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/simple_soap/webresources/com.mywebsite.database.produk");
    // curl_setopt($ch, CURLOPT_HEADER, 0);
    
    // // grab URL and pass it to the browser
    // curl_exec($ch);
    
    // // close cURL resource, and free up system resources
    // curl_close($ch);
    // echo $response;

    $profile = simplexml_load_file("http://localhost:8080/simple_soap/webresources/com.mywebsite.database.produk");
    $dataAPI =  simplexml_load_file("http://localhost:8080/simple_soap/webresources/com.mywebsite.database.akun/username/".$_SESSION['username']);
    $wsdl_add = "http://localhost:8080/FinalSimpleSoaProject/JualBeliWebServiceService?WSDL";
    $api = new SoapClient($wsdl_add);
    $curId = $dataAPI->idUser;
    $CountBarang = $api->countbyUserID(array('id_user' => $curId))->return;
    // ubah string JSON menjadi array
    // $profile = json_decode($profile, TRUE);
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>WEB Service Restfull impl Soa using </title>
</head>
<body>
<div class="container-fluid">
<div class="alert alert-info">
Selamat Datang di Toko SoPASTI, Silahkan berbelanja Guys!
</div>
<div class="row">
<div class="col col-md-6" style="text-align:left"> Welcome(<?= $dataAPI->namalengkap ?>) </div>
<div class="col col-md-4"><a href="keranjang.php" class="btn btn-info btn-sm">  <img src="../Assets/cart.svg"> (<?= $CountBarang  ?>)</a></div>
<div class="col col-md-2 text-center"><a onclick="return confirm('Are you Sure to Logout?')" href="proses_logout.php" class="btn btn-danger">Keluar</a></div>
</div>
<table class="table table-striped" border="0">
        <thead>
        <tr>
        <th scope="col">Nama Produk</th>
        <th scope="col">Harga Produk</th>
        <th scope="col">Stok</th>
        <th scope="col">Deskripsi</th>
        <th scope="col">Action</th>
        </tr>
        </thead>
<?php  foreach($profile->produk as $data):?> 


        <tbody>
        <tr scope="row">
            <td><?=$data[0]->namaProduk;?></td>
            <td><?=$data[0]->harga;?></td>
            <td><?=$data[0]->jumlahProduk;?></td>
            <td><?=$data[0]->deskripsi;?></td>
            <td style="padding-left:20px;"> <a href="javscript:void(0)" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalUpdate<?= $data[0]->idProduk ?>"> Beli </a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="detail_product.php?&id=<?= $data[0]->idProduk ?>" class="btn btn-secondary btn-sm"> Lihat Detail </a> </td>
        </tr>
        </tbody>


        <!-- Modal Beli -->
<div class="modal fade" id="exampleModalUpdate<?=$data[0]->idProduk?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Pembelian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<form action="proses_beli.php" method="POST">
  <input type="hidden" name="idProduk" value="<?= $data[0]->idProduk ?>">
  <input type="hidden" name="idUser" value="<?= $dataAPI->idUser ?>">
  <input type="hidden" name="jumlahProduk" value="<?= $data[0]->jumlahProduk ?>">
  <div class="mb-3">
    <label for="NamaProduk" class="form-label">Nama Produk</label>
    <input type="text" name="namaProduk" readonly="TRUE" class="form-control" value="<?= $data[0]->namaProduk ?>">
  </div>
  <div class="mb-3">
    <label for="hargaProduk" class="form-label">Harga Produk</label>
    <input type="text" readonly="TRUE" class="form-control" name="harga" value="<?=$data[0]->harga ?>">
  </div>
  <div class="mb-3">
    <label for="hargaProduk" class="form-label">Jumlah Beli</label>
    <input type="number" class="form-control" name="jumlahbeli" value="1" min="1" max="<?= $data[0]->jumlahProduk ?>">
  </div>
  <div class="mb-3">
    <label for="hargaProduk" class="form-label">Deskripsi Produk</label>
    <input type="text" readonly="TRUE" class="form-control" name="deskripsi" value="<?= $data[0]->deskripsi?>">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Update -->
<?php endforeach;?>



</table>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</html>
<?php
}
catch(SOAPFault $Exception){
    echo $Exception;
}


?>