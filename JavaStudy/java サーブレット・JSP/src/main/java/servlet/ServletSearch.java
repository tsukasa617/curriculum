package servlet;

import java.io.IOException;
import java.util.ArrayList;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import bean.Bean;
import dao.Search;

@WebServlet("/servlet/search")
public class ServletSearch extends HttpServlet {

	public void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {

		try {

			//パラメータの値取得
			String name = request.getParameter("name");

			//配列宣言
			ArrayList<Bean> listSearch = new ArrayList<Bean>();

			/*
			 *nameを元に、商品のを検索する関数の呼び出し、結果をJSPに渡す処理
			 */

			//Searchクラスをインスタンス化する。                
			Search bkadaiSearch = new Search();

			//  BkadaiBeanに、BkadaiSearchよりsearch関数を呼び出し、全検索メソッド実行
			listSearch = bkadaiSearch.search(name);

			//検索結果を持ってsearch.jspにフォワード
			request.setAttribute("listSearch", listSearch);

			//フォワード先の指定
			request.getRequestDispatcher("/search.jsp").forward(request, response);

		} catch (IllegalStateException e1) {
			e1.printStackTrace();

		} catch (Exception e2) {
			e2.printStackTrace();

		}

	}

}
