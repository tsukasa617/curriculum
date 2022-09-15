package dao;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.DecimalFormat;
import java.util.ArrayList;

import bean.Bean;
import db.ConnectionDB;

public class CSV {

	//	DB接続
	ConnectionDB condb = new ConnectionDB();

	// CSVを出力するためのメソッド
	/**
	 * 
	 *
	 * @param selectSQL
	 * @param con
	 * @param statement
	 * @return listSearchリストに検索結果を格納する
	 * @throws SQLException
	 */
	public ArrayList<Bean> searchList(String filename) {

		//変数宣言
		Connection con = null;
		Statement statement = null;

		//return用オブジェクトの生成
		ArrayList<Bean> listSearch = new ArrayList<Bean>();

		// 商品コード、商品名、単価検索
		String selectSQL1 = "SELECT * FROM m_product LEFT OUTER JOIN t_sales ON m_product.product_code = t_sales.product_code";
	
		try {
			con = condb.getConnection();
			statement = con.createStatement();

			//SQLをDBへ発行
			ResultSet rs1 = statement.executeQuery(selectSQL1);
			DecimalFormat dformat = new DecimalFormat("000");
	
			if (rs1.next() == false) {

				System.out.println("データはありません");
				return listSearch;
			}

			//検索結果を配列に格納
			do {

				Bean bean = new Bean();
				bean.setNum(dformat.format(rs1.getInt("product_code")));
				bean.setName(rs1.getString("product_name"));
				bean.setPrice(rs1.getInt("price"));
				bean.setQuantity(rs1.getInt("quantity"));
				listSearch.add(bean);
			} while (rs1.next());

		} catch (SQLException e) {
			e.printStackTrace();
		} 
		
		return listSearch;
	}

}
