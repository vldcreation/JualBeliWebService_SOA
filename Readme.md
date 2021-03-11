##Implementasi SOA Case Study : JualBeliBarang

Service provider yang digunakan
```
JualBeliWebService_SOA => Layanan Create,Update,Delete & Autentikasi
<a href="https://github.com/vldcreation/SimpleSoap">SimpleSoap</a> => Layanan Retrieve Data (Read data)
```

Database yang diguanakan "Database/simplesoa.sql"

Penggunaan :
```
Simpan Project "SourceCode/Client" ke htdocs (Jika menggunakan xamppp)

Import database

Configrasi properties dan libraries (Driver : mysql connector java 8)

Deploy kedua Service , pastikan service provider memberikan respone dengan terlebih dahulu melakukan test url yang di dapat dari web registry (Postman , Soapui , ataupun menggunakan java project sendiri)

Jika req url wsdl ke service provider sudah memberikan respone , barulah test Project "Client"
```
<b>~Regards</b>