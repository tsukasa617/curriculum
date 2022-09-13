package dao;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.DecimalFormat;

import bean.Bean;
import db.DB;

public class Change {

	//	DB接続
	DB DB = new DB();

	//指定された1件の商品コードを検索するメソッド
	public Bean selectById(String num) {

		//変数宣言
		Connection con = null;
		Statement statement = null;

		//return用ｵﾌﾞｼﾞｪｸﾄ宣言
		Bean bean = new Bean();

		//SQL文
		String select = "SELECT product_code FROM m_product WHERE product_code = '" + num + "'";

		try {
			con = DB.getConnection();
			statement = con.createStatement();

			//SQLをDBへ発行
			ResultSet rs = statement.executeQuery(select);
			DecimalFormat dformat = new DecimalFormat("000");

			//取得した結果をDTOオブジェクトに格納
			if (rs.next()) {
				bean.setNum(dformat.format(rs.getInt("product_code")));
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
		return bean;

	}

	//データベースへデータを変更するメソッド
	public int update(Bean bean, String num) {

		//変更用変数宣言
		Connection con1 = null;
		Statement statement1 = null;
		int count1 = 0;

		//変数宣言
		Connection con = null;
		Statement statement = null;

		//return用ｵﾌﾞｼﾞｪｸﾄ宣言
		Bean bean1 = new Bean();

		//SQL文
		String select = "SELECT product_code FROM m_product WHERE product_code = '" + num + "'";

		try {
			con = DB.getConnection();
			statement = con.createStatement();
			//SQLをDBへ発行
			ResultSet rs = statement.executeQuery(select);
			DecimalFormat dformat = new DecimalFormat("000");
	
		//変更SQL文
		String updateSQL = "UPDATE m_product SET "
				+ " product_name  =  '" + bean.getName() + "', "
				+ " price = '" + bean.getPrice() + "', "
				+ " WHERE product_code = '" + (dformat.format(rs.getInt("product_code"))) + "'";
		
		con1 = DB.getConnection();
		statement1 = con1.createStatement();

		//SQLをDBへ発行
		count1 = statement1.executeUpdate(updateSQL);
		
		} catch (SQLException e) {
			e.printStackTrace();



		} finally {

			//リソースの開放

			if (statement1 != null) {
				try {
					statement1.close();
				} catch (SQLException ignore) {
				}

			}

			if (con1 != null) {

				try {
					con1.close();
				} catch (SQLException ignore) {
				}

			}
		}
		return count1;

	}

	//論理削除するメソッド
	public int delete(Bean bean) {

		//消去用変数宣言
		Connection con2 = null;
		Statement statement2 = null;

		//return用変数
		int count2 = 0;

		//論理削除SQL文
		String deleteSQL = "UPDATE m_product SET delete_datetime = NOW() WHERE "
				+ "product_name = '" + bean.getName() + "'AND "
				+ "price = '" + bean.getPrice() + "'";

		try {

			con2 = DB.getConnection();
			statement2 = con2.createStatement();

			//SQLをDBへ発行
			count2 = statement2.executeUpdate(deleteSQL);

		} catch (SQLException e) {

			e.printStackTrace();

		} finally {

			//リソースの開放

			if (statement2 != null) {

				try {
					statement2.close();
				} catch (SQLException ignore) {
				}

			}

			if (con2 != null) {

				try {
					con2.close();
				} catch (SQLException ignore) {
				}

			}

		}

		return count2;

	}
}
