package dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;

import db.ConnectionDB;

public class BulkRegistration {

	//	DB接続
	ConnectionDB condb = new ConnectionDB();

	public int insert(String name, int quantity) {

		//変数宣言
		Connection con = null;

		//return用変数
		int result = 0;

		//SQL文
		String insertSQLName = "INSERT INTO m_product (product_name) VALUES(?);";

		//SQL文
		String insertSQLQuantity = "INSERT INTO t_sales (quantity,sales_date) VALUES(?,NOW());";

		try {

			//	商品名と単価の範囲がOKの場合

			con = condb.getConnection();

			PreparedStatement pstmt1 = con.prepareStatement(insertSQLName);
			PreparedStatement pstmt2 = con.prepareStatement(insertSQLQuantity);

			// パラメータの設定
			pstmt1.setString(1, name);
			pstmt2.setInt(1, quantity);

			// SQLの実行
			result = pstmt1.executeUpdate() + pstmt2.executeUpdate();

		} catch (SQLException e) {

			e.printStackTrace();

		} finally {

			//リソースの開放

			if (con != null) {

				try {
					con.close();
				} catch (SQLException ignore) {
				}

			}

		}
		return result;

	}

}
