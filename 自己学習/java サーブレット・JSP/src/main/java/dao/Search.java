package dao;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.DecimalFormat;
import java.util.ArrayList;

import bean.Bean;
import db.DB;

public class Search {

	//	DB接続
	DB DB = new DB();

	// 送信された商品名を元に商品コード、商品名、単価を検索するためのメソッド
	public ArrayList<Bean> search(String name) {

		//変数宣言
		Connection con = null;
		Statement statement = null;

		//return用オブジェクトの生成
		ArrayList<Bean> listSearch = new ArrayList<Bean>();

		//	商品検索
		String selectSQL = "select product_code,product_name,price from m_product where product_name like '%" + name
				+ "%'";

		try {
			con = DB.getConnection();
			statement = con.createStatement();

			//SQLをDBへ発行
			ResultSet rs = statement.executeQuery(selectSQL);
			DecimalFormat dformat = new DecimalFormat("000");

			if (rs.next() == false) {

				System.out.println("データはありません");
				return listSearch;
			}

			//検索結果を配列に格納
			do {

				Bean bean = new Bean();
				bean.setNum(dformat.format(rs.getInt("product_code")));
				bean.setName(rs.getString("product_name"));
				bean.setPrice(rs.getInt("price"));
				listSearch.add(bean);
			} while (rs.next());

		} catch (

		SQLException e) {
			e.printStackTrace();
		} 
		
		return listSearch;

	}

}
