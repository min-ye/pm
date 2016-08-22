<?php
   require_once('member_class.php');
   require_once('common.php');
   $message = "";
   $member = new member;
   session_start();
   if (isset($_SESSION["id"])) {
      $id = $_SESSION["id"];
      $member->restore_according_id($id);
   }
   else {
      header("Location: logon.php");
      exit();
   }

   if (isset($_POST["password"])) {
      $password = $_POST["password"];
      try {
         if ($member->update_password($password) == true) {
            set_message("更新成功");
         }
         else {
            set_message("更新失败");
         }
      }
      catch(Exception $e)
      {
         set_message($e->getMessage());
      }
   }
   delivery_client_message();
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
      #message {
         text-align: center;
         color: red;
      }
   </style>
   <script>
      $(function() {
         $("#message").html(message);
         $("#cancel").click(function() {
            location.href = "member.php";
         });
      });
   </script>
</head>
<body>
   <div data-role="page">
      <div data-role="header" data-position="fixed" data-fullscreen="false">
         <a href="logon.php">登录</a>
         <h1>修改密码</h1>
      </div>
      <div data-role="content">
         <form action="<?php $_PHP_SELF ?>" method="POST" data-ajax="false" >
   
         <div data-role="fieldcontain">
            <label for="textinput2">新密码：</label>
            <input id="password" name="password" placeholder="" value="" type="password" maxlength="16" required="required">
         </div> 
         <br />
         <div data-role="fieldcontain">
            <p id="message" />
         </div>
         <div data-role="controlgroup" data-type="vertical">
            <input type="submit" id="login" value="提交"></input>
            <input type="button" id="cancel" value="返回详细信息"></input>
         </div>
         </form>
      </div>

   </div>
</body>
</html>
