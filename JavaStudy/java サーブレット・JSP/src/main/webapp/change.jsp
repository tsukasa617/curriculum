<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ page import="bean.Bean"%>
<%@ page import="servlet.ServletSearch"%>
<%@page import="java.util.ArrayList,bean.Bean"%>
<%
Bean search = (Bean) request.getAttribute("search");
%>
<link rel="stylesheet" type="text/css"
	href="<%=request.getContextPath()%>/index.css">

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>商品の変更・削除</title>
</head>
<body>
	<h1>商品の変更・削除</h1>

	<br />
	
	<form action="<%=request.getContextPath()%>/servlet/change">

		<p>
			商品コード
			<%=search.getNum()%></p>
		<br />


		<p>
			商品名 <input type="text" placeholder="" size="40" name="name">
		</p>
		<br />
		<p>
			単価 <input type="text" placeholder="" size="20" name="price">
		</p>
		<br />
		<div class="form_conf">

			<input type="submit" name=MySubmit value="消去"> 
			
			<input type="submit" name=MySubmit value="変更">
		</div>
	</form>



</body>
</html>