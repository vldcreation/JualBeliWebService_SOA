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
    $data = simplexml_load_file("http://localhost:8080/simple_soap/webresources/com.mywebsite.database.keranjang");
    $dataAPI =  simplexml_load_file("http://localhost:8080/simple_soap/webresources/com.mywebsite.database.akun/username/".$_SESSION['username']);
    $wsdl_add = "http://localhost:8080/FinalSimpleSoaProject/JualBeliWebServiceService?WSDL";
    $api = new SoapClient($wsdl_add);
    $curId = $dataAPI->idUser;
    $CountBarang = $api->countbyUserID(array('id_user' => $curId))->return;
    $TotalHarga = 0;
    // foreach($data->keranjang as $cart){
    //     // foreach($cart[0]->idUser as $dataUser){
    //     //     echo $dataUser[0]->namalengkap."<br>";
    //     // }
    //     // echo $cart[0]->idUser[0]->idUser;
    //     if($cart[0]->idUser[0]->idUser == 1){
    //         echo $cart[0]->idProduk[0]->namaProduk."<br>";
    //     }
        
    // }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Data Keranjang </title>
</head>
<body>
<div class="container-fluid">
<div class="row">
<div class="col col-md-12 text-center alert alert-info">Data Produk</div>
</div>
<table class="table table-striped" border="0">
        <thead>
        <tr>
        <th scope="col">Nama Produk</th>
        <th scope="col">Harga Produk</th>
        <th scope="col">Jumlah Beli</th>
        <th scope="col">Deskripsi</th>
        <th scope="col">Aksi</th>
        </tr>
        </thead>
<?php
if($CountBarang > 0){
    ?>
<?php foreach($data->keranjang as $cart): 
    if($cart[0]->idUser[0]->idUser == (int)$curId):
        ?>
        
        <tbody>
        <tr scope="row">
            <td><?=$cart[0]->idProduk[0]->namaProduk;?></td>
            <td><?=$cart[0]->idProduk[0]->harga;?></td>
            <td><?=$cart[0]->jumlah;?></td>
            <td><?=$cart[0]->idProduk[0]->deskripsi;?></td>
            <td>
                <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalUpdate<?= $cart[0]->idKeranjang ?>">Ubah</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="delete_cart.php?idCart=<?= $cart[0]->idKeranjang ?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        </tbody>

        <!-- Modal Update Cart -->
<div class="modal fade" id="exampleModalUpdate<?=$cart[0]->idKeranjang?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Pembelian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<form action="proses_update_cart.php" method="POST">
  <input type="hidden" name="idKeranjang" value="<?= $cart[0]->idKeranjang ?>">
  <input type="hidden" name="idUser" value="<?= $dataAPI->idUser ?>">
  <input type="hidden" name="curJlhBeli" value="<?= $cart[0]->jumlah ?>">
  <input type="hidden" name="jumlahProduk" value="<?= $cart[0]->idProduk[0]->jumlahProduk ?>">
  <input type="hidden" name="idProduk" value="<?= $cart[0]->idProduk[0]->idProduk ?>">
  <div class="mb-3">
    <label for="NamaProduk" class="form-label">Nama Produk</label>
    <input type="text" name="namaProduk" readonly="TRUE" class="form-control" value="<?= $cart[0]->idProduk[0]->namaProduk ?>">
  </div>
  <div class="mb-3">
    <label for="hargaProduk" class="form-label">Harga Produk</label>
    <input type="text" readonly="TRUE" class="form-control" name="harga" value="<?=$cart[0]->idProduk[0]->harga ?>">
  </div>
  <div class="mb-3">
    <label for="hargaProduk" class="form-label">Jumlah Beli</label>
    <input type="number" class="form-control" name="jumlahbeli" min="1" max="<?= $cart[0]->idProduk[0]->jumlahProduk ?>" value="<?= $cart[0]->jumlah ?>">
  </div>
  <div class="mb-3">
    <label for="hargaProduk" class="form-label">Deskripsi Produk</label>
    <input type="text" readonly="TRUE" class="form-control" name="deskripsi" value="<?= $cart[0]->idProduk[0]->deskripsi?>">
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
<!-- End Modal Update Cart-->
        <?php $TotalHarga += $cart[0]->idProduk[0]->harga*$cart[0]->jumlah; ?>
<?php endif; endforeach; } elseif ($CountBarang == 0){ ?>
    <tbody>
        <tr scope="row">
    <td><div class="col col-md-12">Data Belanjaan Belum ada</td>
    </tr>
        </tbody>
    <?php }; ?>
    </table>
    <div class="row">
    <div class="col col-md-5"></div>
    <!-- <div class="col col-md-4"></div> -->
    <div class="col col-md-3"><b>Total : </b></div>
    <div class="col col-md-4"><b><?= $TotalHarga; ?></b></div>
    </div>
<div class="col col-md-2"><a href="soap_client2.php" class="btn btn-primary">Kembali</a></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
<?php 
}
catch(SOAPFault $Exception){
    echo $Exception;
}
?>