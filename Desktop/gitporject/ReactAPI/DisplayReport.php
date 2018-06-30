<?php 
 $xml = simplexml_load_file('myXML.xml');
if(isset($_GET['dimos']))
{
    $city = $_GET['dimos'];
    
    $display = array();
    
    foreach($xml->reports->report as $report){
        if($report->City==$city)
        {
            array_push($display,array('report'=>$report));
        }
}

    if(sizeof($display)!=0)
    {
        echo json_encode($display);
        
    }
    else
    {
        echo json_encode(array("error"=> "Wrong City Name or no ramps Found"));
    }
}
else
{
    echo json_encode($xml->reports);
}



?>