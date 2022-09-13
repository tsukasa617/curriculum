package servlet;

import java.io.IOException;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import bean.Bean;
import dao.Registration;

@WebServlet("/servlet/registration")
public class ServletRegistration extends HttpServlet {

	public void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {

		try {

			//Beanオブジェクト宣言
			Bean bean = new Bean();

			//パラメータの値取得
			bean.setName(request.getParameter("name"));
			bean.setPrice(Integer.parseInt(request.getParameter("price")));

			/*
			 *name,priceを、登録する処理
			 */

			//Registrationクラスをインスタンス化する。                
			Registration registration = new Registration();

			//1件登録メソッドを呼び出し
			int count = registration.insert(bean);

			//	商品名チェック
			if (bean.getName() == "") {
				request.setAttribute("productNameNone", "商品名を入力してください");
				// registration.jspへ	
				request.getRequestDispatcher("/registration.jsp").forward(request, response);
				return;
			} 
			
				//	単価の範囲チェック
			if (bean.getPrice() < 1 || bean.getPrice() >= 100000) {
				request.setAttribute("amountOver", "単価は１以上100000未満を入力してください");
				// registration.jspへ	
				request.getRequestDispatcher("/registration.jsp").forward(request, response);
				return;
			}
			
			//	search.jspへ	
			request.getRequestDispatcher("/search.jsp").forward(request, response);

		} catch (IllegalStateException e) {
			e.printStackTrace();
			// registration.jspへ	
			request.getRequestDispatcher("/registration.jsp").forward(request, response);

		} catch (NumberFormatException e) {
			request.setAttribute("notEnteredPrice", "単価は１以上100000未満を入力してください");
			System.out.println("単価は１以上100000未満を入力してください");

			// registration.jspへ	
			request.getRequestDispatcher("/registration.jsp").forward(request, response);

		} catch (Exception e) {
			e.printStackTrace();
		}
	}
}
