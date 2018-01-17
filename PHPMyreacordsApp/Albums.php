<?php
ini_set( "display_errors", 0);
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Albums</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="css/W3.css" rel="stylesheet" />
    <link href="css/w3-theme-black.css" rel="stylesheet" />
    <link href="css/App.css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/jquery.cookie-1.4.1.min.js"></script>
    <script>
function mySearch() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myULArtist");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";

        }
    }
        }

       function goBack() {
                window.history.back();
            }
    </script>
    <style>
        * {
            box-sizing: border-box;
        }

        #myInput {
            background-image: url('/icons/Search-48.png');
            background-position: 10px 12px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        #myULArtist {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

            #myULArtist li a {
                border: 1px solid #808080;
                margin-top: -1px; /* Prevent double borders */
                background-color: #ddd;
                padding: 12px;
                text-decoration: none;
                font-size: 18px;
                color: black;
                display: block
            }

                #myULArtist li a.header {
                    background-color: #e2e2e2;
                    cursor: default;
                }

                #myULArtist li a:hover:not(.header) {
                    background-color: #eee;
                }
        table, tr, td {
            height: 60px;
            padding: 0px;
        }
    </style>
</head>

<body>
    <?php
    function getArtsist($id)
    {
        $client = new SoapClient("http://cdmolnet.se/CDService.asmx?WSDL");
        $params->userID = $id;
        $result = $client->getArtist10($params)->getArtist10Result;
        $Artister = json_decode($result);
        $HTML .= '<input type="text" id="myInput" onkeyup="mySearch()" placeholder="Search for artists.." title="Type in a name">';
        $HTML .= '<ul id="myULArtist">';
        foreach ($Artister as &$value)
        {
            $HTML .= "<li><a href='Albums.php?q=";
            $HTML .= $value->artist;
            $HTML .= "'><span>";
            $HTML .= $value->artist;
            $HTML .= '</a></li>';
        }
        $HTML .= '</ul>';
        echo $HTML;
    }
    ?>
    <header>
        <table>
            <tr>
                <td>
                    <button id="btnBack" class="w3-button w3-round-xlarge w3-teal" onclick="goBack()">Go Back</button>
                </td>
                <td style="padding-left:50px;">
                    <h4 style="color:antiquewhite;">My artists</h4>
                </td>
            </tr>
        </table>
    </header>
    <div>
        <?php
            $q=$_GET["q"];
            if($_COOKIE['id'] != '') {
                $id = $_COOKIE['id'];
            }
            $client = new SoapClient("http://cdmolnet.se/CDService.asmx?WSDL");
            $params->userID = $id;
            $params->Artist = $q;
            $result = $client->getAlbum10($params)->getAlbum10Result;
            $Artister = json_decode($result);
            $HTML;
            foreach ($Artister as &$value) {
                $HTML .= '<ul class="w3-ul w3-card-4 w3-brown">';
                $HTML .= '<li class="w3-padding-16">';
                $HTML .= '<img class="w3-left w3-circle w3-margin-right w3-border" style="width:75px; height=75px;" src="';
                $HTML .= $value->Cover;
                $HTML .= '>';
                $HTML .= '<span class="w3-large">';
                $HTML .= $value->album;
                $HTML .='</span><br><span>';
                $HTML .= $value->Ar;
                $HTML .= '</span><br>';
                $HTML .= '<span>';
                $HTML .= $value->Media;
                $HTML .= '&nbsp;&nbsp;<button class="w3-button w3-green">Tracks</button>';
                $HTML .= '</span>';
                $HTML .= '</ul>';

               // $HTML .= "<a href='tracks.php?q=";
                //$HTML .=  $value->discID;
                //$HTML .= "'";
                //$HTML .= ' class="ui-shadow ui-btn ui-corner-all ui-btn-inline" data-rel="dialog" data-transition="pop">';
                $HTML .= "</li>";
            }
            echo $HTML;
        ?>
    </div>

    <!-- Modal tracks -->
    <div id="modalTracks" class="w3-modal">
        <div class="w3-modal-content">
            <div class="w3-container">
                <span onclick="document.getElementById('modalTracks').style.display='none'"
                    class="w3-button w3-display-topright">
                    &times;
                </span>
                <p>Some text in the Modal..</p>
                <p>Some text in the Modal..</p>
            </div>
        </div>
    </div>
    Try It Yourself »

</body>
</html>