package study;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class tran {

	public static void main(String[] args) {

		try {
			// JDBCドライバのロード
			Class.forName("com.mysql.cj.jdbc.Driver");
		} catch (ClassNotFoundException e) {
			e.printStackTrace();
		}

		Connection con = null;
		Statement statement = null;
		ResultSet resultSet = null;

		try {
			// データベース接続
			con = DriverManager.getConnection("jdbc:mysql://localhost/bkadai?", "root", "tsukasa617");

			System.out.println("データベースに接続に成功");

			con.setAutoCommit(false);

			con1(con, statement);
			con2(con, statement);
			con3(con, statement);
			con4(con, statement);
			con5(con, "SELECT * FROM m_product");
			con6(con, "SELECT * FROM t_sales");

			con.commit();

		} catch (SQLException e) {
			e.printStackTrace();
			try {

				// トランザクションのロールバック
				con.rollback();

			} catch (SQLException e2) {
				// スタックトレースを出力
				e2.printStackTrace();
			}
			// 	接続の切断
		} finally {
			if (con != null) {

				try {
					con.close();

				} catch (SQLException e3) {
					e3.printStackTrace();
				}
			}
		}

	}

	public static void con1(Connection con, Statement statement) throws SQLException {
		//  商品マスタテーブルのデータを全件消去。
		statement = con.createStatement();
		String rs1 = " truncate table m_product";
		int resultSet1 = statement.executeUpdate(rs1);

		System.out.println("商品マスタのデータを削除しました。");

	}

	public static void con2(Connection con, Statement statement) throws SQLException {
		//  売上テーブルのデータを全件消去。
		statement = con.createStatement();
		String rs2 = "truncate table t_sales";
		int resultSet2 = statement.executeUpdate(rs2);

		System.out.println("売上テーブルのデータを削除しました。");

	}

	public static void con3(Connection con, Statement statement) throws SQLException {
		//  売上テーブルのデータを全件表示。
		Statement pstmt3 = con.createStatement();
		String rs3 = " INSERT IGNORE INTO m_product(product_code,product_name,price) VALUES"
				+ "('001','ノートPC',70000),"
				+ "('002','デスクトップPC',50000),"
				+ "('003','マウス',1000), "
				+ "('004','ペン',1000),"
				+ "('005','紙',100)";
		int resultSet3 = pstmt3.executeUpdate(rs3);

		System.out.println("商品マスタにデータを登録しました。");

	}

	public static void con4(Connection con, Statement statement) throws SQLException {
		//  売上テーブルのデータを全件表示。
		Statement pstmt4 = con.createStatement();
		String rs4 = " INSERT INTO t_sales (sales_date,product_code,quantity ) VALUES "
				+ "('2041/04/01','001',1),"
				+ "('2020/05/01','002',1), "
				+ "('2020/06/01','003',1), "
				+ "('2020/03/01','004',5), "
				+ "('2020/07/01','005',4), "
				+ "('2020/09/01','006',4), "
				+ "('2020/04/01','007',6), "
				+ "('2020/07/01','008',2),"
				+ "('2020/02/01','009',3), "
				+ "('2020/09/01','010',11)";

		int resultSet4 = pstmt4.executeUpdate(rs4);

		System.out.println("売上テーブルにデータを登録しました。");

	}

	public static void con5(Connection con, String s) throws SQLException {
		//  売上テーブルのデータを全件表示。
		PreparedStatement pstmt5 = con.prepareStatement(s);

		ResultSet rs5 = pstmt5.executeQuery();

		while (rs5.next()) {
			System.out.println("商品テーブルのデータを表示します。" + "\n");
			
			System.out.println("商品コード");
			System.out.println(rs5.getInt("product_code"));
			System.out.println("商品名");
			System.out.println(rs5.getString("product_name"));
			System.out.println("単価");
			System.out.println(rs5.getInt("price") + "\n");

		}

		rs5.close();
		pstmt5.close();
	}

	public static void con6(Connection con, String s) throws SQLException {
		//  売上テーブルのデータを全件表示。
	//  売上テーブルのデータを全件表示。
			PreparedStatement pstmt6 = con.prepareStatement(s);

			ResultSet rs6 = pstmt6.executeQuery();

			while (rs6.next()) {
				System.out.println("売上テーブルのデータを表示します。" + "\n");
				
				System.out.println("売上日");
				System.out.println(rs6.getDate("sales_date"));
				System.out.println("商品コード");
				System.out.println(rs6.getInt("product_code"));
				System.out.println("数量");
				System.out.println(rs6.getInt("quantity") + "\n");
				
				
				
			}

			rs6.close();
			pstmt6.close();
		}

	}
