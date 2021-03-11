<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Login Page</title>
</head>
<body>
    <div class="container-fluid">
    <form action="proses_login.php" method="POST">
    <div class="col col-md-3 mb-2">
    <label for="NamaProduk" class="form-label">Username</label>
    <input type="text" name="username" placeholder="Masukan Username" class="form-control" >
  </div>
  <div class="col col-md-3 mb-2">
    <label for="hargaProduk" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Masukan Passwrod">
  </div>
    <input type="submit" name="submit" value="Login">
    </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</html>
