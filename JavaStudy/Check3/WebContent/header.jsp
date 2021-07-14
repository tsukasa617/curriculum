<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>

<%@ page import="java.util.Calendar, java.text.SimpleDateFormat"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css" >

<title>Insert title here</title>
</head>
<body>





<header>
<div class="header">
  <label class = "name">login
   <div style="float:left;" class = "name2">
  <%Calendar calendar = Calendar.getInstance();
	SimpleDateFormat sdf = new SimpleDateFormat("yyyy/MM/dd");
	String today =sdf.format(calendar.getTime()) ;
	out.println(today);%>

</div>


  </label>

   </div>
</header>

<!-- </body>
</html> -->
