package servlet;

import java.io.IOException;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import bean.Bean;
import dao.Change;

@WebServlet("/servlet/change")
public class ServletChange extends HttpServlet {

	public void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {

		try {

			//商品コードsearchオブジェクト宣言
			Bean search = new Bean();
			//Beanオブジェクト宣言
			Bean bean = new Bean();

			//パラメータの取得	 
			String num = request.getParameter("product_code");
			String MyAction = request.getParameter("MySubmit");	

			/*
			 *name,priceを、登録する処理
			 */

			//Changeクラスをインスタンス化する。                
			Change Change = new Change();

			//商品コード検索メソッドを呼び出し
			search = Change.selectById(num);

			//検索結果を持ってchange.jspにフォワード
			request.setAttribute("search", search);
			
			//変更押下されたとき
			if (MyAction.equals("変更")) {
				bean.setName(request.getParameter("name"));
				bean.setPrice(Integer.parseInt(request.getParameter("price")));

				//1件変更メソッドを呼び出し
				int count1 = Change.update(bean, num);

			} 

		} catch (IllegalStateException e) {
			e.printStackTrace();

		} catch (Exception e) {
			e.printStackTrace();
		}

		/*
		 *name,priceを、論理削除する処理
		 */

		try {

			//Beanオブジェクト宣言
			Bean bean = new Bean();

			//パラメータの取得	 
			String MyAction = request.getParameter("MySubmit");
			

			//Changeクラスをインスタンス化する。                
			Change change = new Change();

			/*
			 *name,priceを、論理削除する処理
			 */

			//消去押下されたとき
			if (MyAction.equals("消去")) {
				bean.setName(request.getParameter("name"));
				bean.setPrice(Integer.parseInt(request.getParameter("price")));


				//論理削除メソッドを呼び出し
				int count2 = change.delete(bean);

			}

		} catch (IllegalStateException e) {
			e.printStackTrace();

		} catch (Exception e) {
			e.printStackTrace();
		}

		//フォワード先の指定
		request.getRequestDispatcher("/change.jsp").forward(request, response);

	}

}