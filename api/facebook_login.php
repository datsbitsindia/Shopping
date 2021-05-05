<?php

if(isset($_POST['api_id'])){
  require_once '../vendor/autoload.php';   
  include('../includes/crud.php');
  $db=new Database();
  $db->connect();

  $fb = new \Facebook\Facebook([
    'app_id'      => '211451427221143',
  'app_secret'     => '16076aed7d699eae37251a42ca9e0c11',
  'graph_api_version' => 'v5.0'
  ]);


  try {
     
  // Get your UserNode object, replace {access-token} with your token
    $response = $fb->get('/me?fields=id,name,email,gender', $_POST['api_id']);

  } catch(\Facebook\Exceptions\FacebookResponseException $e) {
          // Returns Graph API errors when they occur
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(\Facebook\Exceptions\FacebookSDKException $e) {
          // Returns SDK errors when validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  $me = $response->getGraphUser();
  
  if(isset($me['email']) && $me['email']!='')
  {
      $email = $me['email'];
  }
  else
  {
      $email = '';
  }
 
    $sql_get_query = "SELECT *
          FROM users where api_id=".$me['id'];
    // Execute query
    $db->sql($sql_get_query);
    if(count($db->getResult())>0){
      
      
      $sql_query = "UPDATE users SET name='".$me['name']."', email='".$email."' WHERE api_id='".$me['id']."'";

      if($db->sql($sql_query)){
          $sql_get_query1 = "SELECT *
          FROM users where api_id=".$me['id'];
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
              VALUES('".$me['name']."', '".$me['email']."','".$me['id']."')";

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