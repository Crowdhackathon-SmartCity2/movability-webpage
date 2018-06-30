<?php
session_start();
if(isset($_SESSION['email'])) {
if (isset($_POST['confirm'])) {
     $typos = $_POST['typos'];
     $perigrafi = $_POST['perigrafi'];
     $dyskolia = $_POST['dyskolia'];
    $long = $_POST['long'];
    $lat = $_POST['lat'];
     $city = $_POST['city'];




    $xml = simplexml_load_file('myxmlTest.xml');


    if ($typos == "Ράμπα") {
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
    file_put_contents('myxmlTest.xml', $xml->asXML());
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
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
         #map {
        height: 400px;
        width: 100%;
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
      
      hr{
          display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;
    padding: 0; 
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
                <br>
                <p><a href="index.php" style="font-weight: bold;text-decoration: none">Αρχική</a></p>
                <p><a href="map.php" style="font-weight:bold;text-decoration: none">Χάρτης</a></p>
                <p><a href="diagrams.php" style="font-weight:bold;text-decoration: none">Διαγράμματα</a></p>
                <p><a href="insertRamps.php" style="font-weight:bold;text-decoration: none">Νέα Καταχώρηση</a></p>
                <p><a href="ReportDisplay.php" style="font-weight:bold;text-decoration: none">Αναφορά ραμπών</a></p>
                <p><a href="Logout.php" style="font-weight:bold;text-decoration: none">Αποσύνδεση</a></p>
                <form><input id="search" placeholder="Αναζήτηση" class="form-control" type="text"></form>
            </div>
           
            <div class="col-sm-9 text-left">
                 <h3 style="background-color:lightslategrey;color:white;font-weight:bold;padding: 3px 3px 3px 3px">&nbsp;Νέα Καταχώρηση</h3>
                <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php#">Αρχική</a></li>
    <li class="breadcrumb-item" aria-current="page">Νέα καταχώρηση</li>
  </ol>
</nav>
               
                <?php
                if (isset($_POST['confirm'])) {
                print "<br><h4 style='color:green;'> Η καταχώρηση έγινε επιτυχώς, αναμένετε έγκριση</h4>
                <p style='color:green;'> Πόλη: $city</p>
                <p style='color:green;'> Τύπος: $typos</p>
                <p style='color:green;'> Περιγραφή: $perigrafi</p>
                <p style='color:green;'> Δυσκολία: $dyskolia</p>
                <p style='color:green;'> Γεωγραφικό Πλάτος: $long</p>
                <p style='color:green;'> Γεωγραφικό Μήκος: $lat</p>
                <hr>
                ";
                }
                ?>
                
                <h4 style="color:lightslategrey;font-weight:bold"> Πληροφορίες </h4>
                <p style="color:lightslategrey">Σε αυτόν τον χώρο μπορείτε να καταχωρείτε και εσείς οι ίδοι τις ράμπες που υπάρχουν στην περιοχή σας και έπειτα απο έγκριση θα καταμετρώνται και θα είναι ορατά στους χάρτες </p>
                <hr style="color: black">
                <h4 style="background-color:lightslategrey;color:white;font-weight:bold;padding: 3px 3px 3px 3px">&nbsp;Φόρμα Καταχώρησης</h4>
                <br>
                <form style="text-align: center;" name="newEntry" method="POST" id="newEntry" class="form-horizontal" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="city">Πόλη</label><br>
                        <select id="city" class="form-control" name="city">
                            <option>Βαθύ</option>
                            <option>Καρλόβασι</option>
                            <option>Κιλκίς</option>
                            <option>Πυθαγόριο</option>
                        </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="typos">Τύπος</label><br>
                        <select id="typos" class="form-control" name="typos">
                            <option>Ράμπα</option>
                            <option>Parking</option>
                            <option>Ράμπα Parking</option>
                        </select>
                            </div>
                        </div>
                        <br>
                        <label for="dyskolia">Δυσκολία μετακίνησης</label><br>
                        <select id="dyskolia" class="form-control" name="dyskolia">
                            <option>Εύκολη</option>
                            <option>Μέτρια</option>
                            <option>Δύσκολη</option>
                        </select><br>
                        <label for="perigrafi">Περιγραφή</label><br>
                        <select id="perigrafi" class="form-control" name="perigrafi">
                            <option>Είσοδος/έξοδος σε πεζοδρόμιο</option>
                            <option>Είσοδος/έξοδος σε κτήριο</option>
                            <option>Στάθμευση αμαξιδίου</option>
                            <option>Στάθμευση αμαξιδίου σε χώρο supermarket</option>
                        </select><br>


                        <label >Σημείο στον χάρτη</label>
                        <br>
                        <div  id="map" style="height:300px;"></div>
                        <script>
                            // Note: This example requires that you consent to location sharing when
                            // prompted by your browser. If you see the error "The Geolocation service
                            // failed.", it means you probably did not give permission for the browser to
                            // locate you.
                            var map, infoWindow;
                            function initMap() {
                                map = new google.maps.Map(document.getElementById('map'), {
                                    center: {lat: 37.7910139, lng: 26.7042893},
                                    zoom: 15
                                });
                                infoWindow = new google.maps.InfoWindow;
                                google.maps.event.addListener(map, 'click', function (event) {
                                    placeMarker(map, event.latLng);
                                });

                                // Try HTML5 geolocation.
                                if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition(function (position) {
                                        var pos = {
                                            lat: position.coords.latitude,
                                            lng: position.coords.longitude
                                        };

                                        infoWindow.setPosition(pos);
                                        infoWindow.setContent('Location found.');
                                        infoWindow.open(map);
                                        map.setCenter(pos);
                                    }, function () {
                                        handleLocationError(true, infoWindow, map.getCenter());
                                    });
                                } else {
                                    // Browser doesn't support Geolocation
                                    handleLocationError(false, infoWindow, map.getCenter());
                                }
                            }

                            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                                infoWindow.setPosition(pos);
                                infoWindow.setContent(browserHasGeolocation ?
                                        'Error: The Geolocation service failed.' :
                                        'Error: Your browser doesn\'t support geolocation.');
                                infoWindow.open(map);
                            }
                            function placeMarker(map, location) {
                                if (marker && marker.setMap) {
                                    marker.setMap(null);
                                }
                                var marker = new google.maps.Marker({
                                    position: location,
                                    map: map
                                });
                                var infowindow = new google.maps.InfoWindow({
                                    content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()

                                });
                                infowindow.open(map, marker);
                                //PERNAME TO LAT KAI TO LONG APO TON MARKER STA INPOUT LAT KAI LONG
                                document.getElementById('lat').value = location.lat();
                                document.getElementById('long').value = location.lng();
                            }
                        </script>
                        <script async defer
                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC51WUh2Zqxg2X2dH6NfeKxdijLal8I0QQ&callback=initMap">
                        </script>
                        <input value=0 class="form-control" id="lat" type="hidden" name="lat" />                      
                        <input value=0 class="form-control" id="long" type="hidden" name="long"/><br>
                        <button class="btn btn-info" type="submit" name="confirm">Καταχώρηση</button>



                    </form>
                    <br><br>
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