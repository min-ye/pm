<?php
   class member {
      public $id;
      public $id_number;
      public $code;
      public $archive_id;
      public $name;
      public $status;
      public $dues_date;
      public $join_date;
      public $telephone;
      public $transfer_date;
      public $company_name;
      public $branch_id;
      public $branch_name;
      public $title_committee;
      public $title_branch;
      public $title_master_branch;
      public $address;
      public $transfer_out_company;
      public $gender;
      public $nationality;
      public $remark;
      function  __construct(){
         
         $this->id = 0;
         $this->id_number = 0;
         $this->code = 0;
         $this->archive_id = "";
         $this->name = "";
         $this->status = "";
         $this->dues_date = "";
         $this->join_date = "";
         $this->telephone = "";
         $this->transfer_date = "";
         $this->company_name = "";
         $this->branch_id = "";
         $this->branch_name = "";
         $this->title_committee = "";
         $this->title_branch = "";
         $this->title_master_branch = "";
         $this->address = "";
         $this->transfer_out_company = "";
         $this->gender = "";
         $this->nationality = "";
         $this->remark = "";
      }

      function restore_according_id($id) {
         $output = false;
         $con = mysql_connect("localhost", "root", "sql123");
         mysql_query("set NAMES 'UTF8'");
         if (!$con) {
            echo "Connect database failed!";
            exit;
         }
         else {
            $database = mysql_select_db("pm", $con);
            $query = "select * from member where id = " . $id;
            $result = mysql_query($query, $con);
            $row = mysql_fetch_array($result);
            if (mysql_num_rows($result)) {
               $this->id = $id;
               $this->id_number = $row['id_number'];
               $this->code = $row['code'];
               $this->archive_id = $row['archive_id'];
               $this->name = $row['name'];
               $this->status = $row['status'];
               $this->dues_date = $row['dues_date'];
               $this->join_date = $row['join_date'];
               $this->telephone = $row['telephone'];
               $this->transfer_date = $row['transfer_date'];
               $this->company_name = $row['company_name'];
               $this->branch_id = $row['branch_id'];
               $this->branch_name = $row['branch_name'];
               $this->title_committee = $row['title_committee'];
               $this->title_branch = $row['title_branch'];
               $this->title_master_branch = $row['title_master_branch'];
               $this->address = $row['address'];
               $this->transfer_out_company = $row['transfer_out_company'];
               $this->gender = $row['gender'];
               $this->nationality = $row['nationality'];
               $this->remark = $row['remark'];
            }
            mysql_close($con);
         }
      }

      function update() {
         $output = false;
         $con = mysql_connect("localhost", "root", "sql123");
         mysql_query("set NAMES 'UTF8'");
         if (!$con) {
            echo "Connect database failed!";
            exit;
         }
         else {
            //if (strlen($this->id_number) == 0) {
            //   throw new Exception("id number cannot be blank.");
            //}
            $database = mysql_select_db("pm", $con);
            $query = "update member set id_number = '" . $this->id_number . "',";
            $query = $query . " telephone = '" . $this->telephone . "', ";
            $query = $query . " company_name = '" . $this->company_name . "', ";
            $query = $query . " address = '" . $this->address . "' ";
            $query = $query . " where id = " . $this->id;
            mysql_query($query);
            $count = mysql_affected_rows();
            if ($count == 1) {
               $output = true;
            }
            return $output;
         }
      }
   
      function update_password($password) {
         $output = false;
         $con = mysql_connect("localhost", "root", "sql123");
         mysql_query("set NAMES 'UTF8'");
         if (!$con) {
            echo "Connect database failed!";
            exit;
         }
         else {
            if (strlen($this->id_number) < 3) {
               throw new Exception("密码最少需要三位数字或字母.");
            }
            $database = mysql_select_db("pm", $con);
            $query = "update member set password = '" . $password . "' ";
            $query = $query . " where id = " . $this->id;
            mysql_query($query);
            $count = mysql_affected_rows();
            if ($count == 1) {
               $output = true;
            }
            return $output;
         }
      }
   }
?>
