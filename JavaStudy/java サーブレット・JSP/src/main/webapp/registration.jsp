<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ page import="bean.Bean"%>
<%
String productNameNone = (String) request.getAttribute("productNameNone");
%>
<%
String amountOver = (String) request.getAttribute("amountOver");
%>
<%
String notEnteredPrice = (String) request.getAttribute("notEnteredPrice");
%>
<%
String productOver = (String) request.getAttribute("productOver");
%>

<link rel="stylesheet" type="text/css"
	href="<%=request.getContextPath()%>/index.css">

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>商品登録</title>
</head>
<body>
	<h1>商品登録</h1>
	<br />
	
	<%
	if (productOver != null) {
	%>
	<%=productOver%>
	<%
	}
	%>

	<%
	if (productNameNone != null) {
	%>
	<%=productNameNone%>
	<%
	}
	%>

<%
	if (notEnteredPrice != null) {
	%>
	<%=notEnteredPrice%>
	<%
	}
	%>
	
	<br />
	
	<%
	if (amountOver != null) {
	%>
	<%=amountOver%> 
	
	<form action="<%=request.getContextPath()%>/servlet/registration">
	
	<br />
	<p>
			商品名 <input type="text" size="40" name="name">
		</p>
		<br />
		<p>
			単価 <input type="text" name="quantity">
		</p>
		<br />
		<div class="form_conf">
			<input type="submit" value="登録">
		</div>

	</form>
	
	<%
	} else {
	%>
	
	<form action="<%=request.getContextPath()%>/servlet/registration">
		<p>
			商品名 <input type="text" size="40" name="name">
		</p>
		<br />
		<p>
			単価 <input type="text" size="20" name="price">
		</p>
		<br />
		<div class="form_conf">
			<input type="submit" value="登録">
		</div>

	</form>
<%
	}
	%>

</body>
</html>