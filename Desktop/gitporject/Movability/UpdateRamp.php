<?php 
session_start();
if(isset($_SESSION['email']))
{
    $mail=$_SESSION['email'];
    $city=$_SESSION['city'];

  $xml = simplexml_load_file('../ReactAPI/myXML.xml');
}
else
{
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movability</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
            background-color: #f1f1f1;
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

         .sidenav {
            background-color: white;
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
                    
                </ul>
                </ul>
               <ul class="nav navbar-nav navbar-right">
                    
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav">
               <br>
                <p><a href="index.php" style="font-weight: bold;text-decoration: none">Αρχική</a></p>
                <p><a href="map.php" style="font-weight:bold;text-decoration: none">Χάρτης</a></p>
                <p><a href="diagrams.php" style="font-weight:bold;text-decoration: none">Διαγράμματα</a></p>
                <p><a href="insertRamps.php" style="font-weight:bold;text-decoration: none">Νέα Καταχώρηση</a></p>
                <p><a href="ReportDisplay.php" style="font-weight:bold;text-decoration: none">Αναφορά ραμπών</a></p>
                <p><a href="Logout.php" style="font-weight:bold;text-decoration: none">Αποσύνδεση</a></p>
                
            </div>
            <div class="col-sm-9 text-left">
                <br>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Αρχική</a></li>
                        <li class="breadcrumb-item " aria-current="page">Αναφορές ραμπών</li>
                    </ol>
                </nav>
                <h4 style="background-color:lightslategrey;color:white;font-weight:bold;padding:3px 3px 3px 3px">&nbsp;Αναφορές</h4>
                <?php 
                
                 $display = array();

                ?>

                </script>
                
                <Br>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">RampID</th>
                          <th scope="col">Problem</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                          
                          foreach($xml->reports->report as $report){
                              
                            if($report->City==$city)
                            {
                                print("<tr><th scope='row'>$report->ID</th><td>".$report->problem."</td></tr>");
                            }
                          }

                          ?>
                      </tbody>
                    </table>
                <?php 
                
                ?>
            </div>

        </div>
    </div>
    <br>
   <footer class="container-fluid visible-lg visible-md" style="margin-top:200px" >
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
                </ul>
                </div>
            </div>
            <div class="col-md-4">

                </div>
                <div class="col-md-5">
                <p style="text-align: center;">Αναφορές</p>
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

</html>

