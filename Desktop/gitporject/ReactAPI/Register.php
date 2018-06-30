<?php
if (isset($_POST['email'])) {
     $email = $_POST['email'];
     $password = $_POST['password'];
     $city = $_POST['city'];

    $xml = simplexml_load_file('Login.xml');

        $p_ramp = $xml->accounts->addChild('account');
        $p_ramp->addChild('email', $email);
        $p_ramp->addChild('password', $password);

    file_put_contents('Login.xml', $xml->asXML());
}
else
{
    http_response_code(400);
    echo json_encode(array("error"=>"no email sent"));
    
}
?>