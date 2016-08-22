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

   if (isset($_POST["id_number"]) && 
       isset($_POST["telephone"]) &&
       isset($_POST["company_name"]) && 
       isset($_POST["address"])) {
      $member->id_number = $_POST["id_number"];
      $member->telephone = $_POST["telephone"];
      $member->company_name = $_POST["company_name"];
      $member->address = $_POST["address"];
      try {
         if ($member->update() == true) {
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=2" />
   <title></title>
   <link href="Content/jquery.mobile-1.4.5.css" rel="stylesheet" />
   <script src="Scripts/jquery-2.1.3.js"></script>
   <script src="Scripts/jquery.mobile-1.4.5.js"></script>
   <script src="Scripts/jquery.query.js"></script>
   <style type="text/css">
      div[data-role='header'] {
         text-align: center;
      }
      .detail_title {
         width: 10em;
         display: block;
         float: left;
      }
      .detail_content {
         float: left;
      }
      #message {
         text-align: center;
         color: red;
      }
   </style>
   <script>
      var input_id = $.query.get("id");
      $(function () {
         load_user();
         $("#message").html(message);
      });

      function load_user() {
         var id = '<?php echo $member->id ?>';
         var code = '<?php echo $member->code ?>';
         var id_number = '<?php echo $member->id_number ?>';
         var archive_id = '<?php echo $member->archive_id ?>';
         var name = '<?php echo $member->name ?>';
         var status = '<?php echo $member->status ?>';
         var dues_date = '<?php echo $member->dues_date ?>';
         var join_date = '<?php echo $member->join_date ?>';
         var telephone = '<?php echo $member->telephone ?>';
         var transfer_date = '<?php echo $member->transfer_date ?>';
         var company_name = '<?php echo $member->company_name ?>';
         var branch_id = '<?php echo $member->branch_id ?>';
         var branch_name = '<?php echo $member->branch_name ?>';
         var title_committee = '<?php echo $member->title_committee ?>';
         var title_branch = '<?php echo $member->title_branch ?>';
         var title_master_branch = '<?php echo $member->title_master_branch ?>';
         var address = '<?php echo $member->address ?>';
         var transfer_out_company = '<?php echo $member->transfer_out_company ?>';
         var gender = '<?php echo $member->gender ?>';
         var nationality = '<?php echo $member->nationality ?>';
         var remark = '<?php echo $member->remark ?>';
         $("#id_number").val('<?php echo $member->id_number ?>');
         $("#telephone").val('<?php echo $member->telephone ?>');
         $("#company_name").val('<?php echo $member->company_name ?>');
         $("#address").val('<?php echo $member->address ?>');

         var li = "";
         li = "<li><span class='detail_title'>党员序号</span><span class='detail_content'>" + code + "</span></li>";
         $("#detail_table").append(li);
         li = "<li><span class='detail_title'>存档编号</span><span class='detail_content'>" + archive_id + "</span></li>";
         $("#detail_table").append(li);
         li = "<li><span class='detail_title'>姓名</span><span class='detail_content'>" + name + "</span></li>";
         $("#detail_table").append(li);
         li = "<li><span class='detail_title'>组织关系状态</span><span class='detail_content'>" + status + "</span></li>";
         $("#detail_table").append(li);
         li = "<li><span class='detail_title'>党费止日期</span><span class='detail_content'>" + dues_date + "</span></li>";
         $("#detail_table").append(li);
         li = "<li><span class='detail_title'>入党日期</span><span class='detail_content'>" + join_date + "</span></li>";
         $("#detail_table").append(li);
         li = "<li><span class='detail_title'>转入日期</span><span class='detail_content'>" + transfer_date + "</span></li>";
         $("#detail_table").append(li);
         li = "<li><span class='detail_title'>支部编号</span><span class='detail_content'>" + branch_id + "</span></li>";
         $("#detail_table").append(li);
         li = "<li><span class='detail_title'>总支名称</span><span class='detail_content'>" + branch_name + "</span></li>";
         $("#detail_table").append(li);
         li = "<li><span class='detail_title'>党内职务(党委)</span><span class='detail_content'>" + title_committee + "</span></li>";
         $("#detail_table").append(li);
         li = "<li><span class='detail_title'>党内职务(支部)</span><span class='detail_content'>" + title_branch + "</span></li>";
         $("#detail_table").append(li);
         li = "<li><span class='detail_title'>党内职务(总支)</span><span class='detail_content'>" + title_master_branch + "</span></li>";
         $("#detail_table").append(li);
         li = "<li><span class='detail_title'>转出单位</span><span class='detail_content'>" + transfer_out_company + "</span></li>";
         $("#detail_table").append(li);
         li = "<li><span class='detail_title'>性别</span><span class='detail_content'>" + gender + "</span></li>";
         $("#detail_table").append(li);
         li = "<li><span class='detail_title'>民族</span><span class='detail_content'>" + nationality + "</span></li>";
         $("#detail_table").append(li);
         li = "<li><span class='detail_title'>备注</span><span class='detail_content'>" + remark + "</span></li>";
         $("#detail_table").append(li);
         $("#detail_table").listview("refresh");
      }
      
   </script>
</head>
<body>
   <div data-role="page">
      <div data-role="header" data-position="fixed" data-fullscreen="false">
         <a href="logon.php">重新登录</a>
         <h1>详细信息</h1>
         <a href="#slide-panel" class="ui-btn-right" data-icon="gear">系统设置</a>
      </div>
      <div data-role="content">
         <form action="member.php" method="POST" data-ajax="false">
         <div data-role="fieldcontain">
            <label for="id_number">身份证号</label>
            <input id="id_number" name="id_number" placeholder="" value="" type="text" maxlength="18" >
         </div>
         <div data-role="fieldcontain">
            <label for="telephone">联系方式</label>
            <input id="telephone" name="telephone"  placeholder="" value="" type="text" maxlength="32" required="required">
         </div>
         <div data-role="fieldcontain">
            <label for="company_name">工作单位</label>
            <input id="company_name" name="company_name" placeholder="" value="" type="text" maxlength="128" required="required">
         </div> 
         <div data-role="fieldcontain">
            <label for="address">家庭地址</label>
            <input id="address" name="address" placeholder="" value="" type="text" maxlength="128">
         </div> 
	 <div data-role="fieldcontain">
	    <p id="message" />
	 </div>
         
         <div data-role="controlgroup" data-type="vertical">
            <button id="submit">提交</button>
         </div>
	 </form>

         <ul data-role="listview" data-inset="true" id="detail_table">
         
         </ul>
      </div>
      <div data-role="panel" id="slide-panel">
         <h2>系统设置</h2>
         <div data-role="controlgroup">
            <a href="password.php" class="ui-btn ui-corner-all">修改密码</a>
            <a href="" data-rel="close" data-role="button">CLOSE</a>
         </div>
      </div>
   </div>
</body>
</html>

