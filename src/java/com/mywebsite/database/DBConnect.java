/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mywebsite.database;

import java.sql.Connection;
import java.sql.DriverManager;
import javax.ejb.Stateless;
import javax.swing.JOptionPane;

/**
 *
 * @author ASUS
 */
@Stateless
public class DBConnect {

    // Add business logic below. (Right-click in editor and choose
    // "Insert Code > Add Business Method")
    public static Connection serverConnect()
    {
        Connection con=null;
        try {
            Class.forName("com.mysql.jdbc.Driver");
            con=(Connection) DriverManager.getConnection("jdbc:mysql://localhost:3307/simplesoa?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC","root","");
       
         
        } catch (Exception e) {
            System.out.println("inter.DBConnect.connect()");
            JOptionPane.showConfirmDialog(null,e);
        }
       return con;
    }
}
