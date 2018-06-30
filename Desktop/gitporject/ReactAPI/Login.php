<?php
if(isset($_POST['email']) && isset($_POST['password']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $flag=0;
    
    $xml = simplexml_load_file('Login.xml');
    $answer = array("answer"=>"Email or  Password is not matching");
    foreach($xml->accounts->account as $account){ 
    if($account->password == $password && $account->email == $email)
    {
        http_response_code(200);
       $answer = array("answer"=>"success login",'email'=>$email,'password'=>$password);
       echo json_encode($answer);
       $flag=1;
    }
    }
    if($flag==0)
    {
      echo json_encode($answer);  
    }
  
    
}



?>