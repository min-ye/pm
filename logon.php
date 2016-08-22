<?php
   if (isset($_POST["user_id"]) && isset($_POST["password"])) {
      $code = $_POST["user_id"];
      $password = $_POST["password"];
      if (check_user($code, $password)) {
         session_start();
         $id = get_id($code);
         $_SESSION['id']=$id;
         if ($password == '123') {
            header ("Location: password.php");
         }
         else {
            header ("Location: member.php");
         }
         exit();
      }
   }

   function check_user($code, $password) {
      $output = false;
      $con = mysql_connect("localhost", "root", "sql123");
      if (!$con) {
         echo "连接数据库失败!";
         exit;
      }
      else {
         $database = mysql_select_db("pm", $con);
         $query = "select * from member where code = " . $code;
         $result = mysql_query($query, $con);
         $row = mysql_fetch_array($result);
         if (mysql_num_rows($result)) {
            if ($password == $row['password']) {
               $output = true;
            }
            else {
               echo "<script>";
               echo "var message = '密码错误'";
               echo "</script>";
            }
         }
         else {
            echo "<script>";
            echo "var message = '序号错误'";
            echo "</script>";
         }
         mysql_close($con);
         return $output;
      }
   }

   function get_id($code) {
      $output = 0;
      $con = mysql_connect("localhost", "root", "sql123");
      if (!$con) {
         echo "连接数据库失败!";
         exit;
      }
      else {
         $database = mysql_select_db("pm", $con);
         $query = "select * from member where code = " . $code;
         $result = mysql_query($query, $con);
         $row = mysql_fetch_array($result);
         if (mysql_num_rows($result)) {
            $output = $row['id'];
         }
         else {
            echo "<script>";
            echo "var message = '序号错误'";
            echo "</script>";
         }
         mysql_close($con);
         return $output;
      }
   }
?>
<head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=2" />
   <title></title>
   <link href="Content/jquery.mobile-1.4.5.css" rel="stylesheet" />
   <script src="Scripts/jquery-2.1.3.js"></script>
   <script src="Scripts/jquery.mobile-1.4.5.js"></script>
   <style type="text/css">
      div[data-role='header'] {
         text-align: center;
      }
   </style>
   <script>
      $(function() {
         $("#message").html(message);
      });
   </script>
</head>
<body>
   <div data-role="page">
      <div data-role="header" data-position="fixed" data-fullscreen="false">
         <h1>登录</h1>
      </div>
      <div data-role="content">
         <form action="<?php $_PHP_SELF ?>" method="POST" data-ajax="false" >
   
         <div data-role="fieldcontain">
            <label for="textinput1">用户名：</label>
            <input id="user_id" name="user_id" placeholder="" value="" type="text" maxlength="16" required="required">
         </div>
         <div data-role="fieldcontain">
            <label for="textinput2">密码：</label>
            <input id="password" name="password" placeholder="" value="" type="password" maxlength="16" required="required">
         </div> 
         <br />
	 <div data-role="fieldcontain">
	    <p id="message" />
	 </div>
         <div data-role="controlgroup" data-type="vertical">
            <input type="submit" id="login" value="登录"></input>
         </div>
         </form>
      </div>

   </div>
</body>
</html>
