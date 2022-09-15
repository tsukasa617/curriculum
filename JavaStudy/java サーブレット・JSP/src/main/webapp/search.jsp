<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ page import="bean.Bean"%>
<%@page import="java.util.ArrayList,bean.Bean"%>
<%
ArrayList<Bean> listSearch = (ArrayList<Bean>) request.getAttribute("listSearch");
%>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>商品検索</title>
</head>
<body>
	<h1>商品検索</h1>
	<br />
	<p>商品名</p>


	<form action="<%=request.getContextPath()%>/servlet/search">
		<input type="text" name="name"> <input type="submit"
			value="検索"><br />


		<table border="1">
			<tr>
				<th>商品コード</th>
				<th>商品名</th>
				<th>単価</th>
				<th>操作</th>
			</tr>

			<%
			if (listSearch != null && listSearch.size() != 0) {
				for (int i = 0; i < listSearch.size(); i++) {
                      	%>
                      	
			<tr>
				<td><%=listSearch.get(i).getNum()%></td>
				<td><%=listSearch.get(i).getName()%></td>
				<td><%=listSearch.get(i).getPrice()%></td>
				<td><a
					href="<%=request.getContextPath()%>/servlet/change?product_code=<%=listSearch.get(i).getNum()%>
					product_name=<%=listSearch.get(i).getName()%>price=<%=listSearch.get(i).getPrice()%>">
						編集</a></td>

			</tr>


			<%
			} %>
				</table>
		<%	} else if (listSearch == null) {
			%>
			<p>テーブルデータがありません。</p>
			<%
			} else {
			%>
			<p>該当するデータはありません。</p>
			<%
			}
			%>
		
			

		


	</form>
</body>
</html>