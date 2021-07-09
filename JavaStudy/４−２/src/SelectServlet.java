import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
/**
 * サーブレット
 * HTMLから情報を受け取り、表示させる処理
 *
 * 問①・②の回答をお願いします。
 *
 */
public class SelectServlet extends HttpServlet {
    public void doPost(HttpServletRequest request, HttpServletResponse response)
            throws IOException, ServletException {
        request.setCharacterEncoding("UTF-8");
        // 問① select.htmlから渡された値を受け取るために下記を修正しましょう。
        String value = request.getParameter("month");
        response.setContentType("text/html; charset=UTF-8");
        PrintWriter out = response.getWriter();
        // 問② エビデンスと同じ表示になるように修正しましょう。
        out.println("今は"+value+"月です。");
    }
}
