package servlet;

import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.Date;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import bean.Bean;
import dao.BulkRegistration;

@WebServlet("/servlet/bulkRegistration")
public class ServletBulkRegistration extends HttpServlet {

	public void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {

		try {

			// 現在日時情報で初期化されたインスタンスの生成
			Date dateObj = new Date();
			SimpleDateFormat format = new SimpleDateFormat("yyyy/MM/dd ");
			// 日時情報を指定フォーマットの文字列で取得
			String display = format.format(dateObj);
			// bulkRegistration.jspへ
			request.setAttribute("display", display);

			//Beanオブジェクト宣言
			Bean bean = new Bean();

			//パラメータの値取得
			String name = request.getParameter("name");
			int quantity = Integer.parseInt(request.getParameter("quantity"));

			/*
			 *name,quantityを、登録する処理
			 */

			//Registrationクラスをインスタンス化する。                
			BulkRegistration bulkRegistration = new BulkRegistration();

			//1件登録メソッドを呼び出し
			int result = bulkRegistration.insert(name, quantity);

			//フォワード先の指定
			request.getRequestDispatcher("/bulkRegistration.jsp").forward(request, response);

		} catch (IllegalStateException e) {
			e.printStackTrace();
			// bulkRegistration.jspへ	
			request.getRequestDispatcher("/bulkRegistration.jsp").forward(request, response);

		} catch (NumberFormatException e) {
			request.setAttribute("notEnteredQuantity", "数量は１以上100未満を入力してください");
			System.out.println("数量は１以上100未満を入力してください");

			// bulkRegistration.jspへ	
			request.getRequestDispatcher("/bulkRegistration.jsp").forward(request, response);

		} catch (Exception e) {
			e.printStackTrace();
		}
	}
}
