<?php
if (isset($_GET['typos'])) {
     $typos = $_GET['typos'];
     $perigrafi = $_GET['perigrafi'];
     $dyskolia = 'Εύκολη';
    $long = $_GET['long'];
    $lat = $_GET['lat'];
     $city = $_GET['city'];


echo "Type= "+$typos+"Perigrafi= "+$perigrafi+"Duskolia= "+ $dyskolia+" Long: "+$long+ "Lat:  "+$lat+" City "+$city;

    $xml = simplexml_load_file('myXML.xml');


    if ($typos == "Ramp") {
        $ramp = $xml->ramps->addChild('ramp');
        $id = count($xml->ramps->ramp);
        $ramp->addAttribute('ID', 'r' . $id);
        $ramp->addAttribute('City', $city);
        $ramp->addChild('description', $perigrafi);
        $ramp->addChild('difficultness', $dyskolia);
        $ramp->addChild('latitude', $lat);
        $ramp->addChild('longitude', $long);
    } else if ($typos == "Parking"){
        $seat = $xml->park_seats->addChild('park_seat');
        $id = count($xml->park_seats->park_seat);
        $seat->addAttribute('ID', 'p' . $id);
        $seat->addAttribute('City', $city);
        $seat->addChild('description', $perigrafi);
        $seat->addChild('latitude', $lat);
        $seat->addChild('longitude', $long);
    }else{
        $p_ramp = $xml->park_ramps->addChild('park_ramp');
        $id = count($xml->park_ramps->park_ramp);
        $p_ramp->addAttribute('ID', 'pr' . $id);
        $p_ramp->addAttribute('City', $city);
        $p_ramp->addChild('description', $perigrafi);
        $p_ramp->addChild('difficultness', $dyskolia);
        $p_ramp->addChild('latitude', $lat);
        $p_ramp->addChild('longitude', $long);
    }
    file_put_contents('myXML.xml', $xml->asXML());
}
?>