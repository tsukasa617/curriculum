package servlet;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import bean.Bean;
import dao.CSV;

@WebServlet("/servlet/csv")
public class ServletCSV extends HttpServlet {

	public void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {

		try {
			
			//配列宣言	
			ArrayList<Bean> listSearch = new ArrayList<Bean>();
	

			String filename = "csv";

			//CSVクラスをインスタンス化する。                
			CSV csv = new CSV();

			// Beanに、CSVクラスよりsearch関数を呼び出し、全検索メソッド実行
			listSearch = csv.searchList(filename);

			response.setHeader("Content-Type", "text/csv; charset=UTF-8");
			response.setHeader("Content-Disposition", "attachment; filename=\"" + filename + "\"");
			PrintWriter out = response.getWriter();
			out.append("Served at: ").append(request.getContextPath());
	
			

			//フォワード先の指定
			request.getRequestDispatcher("/csv.jsp").forward(request, response);

			
			
		} catch (Exception e) {
			e.printStackTrace();
		}

	}
}