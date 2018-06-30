<?php
if (isset($_GET['City'])) {
    $prob = $_GET['Problem'];
    $id = $_GET['id'];
     $city = $_GET['City'];

    $xml = simplexml_load_file('myXML.xml');



        $p_ramp = $xml->reports->addChild('report');
        $p_ramp->addChild('ID', 'pr' . $id);
        $p_ramp->addChild('City', $city);
        $p_ramp->addChild('problem', $prob);

    file_put_contents('myXML.xml', $xml->asXML());
}
?>