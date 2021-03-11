/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mywebsite.interfaces;

import java.sql.Date;
import javax.jws.WebService;
import javax.jws.WebMethod;
import javax.jws.WebParam;
/**
 *
 * @author ASUS
 */
@WebService
public interface EndPointService {
    @WebMethod(operationName = "Hello")
    public String Hello(@WebParam(name = "txt") String txt) ;
    
    @WebMethod(operationName = "insert")
    public void insert(@WebParam(name = "nama_produk") String nama_produk , @WebParam(name = "harga") Integer harga , @WebParam(name = "jumlah_produk") Integer jumlah_produk , @WebParam(name="deskripsi") String deskripsi);

     @WebMethod(operationName = "update")
    public void update(@WebParam(name = "id_produk") Integer id_produk, @WebParam(name = "nama_produk") String nama_produk , @WebParam(name = "harga") Integer harga , @WebParam(name = "jumlah_produk") Integer jumlah_produk , @WebParam(name="deskripsi") String deskripsi);
    
    @WebMethod(operationName = "delete")
    public void delete(@WebParam(name = "id_produk") Integer id_produk);
    
    @WebMethod(operationName = "find")
    public Integer find(@WebParam(name = "username") String username , @WebParam(name="password") String password);
    
    @WebMethod(operationName = "countbyUserID")
    public Integer countbyUserID(@WebParam(name="id_user") Integer id_user);
    
//    Added Barang Endpoint
    @WebMethod(operationName = "insertCart")
    public void insertCart(@WebParam(name = "id_user") Integer id_user , @WebParam(name = "id_produk") Integer id_produk , @WebParam(name="jumlah") Integer jumlah, @WebParam(name="tanggal") String tanggal);

//     @WebMethod(operationName = "updateCart")
    public void updateCart(@WebParam(name="id_keranjang") Integer id_keranjang, @WebParam(name = "id_user") Integer id_user , @WebParam(name = "id_produk") Integer id_produk , @WebParam(name="jumlah") Integer jumlah, @WebParam(name="tanggal") String tanggal);
    
    @WebMethod(operationName = "deleteCart")
    public void deleteCart(@WebParam(name = "id_keranjang") Integer id_keranjang);
    
//    @WebMethod(operationName = "find")
//    public Integer find(@WebParam(name = "username") String username , @WebParam(name="password") String password);

}
