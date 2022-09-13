package dao;

import java.sql.Connection;
import java.sql.SQLException;
import java.sql.Statement;

import bean.Bean;
import db.DB;

public class Registration {

	//	DB接続
	DB DB = new DB();

	//データベースへデータを登録するメソッド
	public int insert(Bean bean) {
		//変数宣言
		Connection con = null;
		Statement smt = null;

		//return用変数
		int count = 0;

		//SQL文
		String insertSQL = "INSERT INTO m_product (product_name,price) VALUES('"
				+ bean.getName() + "','"
				+ bean.getPrice() + "')";

		try {

			//	商品名チェック
			if (bean.getName() == "") {
				System.out.println("商品名を入力してください");
				//	単価の範囲チェック
			} else if (bean.getPrice() < 1 || bean.getPrice() >= 100000) {
				System.out.println("単価は１以上100000未満を入力してください");

			} else {

				//	商品名と単価の範囲がOKの場合

				con = DB.getConnection();

				smt = con.createStatement();

				//SQLをDBへ発行

				count = smt.executeUpdate(insertSQL);
			}
		} catch (SQLException e) {

			System.out.println("登録できません文字数オーバーです");

		} finally {

			//リソースの開放

			if (smt != null) {

				try {
					smt.close();
				} catch (SQLException ignore) {
				}

			}

			if (con != null) {

				try {
					con.close();
				} catch (SQLException ignore) {
				}

			}

		}
		return count;

	}
}
