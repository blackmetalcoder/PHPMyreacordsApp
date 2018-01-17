<?php
setcookie("test_cookie", "test", time() + 3600, '/');
setcookie("usr_name", "Peter Josefsson", time() + 3600, '/');
setcookie("name", "Peter Josefsson", time() + 3600, '/');
setcookie("id", "1", time() + 3600, '/');
?>
<html>
<body>

    <?php
    if(count($_COOKIE) > 0) {
        echo "Cookies are enabled.";
        echo '<br>';
        echo $_COOKIE["test_cookie"];
        echo '<br>';
        echo $_COOKIE["usr_name"];
        echo '<br>';
        echo $_COOKIE["name"];
        echo '<br>';
        echo $_COOKIE["id"];
    } else {
        echo "Cookies are disabled.";
    }
    ?>

</body>
</html>