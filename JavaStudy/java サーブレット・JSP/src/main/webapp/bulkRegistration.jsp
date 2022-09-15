<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
	
	<link rel="stylesheet" type="text/css"
	href="<%=request.getContextPath()%>/index.css">
<%@ page import="bean.Bean"%>
<%
String display = (String) request.getAttribute("display");
%>
	
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>売上登録</title>
</head>
<body>
	<h1>売上登録</h1>

	<br />
	<p>売上日 <%=display%></p>
	<br />

<form action="<%=request.getContextPath()%>/servlet/bulkRegistration">
	<p>
		商品名 <select name="name">
			<option>PC</option>
			<option>紙</option>
			<option>ペン</option>
			<option>消しゴム</option>
			<option>マウス</option>
		</select> 
		数量 <input type="text" size="5" name="quantity">
		 <input type="submit" value="追加">
	</p>

	
		<table border="1">
			<tr>
				<th style="width: 200px">商品名</th>
				<th style="width: 80px">数量</th>
			</tr>
		</table>
		<div class="form_conf">
		<input type="submit" value="登録">
		</div>
	</form>
</body>
</html>