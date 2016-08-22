<?php
   $message = "";
   function set_message ($value) {
      global $message;
      $message = $value;
   }
   function append_message ($value) {
      global $message;
      $message = $message . $value;
   }
   function delivery_client_message() {
      global $message;
      echo "<script>";
      echo "var message = '" . $message . "';";
      echo "</script>";
   }
   function delivery_client_variable($variable_name, $variable_value) {
      echo "<script>";
      echo "var " . $variable_name . " = '" . $variable_value . "';";
      echo "</script>";
   }
?>