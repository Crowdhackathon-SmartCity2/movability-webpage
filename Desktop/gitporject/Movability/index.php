<?php
session_start();

if(isset($_POST['email']) && isset($_POST['password']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $xml = simplexml_load_file('../ReactAPI/Login.xml');
    $answer = array("answer"=>"Email or  Password is not matching");
    $city = "";
    
    if((string)$xml->accounts->account->password == $password && (string)$xml->accounts->account->email == $email)
    {
      $_SESSION['email'] = $email;
      $_SESSION['city'] = (string) $xml->accounts->account->city;
    }

    

}


$xml=simplexml_load_file("http://zogasmybio.000webhostapp.com/myXML1.xml") or die("Error: Cannot create object");
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
    <style>
    .LoginForm
    {
        background-color: lightslategrey;
    padding: 15px 15px 15px 15px;
    color: white;
    }
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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="background-color:lightslategrey;">
        <span style="background-color:white" class="icon-bar"></span>
        <span style="background-color:white" class="icon-bar"></span>
        <span style="background-color:white" class="icon-bar"></span>                        
      </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span> Αρχική</a></li>
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
                <a href="#" style="font-weight: bold;text-decoration: none;color:white"><p>Αρχική</p></a>
                <a href="map.php" style="font-weight:bold;text-decoration: none;color:white"><p>Χάρτης</p></a>
                <?php if(isset($_SESSION['email'])) { ?>
                <a href="diagrams.php" style="font-weight:bold;text-decoration: none;color:white"><p>Διαγράμματα</p></a>
                <a href="insertRamps.php" style="font-weight:bold;text-decoration: none;color:white"><p>Νέα Καταχώρηση</p></a>
                <a href="ReportDisplay.php" style="font-weight:bold;text-decoration: none;color:white"><p>Αναφορές ραμπών</p></a>
                <a href="Logout.php" style="font-weight:bold;text-decoration: none;color:white"><p>Αποσύνδεση</p></a>
                <?php }?>
                <form><input id="search" placeholder="Αναζήτηση" class="form-control" type="text"></form>
            </div>
            <?php if(!isset($_SESSION['email'])) { ?>
            <div class="col-sm-6 text-left">
                <?php }else if(isset($_SESSION['email'])) { ?>
                <div class="col-sm-9 text-left">
                    <?php } ?>
                <h4 style="background-color:lightslategrey;color:white;font-weight:bold;padding:3px 3px 3px 3px">&nbsp;Λίγα λόγια</h4>
                <p style="color:lightslategrey;font-size:16px">Το εν λόγω project είναι μία δράση σχετικά με την δυσκολία μετακίνησης εκατοντάδων πολιτών με κινητικά προβλήματα εντός των πόλεων και έχει ως στόχο να διευκολύνει στο έπαρκο τα άτομα αυτά όσων αφορά την μεταφορά τους από ένα σημείο της πόλης στο άλλο με ασφάλεια, ταχύτητα και αξιοπιστία. Οι πολίτες που αντιμετωπίζουν κινητικές δυσκολίες και χρησιμοποιούν αμαξίδιο για την μεταφορά τους χρίζουν αμέριστου σεβασμού τόσο από την κοινωνία όσο και από την πολιτεία. Με την εφαρμογή αυτή μπορεί ο οποιοσδήποτε με τη βοήθεια ενός περιηγητή να δει στον χάρτη τα σημεία πρόσβασης με ράμπες για την κίνηση μεταξύ των πεζοδρομίων αλλά και την είσοδο σε δημόσια κτίρια Επιπλέον μπορεί να εντοπίσει τα σημεία στα οποία υπάρχουν θέσεις πάρκινγκ αποκλειστικά για άτομα με αναπηρία. O χάρτης εντοπίζει την τοποθεσία του ατόμου αυτόματα για την καλύτερη εξυπηρέτηση ωστόσο δίνεται και η δυνατότητα επιλογής της πόλης από τον χρήστη.</p>
                <hr>
                <h4 style="background-color:lightslategrey;color:white;font-weight:bold;padding:3px 3px 3px 3px">&nbsp;Στόχος</h4>
                <p style="color:lightslategrey;font-size:16px">Το αστικό περιβάλλον θα πρέπει να είναι προσαρμοσμένο στις ανάγκες των πολιτών ιδιαίτερα όταν υπάρχουν πολίτες που αντιμετωπίζουν κινητικές δυσκολίες. Η κάθε πόλη θα πρέπει να έχει προδιαγραφές και υποδομές που να καλύπτουν τις ανάγκες των ατόμων με αναπηρία. Έτσι λοιπόν είναι σημαντικό να υπάρχουν σε όλα τα πεζοδρόμια ράμπες για την πρόσβαση από ΑμΕΑ που θα τους δίνουν την δυνατότητα να κινούνται αυτόνομα μέσα στην πόλη. Επιπλέον όλα τα δημόσια κτίρια πρέπει να είναι προσβάσιμα με ευκολία από άτομα με κινητικές δυσκολίες καθώς επίσης να υπάρχουν και σε αρκετά σημεία της πόλης θέσεις parking για άτομα που χρησιμοποιούν αμαξίδιο. Όλα αυτά λοιπόν λαμβάνονται υπόψιν μαζί με την έκταση και τον πληθυσμός της κάθε πόλης και βγαίνει μία βαθμολογία η οποία δείχνει το πόσο φιλική είναι είναι η πόλη προς τα ΑμΕΑ. Με βάση αυτό θα μπορούσε να υπάρχει ένα ευρωπαϊκό πρότυπο που να πιστοποιεί τις πόλεις σύμφωνα με τα παραπάνω κριτήρια έτσι ώστε να δίνεται κίνητρο για την αναβάθμιση των υποδομών που θα οδηγήσουν στην βελτίωση της ζωής των πολιτών. </p>
                <hr>
                <h4 style="background-color:lightslategrey;color:white;font-weight:bold;padding:3px 3px 3px 3px">&nbsp;Κατάταξη</h4>
                <table>
                    <tr>
                        <th>θΕΣΗ</th>
                        <th>ΠΟΛΗ</th>
                        <th>ΝΟΜΟΣ</th>
                        <th>ΒΑΘΜΟΛΟΓΙΑ</th>
                    </tr>
                    <tr>
                        <td>1</td>
                            <td>ΚΙΛΚΙΣ</td>
                            <td>ΚΙΛΚΙΣ</td>
                            <td><?php print  $count2; ?></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>ΚΑΡΛΟΒΑΣΙ</td>
                        <td>ΣΑΜΟΥ</td>
                        <td><?php print  $count; ?></td>
                    </tr>

                </table>
            </div>
            <?php if(!isset($_SESSION['email'])) { ?>
            <div class="col-md-3 LoginForm" >
        <h2> Είσοδος Δήμου</h1>
<form method="POST" action="https://zogasmybio.000webhostapp.com/Movability/index.php">
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input id="email" name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label  for="exampleInputPassword1">Κωδικός</label>
    <input id="password" name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button id="Login" type="submit" class="btn btn-primary">Αποστολή</button>
</form>
</div> 
<?php } ?>
<script>

   /* $("#Login").click(function(){
        var email1=$('#email').val();
        var pass1=$('#password').val();
        //alert(email1 + pass1)
      
              $.ajax({
  method: "POST",
  url: "http://zogasmybio.000webhostapp.com/ReactAPI/Login.php",
  data: { password: pass1, email: email1 }
})
  .done(function( msg ) {
    alert( "Data Saved: " + msg );
  });
              
              
});*/
</script>


        </div>
    </div>
    <br>
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
