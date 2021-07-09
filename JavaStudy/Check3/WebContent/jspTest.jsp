<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link rel="stylesheet" type="text/css" href="css/style.css" >
<title>Insert title here</title>

</head>
<body>

<!-- name、idの入力エリアを作成しなさい -->

  <%@ include file="header.jsp"%>

   <div class="main">



                  <ul>      <li>  <th>
                            name
                        </th>
<td>
    <input type="text" name="user_id" value="" size="24">
  </td>　 </li>

             <li>      <th>
                        id
                       </th>
 <td>
  <input type="password" name="password" value="" size="24">
</td> </li>

</ul>
  </div>
 <%@ include file="footer.jsp"%>

</body>
</html>