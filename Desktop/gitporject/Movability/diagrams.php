<?php
session_start();
if(isset($_SESSION['email'])) {
$xml=simplexml_load_file("http://zogasmybio.000webhostapp.com/myXML.xml") or die("Error: Cannot create object");
//print_r($xml);
$count=0;
$count2=0;
$re=$re1=0;
$rm=$rm1=0;
$rh=$rh1=0;
foreach ($xml->ramps->ramp as $key) {
    
    if($key->latitude<37.793 && $key->latitude>37.78 && $key->longitude<26.75 && $key->longitude>26.67)
    {
        if($key->difficultness=="Εύκολη")
        {
            $count= $count +3;
            $re=$re+1;
        }
        else if($key->difficultness=="Μέτρια")
        {
            $count= $count +2;
            $rm=$rm+1;
        }
        else
        {
            $count= $count +1;
            $rh=$rh+1;
        }
    }
    else
    {
         if($key->difficultness=="Εύκολη")
        {
            $count2= $count2 +3;
            $re1=$re1+1;
        }
        else if($key->difficultness=="Μέτρια")
        {
            $count2= $count2 +2;
            $rm1=$rm1+1;
        }
        else
        {
            $count2= $count2 +1;
            $rh=$rh+1;
        }
    }
}

foreach ($xml->park_seats->park_seat  as $key) {
    
    if($key->latitude<37.793 && $key->latitude>37.78 && $key->longitude<26.75 && $key->longitude>26.67)
    {
        
            $count= $count +1;
    }
    else
    {
        $count2= $count2+1;
    }
}

?>
<!DOCTYPE html>
<html lang="el">

<head>
    <title>Movability</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */

        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */

        .row.content {
            height: 450px
        }

        /* Set gray background color and 100% height */

        .sidenav {
            padding-top: 20px;
            height: 100%;
        }

        /* Set black background color, white text and some padding */

        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */

        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {
                height: auto;
            }
        }

        .active {
            background-color: lightslategrey;
        }

        .active a {
            color: white;
            font-weight: bold;
        }

        .inactive {
            background-color: #AFD1FF;
        }

        .inactive a {
            color: white;
            font-weight: bold;
        }

              .sidenav p {
            background-color: #AFD1FF;
            padding: 5px 5px 5px 5px;
        }
        
        .sidenav p a{
            color: white;
            background-color: #AFD1FF;
        }
        
        .sidenav p a:hover {
            color: #5a9ffc;
        }

        /* CSS GIA KATATAKSI*/

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        


    </style>
    
    <script>
    <?php   print"var City = {name:\"Καρλόβασι\", points:$count, eramps:$re, mramps:$rm , hramps:$rh};
            var City2 = {name:\"Κιλκίς\", points:$count2, eramps:$re1, mramps:$rm1 , hramps:$rh1};
            var a=[];
            a.push(City);
            a.push(City2);
    "; 
    
    ?>
    
    
    
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Πόλη', 'Πόντοι'],
          ['Κρλόβασι',     <?php print"$count"; ?>],
          ['Κιλκίς',      <?php print"$count2"; ?>]
        ]);

        var options = {
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
      
      
      
    function choose(name){
        
        for(i=0;i<a.length;i++){
           
            if(a[i]["name"]==name){
             
             
       google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart1(a));
      function drawChart1(a) {
        var data = google.visualization.arrayToDataTable([
          ['Δυσκολία', 'Ράμπες'],
          ['Εύκολες',     a[i]["eramps"]],
          ['Μέτριες',      a[i]["mramps"]],
          ['Δύσκολες',     a[i]["hramps"]]
        ]);

        var options = {
          title: 'Ράμπες '+a[i]["name"]
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart1'));
        chart.draw(data, options);
      }
            }
        }
    }
      
    </script>
   
</head>

<body>

    <nav class="navbar">
        <a class="navbar-brand" href="#">
    <img src="sLogo.png" width="160" height="35" alt="">
  </a>
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="background-color:orange;">
        <span style="background-color:white" class="icon-bar"></span>
        <span style="background-color:white" class="icon-bar"></span>
        <span style="background-color:white" class="icon-bar"></span>                        
      </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Αρχική</a></li>
                    <li>&nbsp;</li>
                    <li class="inactive"><a href="sitemap.php"><span class="glyphicon glyphicon-th-list"></span> Περιεχόμενα</a></li>
                    <li class="inactive"><a href="contact.php"><span class="glyphicon glyphicon-phone-alt"></span> Επικοινωνία</a></li>
                    <li class="inactive"><a href="contact.php"><span class="glyphicon glyphicon-phone-alt"></span> Είσοδος Δήμων</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    
                    
                </ul>
            </div>
        </div>
    </nav>


    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <p><a href="index.php" style="font-weight: bold;text-decoration: none">Αρχική</a></p>
                <p><a href="map.php" style="font-weight:bold;text-decoration: none">Χάρτης</a></p>
                <?php if(isset($_SESSION['email'])) { ?>
                <p><a href="#" style="font-weight:bold;text-decoration: none">Διαγράμματα</a></p>
                <p><a href="insertRamps.php" style="font-weight:bold;text-decoration: none">Νέα Καταχώρηση</a></p>
                <p><a href="ReportDisplay.php" style="font-weight:bold;text-decoration: none">Αναφορές ραμπών</a></p>
                <p><a href="Logout.php" style="font-weight:bold;text-decoration: none">Αποσύνδεση</a></p>
                
                <?php } ?>
            </div>
            <div class="col-sm-9 text-left">
                <h4 style="background-color:lightslategrey;color:white;font-weight:bold;padding:3px 3px 3px 3px">&nbsp;Διαγράμματα</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Αρχική</a></li>
                        <li class="breadcrumb-item " aria-current="page">Διαγράμματα</li>
                    </ol>
                </nav>
                 <h4 style="color:lightslategrey;font-weight:bold">Σύνοψη Πόλεων</h4>
               <div id="donutchart"></div>
               <h4 style="color:lightslategrey;font-weight:bold">Επιλογή πόλης</h4>
                    <select class="form-control" id="sel1">
                        <option id="nothing">-- Επιλέξτε μία πόλη --</option>
    <option id="Καρλόβασι">Καρλόβασι</option>
    <option id="Κιλκίς" >Κιλκίς</option>
  </select>
               <div id="donutchart1"></div>
               <div id="donutchart2"></div>
            </div>

           
        </div>
    </div>
    <script>
         $("#sel1").change(function() {
                            var name = $(this).children(":selected").attr("id");
                            choose(name);
                        });
                        
        $("#sel1").trigger('change');
    </script>
    <br>
    </div>
   <footer class="container-fluid visible-lg visible-md" >
        <div class="row">
            <div class="col-md-3">
                <p style="text-align: center;">Περιήγηση</p>
                <div class="col-md-4">
                    <ul style="list-style-type:none;">
                    <li><a style="color: white" href="index.php"><small>></small>Αρχική</a></li>
                    <li><a style="color: white" href="sitemap.php"><small>></small>Περιεχόμενα</a></li>
                    <li><a style="color: white" href="contact.php"><small>></small>Επικοινωνία</a></li>
                </ul>
                </div>
                <div class="col-md-8">
                    <ul style="list-style-type:none;">
                    <li><a href="map.php" style="color: white"><small>></small>Χάρτης</a></li>
                    <li><a href="diagrams.php" style="color: white"><small>></small>Διαγράμματα</a></li>
                    <li><a href="insertRamps.php" style="color: white"><small>></small>Νέα Καταχώρηση</a></li>
                    <a href="Logout.php" style="font-weight:bold;text-decoration: none;color:white"><p>Αποσύνδεση</p></a>
                </ul>
                </div>
            </div>
            <div class="col-md-4">
  
                </div>
                <div class="col-md-5">
                <p style="text-align: center;">Επικοινωνία</p>
                <div class="col-md-6">
                        <p style="color:lightslategrey;"><span class="glyphicon glyphicon-user"></span> Ζώγας Γεώργιος</p>
                        <p style="color:lightslategrey;"><span class="glyphicon glyphicon-envelope"></span> icsd14054@icsd.aegean.com</p>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <p style="color:lightslategrey;"><span class="glyphicon glyphicon-user"></span> Ζαφειρόπουλος Δημήτρης</p>
                        <p style="color:lightslategrey;"><span class="glyphicon glyphicon-envelope"></span> icsd14052@icsd.aegean.com</p>
                    </div>
                
                </div>
        </div>
    </footer>

</body>

<?php }else{
    header("location: index.php");
} ?>
</html>
