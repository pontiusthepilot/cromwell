<?php
    session_start();

    if (isset($_SESSION['user']['id']))
    {

    $username = $_SESSION['user']['forenames'];
?>

<DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    
    <h1>Hello <?php echo $username ?></h1>
    <a class="button" href="address.php">Create address</a>
    <a class="button" href="getaddress.php">Edit address</a>
    <a class="button" href="../controllers/logout.php">Logout</a>

</body>

</html>

<?php
    }
    else
    {
        header('Location: ../index.php');
        exit();
    }

?>