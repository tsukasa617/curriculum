<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    
    <link rel="stylesheet" type="text/css"
	href="<%=request.getContextPath()%>/index.css">
	
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CSV ダウンロード</title>
</head>
<body>
	<h1>CSV ダウンロード</h1>

	<br />
	
	<form action="<%=request.getContextPath()%>/servlet/csv">
		<div class="form_conf">
			<input type="button" name=MySubmit value="商品別売上集計CSV"  >
			</div>
			
			<br />
			
		<p>
			年月 <input type="text"  size="17" name="date">
		<input type="button" name=MySubmit value="指定年月商品別売上集計CSV" >		
		</p>	
		
		</form>

</body>
</html>