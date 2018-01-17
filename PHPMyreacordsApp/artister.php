<?php
ini_set( "display_errors", 0);
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Artist</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="css/W3.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3mobile.css" />
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
         {
            box-sizing: border-box;
        }

        #myInput {
            background-image: url('icons/Search-48.png');
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
            height:60px;
            padding:0px;
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
                        <button id="btnBack" class="buttonHeader w3-button w3-round-xlarge w3-teal" onclick="goBack()">Go Back</button>
                    </td>
                    <td style="padding-left:50px;">
                        <h4 style="color:antiquewhite;">My artists</h4>
                    </td>
                </tr>
            </table>
        </header>
        <div style="padding-top: 10px;">
            <?php
             if($_COOKIE['id'] != '') {
                $id = $_COOKIE['id'];
                getArtsist($id);
            }
            
            ?>
        </div>
</body>
</html>