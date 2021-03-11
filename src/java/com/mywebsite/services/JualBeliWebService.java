/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mywebsite.services;

import com.mywebsite.interfaces.EndPointService;
import com.mywebsite.database.DBConnect;
import javax.jws.WebService;
import javax.jws.WebMethod;
import javax.jws.WebParam;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Date;

/**
 *
 * @author ASUS
 */
@WebService(endpointInterface = "com.mywebsite.interfaces.EndPointService")
public class JualBeliWebService implements EndPointService{

    /**
     * This is a sample web service operation
     */
    Connection con = DBConnect.serverConnect();
    
    @Override
    public String Hello(@WebParam(name = "txt") String txt){
        return "Hello "+txt;
    }

     @Override
    public void insert(@WebParam(name = "nama_produk") String nama_produk , @WebParam(name = "harga") Integer harga , @WebParam(name = "jumlah_produk") Integer jumlah_produk , @WebParam(name="deskripsi") String deskripsi) {

         try {
           String sq="INSERT INTO `produk3`(`nama_produk` , `harga` , `jumlah_produk` , `deskripsi`) VALUES ('"+nama_produk+"','"+harga+"','"+jumlah_produk+"','"+deskripsi+"')";
             PreparedStatement pst=con.prepareStatement(sq);
           pst.execute();
        //   update();
        } catch (Exception e) {
          // JOptionPane.showMessageDialog(rootPane, e);
        }
     
    }
 
 
     @Override
    public void update(@WebParam(name = "id_produk") Integer id_produk, @WebParam(name = "nama_produk") String nama_produk , @WebParam(name = "harga") Integer harga , @WebParam(name = "jumlah_produk") Integer jumlah_produk , @WebParam(name="deskripsi") String deskripsi) {

        try {
              String squpdate = "UPDATE produk3 SET nama_produk='"+nama_produk+"',harga='"+harga+"',jumlah_produk='"+jumlah_produk+"',deskripsi='"+deskripsi+"' where id_produk='"+id_produk+"'";
            PreparedStatement pst=con.prepareStatement(squpdate);
            pst.execute();
        } catch (Exception e) {
        }
     
    }
    
    @Override
    public void updateCart(@WebParam(name="id_keranjang") Integer id_keranjang, @WebParam(name = "id_user") Integer id_user , @WebParam(name = "id_produk") Integer id_produk , @WebParam(name="jumlah") Integer jumlah, @WebParam(name="tanggal") String tanggal){
        try {
              String squpdate = "UPDATE keranjang SET id_user='"+id_user+"',id_produk='"+id_produk+"',jumlah='"+jumlah+"',tanggal='"+tanggal+"' where id_keranjang='"+id_keranjang+"'";
            PreparedStatement pst=con.prepareStatement(squpdate);
            pst.execute();
        } catch (Exception e) {
        }
    }
 
        @Override
    public void delete(@WebParam(name = "id_produk") Integer id_produk) {

        try {
         
            String sql="DELETE FROM produk3 where id_produk='"+ id_produk +"'";
               PreparedStatement pst=con.prepareStatement(sql);
                pst.execute();
         
        } catch (Exception e) {
        }
        
    }
    
    @Override
    public void deleteCart(@WebParam(name = "id_keranjang") Integer id_keranjang){
        try{
            String sql="DELETE FROM keranjang where id_keranjang='"+ id_keranjang +"'";
            PreparedStatement pst=con.prepareStatement(sql);
            pst.execute();
        }catch(Exception ex){
            
        }
    }
    
        @Override
        public Integer find(@WebParam(name = "username") String username , @WebParam(name="password") String password){
        try {
         ResultSet rs = null;
            String sql="Select * FROM akun where username='"+ username +"' and password='"+ password +"'";
               PreparedStatement pst=con.prepareStatement(sql);
               rs = pst.executeQuery(); 
               if(rs.next())
                    return 1;
               else
                   return 0;
        } catch (Exception e) {
        }
        return 0;
    }
        
        @Override
        public void insertCart(@WebParam(name = "id_user") Integer id_user , @WebParam(name = "id_produk") Integer id_produk , @WebParam(name="jumlah") Integer jumlah, @WebParam(name="tanggal") String tanggal){
            try {
           String sq="INSERT INTO `keranjang`(`id_user` , `id_produk`, `jumlah`, `tanggal`) VALUES ('"+id_user+"','"+id_produk+"','"+jumlah+"' ,'"+tanggal+"')";
             PreparedStatement pst=con.prepareStatement(sq);
           pst.execute();
        //   update();
        } catch (Exception e) {
          // JOptionPane.showMessageDialog(rootPane, e);
        }
        }
        
        @Override
        public Integer countbyUserID(@WebParam(name="id_user") Integer id_user){
            try{
                ResultSet rs = null;
                String sql = "Select count(*) from keranjang where id_user = '"+id_user+"'";
                PreparedStatement pst=con.prepareStatement(sql);
                rs = pst.executeQuery();
                while(rs.next()){
                    return rs.getInt(1);
                }
            }catch(Exception ex){
                
        }
        return null;
       
       
     
}
}
