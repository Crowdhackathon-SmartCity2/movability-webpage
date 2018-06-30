<?php
session_start();
$xml=simplexml_load_file("http://zogasmybio.000webhostapp.com/myXML1.xml") or die("Error: Cannot create object");
//print_r($xml);


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
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
         #map {
        height: 400px;
        width: 100%;
      }
      
      .dot {
  height: 25px;
  width: 25px;
  border-radius: 50%;
  display: inline-block;
}
      
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

        .inactive{
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

    </style>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxFaXfbZCdUQ_3Z-ISLhe6JiZuN676MbY"></script>
    
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
                    <li class="active"><a href="index.php#"><span class="glyphicon glyphicon-home"></span> Αρχική</a></li>
                    <li>&nbsp;</li>
                    <li class="inactive"><a href="sitemap.php"><span class="glyphicon glyphicon-th-list"></span> Περιεχόμενα</a></li>
                    <li class="inactive"><a href="contact.php"><span class="glyphicon glyphicon-phone-alt"></span> Επικοινωνία</a></li>
                   
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
                <p><a href="index.php" style="font-weight: bold;text-decoration: none;">Αρχική</a></p>
                <p><a href="#" style="font-weight:bold;text-decoration: none">Χάρτης</a></p>
               <?php if(isset($_SESSION['email'])) { ?> 
                <p><a href="diagrams.php" style="font-weight:bold;text-decoration: none">Διαγράμματα</a></p>
                <p><a href="insertRamps.php" style="font-weight:bold;text-decoration: none">Νέα Καταχώρηση</a></p>
                <p><a href="ReportDisplay.php" style="font-weight:bold;text-decoration: none">Αναφορές ραμπών</a></p>
                <p><a href="Logout.php" style="font-weight:bold;text-decoration: none">Αποσύνδεση</a></p>
                <?php } ?>
                <form><input id="search" placeholder="Αναζήτηση" class="form-control" type="text"></form>
                </div>
            <div class="col-sm-9 text-left">
                <h3 style="background-color:lightslategrey;color:white;font-weight:bold;padding: 3px 3px 3px 3px">&nbsp;Χάρτης</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Αρχική</a></li>
                        <li class="breadcrumb-item " aria-current="page">Χάρτης</li>
                    </ol>
                </nav>
<div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Σύμβολο</th>
        <th>Σημασία</th>
        <th>Εύκολο</th>
        <th>Μέτριο</th>
        <th>Δύσκολο</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>R</td>
        <td>Είσοδος/Έξοδος αμαξιδίου σε κτήριο/πεζοδρομιο</td>
        <td><span class="dot" style="background-color: #fff200;"></span></td>
        <td><span class="dot" style="background-color: #ff8200;"></span></td>
        <td><span class="dot" style="background-color: #e20000;"></span></td>
      </tr>
      <tr>
        <td>Pr</td>
        <td>Ράμπα αυτοκινήτου</td>
        <td><span class="dot" style="background-color: #17ef00;"></span></td>
        <td><span class="dot" style="background-color: #0fa000;"></span></td>
        <td><span class="dot" style="background-color: #096000;"></span></td>
      </tr>
        <tr>
        <td>P</td>
        <td>Θέση για παρκάρισα ΑμεΑ</td>
        <td><span class="dot" style="background-color: #56b2ef;"></span></td>
        <td><span class="dot" style="background-color: #56b2ef;"></span></td>
        <td><span class="dot" style="background-color: #56b2ef;"></span></td>
      </tr>
    </tbody>
  </table>
  </div>
                <div class="form-group">
                    <h3 style="color:lightslategrey;font-weight:bold">Επιλογή πόλης</h3>
                    <select class="form-control" id="sel1">
    <option class="26.7038391" id="37.7928823">Καρλόβασι</option>
    <option class="22.8717022" id="40.9927727" >Κιλκίς</option>
  </select>
                    <br>

<div id="map"></div>

                    <script>
                        $("#sel1").change(function() {
                            var LATITUDE = $(this).children(":selected").attr("id");
                            var LONGITUDE = $(this).children(":selected").attr("class");
                            map.panTo(new google.maps.LatLng(LATITUDE, LONGITUDE));
                        });

                    </script>
                    <script>
        var map;
        // In the following example, markers appear when the user clicks on the map.
        // Each marker is labeled with a single alphabetical character.
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var labelIndex = 0;

        function initialize() {
            var bangalore = {
                lat: 37.7928823,
                lng: 26.7038391
            };
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: bangalore
            });
            


            <?php 
            
foreach ($xml->ramps->ramp as $key) {
    
print "addMarker({ lat: ".$key->latitude." , lng: ".$key->longitude." }, map,'". $key['ID'] ."','R','".$key->difficultness."'); \n";
}
foreach ($xml->park_seats->park_seat  as $key) {
    
print "addMarker({ lat: ".$key->latitude." , lng: ".$key->longitude." }, map,'". $key['ID'] ."','P'); \n";
}
foreach ($xml->park_ramps->park_ramp   as $key) {
    
print "addMarker({ lat: ".$key->latitude." , lng: ".$key->longitude." }, map,'". $key['ID'] ."','Pr','".$key->difficultness."'); \n";
}


 ?>

        }

        // Adds a marker to the map.
        function addMarker(location, map, label, type, dif = '') {
            var urll;
            if (type == 'R') {
                if (dif == 'Εύκολη') {
                    urll = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + type + '|fff200';
                } else if (dif == 'Μέτρια') {
                    urll = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + type + '|ff8200';
                } else if (dif == 'Δύσκολη') {
                    urll = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + type + '|e20000';
                }
            } else if (type == 'P') {
                urll = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + type + '|56b2ef';
            } else {

                if (dif == 'Εύκολη') {
                    urll = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + type + '|17ef00';
                } else if (dif == 'Μέτρια') {
                    urll = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + type + '|0fa000';
                } else if (dif == 'Δύσκολη') {
                    urll = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + type + '|096000';
                }
            }

            var image = {
                url: urll, // url
            };


            // Add the marker at the clicked location, and add the next-available label
            // from the array of alphabetical characters.
            var marker = new google.maps.Marker({
                position: location,
                label: '',
                map: map,
                icon: image,
            });

            var contentString = 'ID: ' + label + '<br> Δυσκολία:' + dif + '';

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });



        }

        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
                    <hr>
                   
                </div>
            </div>

            </div>
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
                    <li><a href="ReportDisplay.php" style="color: white"><small>></small>Αναφορές ραμπών</a></li>
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

</html>