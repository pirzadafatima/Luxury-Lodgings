<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signing Out</title>
</head>
<?php include("connection.php");

    session_start();
    $uname = $_SESSION['uname']; 
    echo "Signing Out , $uname!";
    $session = $_SESSION['session'];
    $uname = NULL;
    $session = false;

    $_SESSION['uname'] = $uname;
    $_SESSION['session'] = $session;

    session_destroy();

    header("Location: http://localhost/login.php", true, 307);
    exit();

?>
<body>
    Redirecting......
</body>
</html>