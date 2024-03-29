package dao;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.DecimalFormat;
import java.util.ArrayList;

import bean.Bean;
import db.ConnectionDB;


public class Search {

	//	DB接続
	ConnectionDB condb = new ConnectionDB();

	// 送信された商品名を元に商品コード、商品名、単価を検索するためのメソッド
	/**
     * 商品コード、商品名、単価を検索
     *
     * @param selectSQL
     * @param con
     * @param statement
     * @return listSearchリストに検索結果を格納する
     * @throws SQLException
     */
	public ArrayList<Bean> searchList(String name) {

		//変数宣言
		Connection con = null;
		Statement statement = null;

		//return用オブジェクトの生成
		ArrayList<Bean> listSearch = new ArrayList<Bean>();

		//	商品検索
		String selectSQL = "SELECT product_code,product_name,price FROM m_product WHERE product_name LIKE '%" + name
				+ "%'";

		try {
			con = condb.getConnection();
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

		} catch (SQLException e) {
			e.printStackTrace();
		}
		
		return listSearch;
		
		
		

	}

}
