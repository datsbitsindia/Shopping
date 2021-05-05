<?php

if(isset($_POST['api_id'])){
  require_once '../vendor/autoload.php';   
  include('../includes/crud.php');
  $db=new Database();
  $db->connect();
 
    $sql_get_query = "SELECT *
          FROM users where api_id='".$_POST['api_id']."'";
    // Execute query
    $db->sql($sql_get_query);
    if(count($db->getResult())>0){
      
      
      $sql_query = "UPDATE users SET name='".$_POST['name']."', email='".$_POST['email']."' WHERE api_id='".$_POST['api_id']."'";
    
      if($db->sql($sql_query)){
          $sql_get_query1 = "SELECT *
          FROM users where api_id='".$_POST['api_id']."'";
          // Execute query
          $db->sql($sql_get_query1);
        print_r(json_encode($db->getResult()));
      }
      else{
        echo "204:Content Not Proper";
      }

    }
    else{       

      $sql_query = "INSERT INTO users (name, email,api_id)
              VALUES('".$_POST['name']."', '".$_POST['email']."','".$_POST['api_id']."')";
             
      if($db->sql($sql_query)){
        $sql_getquery = "SELECT * FROM users WHERE id=(SELECT max(id) FROM users)";
        $db->sql($sql_getquery);
        print_r(json_encode($db->getResult()));
      }
      else{
        echo "204:Content Not Proper";
      }
    }

}else{
  return "204:Content Not Proper";
}
?>