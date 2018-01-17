<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Untitled Document</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="css/App.css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/jquery.cookie-1.4.1.min.js"></script>
    <script>
        $(document).ready(function () {

            var inloggad = $.cookie("id");
            var namn = $.cookie("name");
            if (inloggad != '') {
                alert('Inloggad');
                document.getElementById("info").innerHTML = "<h3 class='white-text'>Welcome: " + namn + "</h3>";
            }
        })
    </script>
</head>

<body>
    <main>
        <?php
        /*G�r att skicka info till anv�ndarem*/
        function VinylAlert($msg) {
            $info .= '<script type="text/javascript">';
            $info .= '$("info").html("<h1>Welcome</h1>")';
            $info .= '</script>';
        }

        /*Kollar om det fonns cookie p� anv�ndaruppgifter sparade*/
        if($_COOKIE['id'] != '') {
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['id'] = $_COOKIE["id"];
            // VinylAlert("You are logges in!");
        }
        /*Slut autoinlogg*/
        $msg = '';
        if (!empty($_POST['user']) && !empty($_POST['pw'])) {
            $client = new SoapClient("http://cdmolnet.se/CDService.asmx?WSDL");
            $params->usernamn = $_POST['user'];
            $params->password = $_POST['pw'];
            $result = $client->loggaIn($params)->loggaInResult;
            $User = json_decode($result);
            if ($result != 'NO') {
                $myInfo = explode(';', $result);
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['id'] = $myInfo[1];
                //VinylAlert("You are logges in!");
                if(!empty($_POST['komIhag'])) //vi loggar in automatsikt n?sta g?ng
                {
                    $cookie_name =  $myInfo[0];
                    $cookie_id =  $myInfo[1];;
                    setcookie('id', $cookie_id, time() + (86400 * 30), "/"); // 86400 = 1 day
                    setcookie('name', $cookie_name, time() + (86400 * 30), "/"); // 86400 = 1 day
                }
            }else {
                $msg = 'Wrong username or password';
                VinylAlert($msg);
            }
        }
        ?>
        <nav>
            <div class="nav-wrapper blue-grey darken-3">
                <a href="#!" class="brand-logo">MyRecords</a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li>
                        <a id="links" class="white-text modal-trigger waves-effect" href="#inlogg">
                            <i class="fa fa-user "></i> &nbsp;Sign in
                        </a>
                    </li>
                    <li>
                        <a id="links" class="white-text lighten-2" href="#">
                            <i class="fa fa-user-plus "></i> &nbsp;Sign up
                        </a>
                    </li>
                    <li>
                        <a id="links" class="white-text lighten-2" href="#">
                            <i class="fa fa-music "></i> &nbsp;All my records
                        </a>
                    </li>
                    <li>
                        <a id="links" class="white-text lighten-2" href="#">
                            <i class="fa fa-bullseye "></i> &nbsp;My CD:s
                        </a>
                    </li>
                    <li>
                        <a id="links" class="white-text lighten-2" href="#">
                            <i class="fa fa-bullseye "></i> &nbsp;My vinyls
                        </a>
                    </li>
                    <li>
                        <a id="links" class="white-text lighten-2" href="#">
                            <i class="fa fa-server "></i> &nbsp;My latest albums
                        </a>
                    </li>
                    <li>
                        <a id="links" class="white-text lighten-2" href="#">
                            <i class="fa fa-bar-chart "></i> &nbsp;Statistics
                        </a>
                    </li>
                    <li>
                        <a id="links" class="white-text lighten-2" href="#">
                            <i class="fa fa-list-alt "></i> &nbsp;Random playlist
                        </a>
                    </li>
                </ul>
                <ul class="side-nav blue-grey lighten-1" id="mobile-demo">
                    <li>
                        <a id="links" class="black-text modal-trigger waves-effect" href="#inlogg">
                            <i class="fa fa-user "></i>&nbsp;Sign in
                        </a>
                    </li>
                    <li>
                        <a id="links" class="black-text lighten-2" href="#">
                            <i class="fa fa-user-plus "></i>&nbsp;Sign up
                        </a>
                    </li>
                    <li>
                        <a id="links" class="black-text lighten-2" href="#">
                            <i class="fa fa-music "></i>&nbsp;All my records
                        </a>
                    </li>
                    <li>
                        <a id="links" class="black-text lighten-2" href="#">
                            <i class="fa fa-bullseye "></i>&nbsp;My CD:s
                        </a>
                    </li>
                    <li>
                        <a id="links" class="black-text lighten-2" href="#">
                            <i class="fa fa-bullseye "></i>&nbsp;My vinyls
                        </a>
                    </li>
                    <li>
                        <a id="links" class="black-text lighten-2" href="#">
                            <i class="fa fa-server "></i>&nbsp;My latest albums
                        </a>
                    </li>
                    <li>
                        <a id="links" class="black-text lighten-2" href="#">
                            <i class="fa fa-bar-chart "></i>&nbsp;Statistics
                        </a>
                    </li>
                    <li>
                        <a id="links" class="black-text lighten-2" href="#">
                            <i class="fa fa-list-alt "></i>&nbsp;Random playlist
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!--Inlogg form kommer h�r-->
        <div id="inlogg" class="modal">
            <div class="modal-content">
                <h4>Logg in</h4>
                <form class="form" style="padding:10px;" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" accept-charset="UTF-8" id="login-nav">
                    <div class="form-group">
                        <label class="validate" for="exampleInputEmail2">Email address</label>
                        <input type="text" class="form-control" id="user" placeholder="Username" required />
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputPassword2">Password</label>
                        <input type="password" class="form-control" id="pw" placeholder="Password" required />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    </div>
                    <br />
                    <input type="checkbox" class="filled-in" id="komIhag" checked="checked" />
                    <label for="komIhag">Keep me logged-in</label>
                   
                </form>
            </div>
            <div class="modal-footer">
                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>
        <div class="card-panel teal lighten-2 centered">
            <img src="icons/Square150x150Logo.scale-125.png" />
        </div>
        <div id="info" class="card-panel teal darken-4  centered"></div>
            <footer class="footer blue-grey darken-3">
                <div class="footer-copyright">
                    <div class="container">
                        � 2017 MyRecords
                    </div>
                </div>
            </footer>
</main>

        
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
        <script>
$('.button-collapse').sideNav({
      menuWidth: 300, // Default is 240
      closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
    }
  );
            $('.collapsible').collapsible();
              $('.modal-trigger').leanModal();
        </script>
</body>
</html>