package db;

import java.sql.Connection;
import java.sql.DriverManager;

public class DB {

	String RDB_DRIVE = "com.mysql.cj.jdbc.Driver";
	String URL = "jdbc:mysql://localhost/bkadai";
	String USER = "root";
	String PASS = "tsukasa617";

	//データベース接続を行うメソッド
	public   Connection getConnection() {
		try {
			Class.forName(RDB_DRIVE);
			Connection con = DriverManager.getConnection(URL, USER, PASS);
			return con;
		} catch (Exception e) {
			throw new IllegalStateException(e);
		}
	
		
	}
	
}
