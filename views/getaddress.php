<?php
    session_start();
?>

<DOCTYPE html>
<html>
<head>
    <title>Create address</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>

    <div id="addressform">

        <h1>Create address</h1>

        <form action="../controllers/get_address.php" method="get">
            <?php
                if ( isset($_SESSION['message']) )
                {
            ?>
                    <p class="message"><?php echo $_SESSION['message'] ?></p>
            <?php
                    unset($_SESSION['message']);
                }
            ?>
            <p>
                <label>Contct name: </label>
                <input type="text" id="contactname" name="contactname"><br>
            </p>
            <p>
                <label>Business name: </label>
                <input type="text" id="businessname" name="businessname"><br>
            </p>
            <p>
                <label>Address line 1: </label>
                <input type="text" id="addressline1" name="addressline1"><br>
            </p>
            <p>
                <label>Address line 2: </label>
                <input type="text" id="addressline2" name="addressline2"><br>
            </p>
            <p>
                <label>Postcode: </label>
                <input type="text" id="postcode" name="postcode"><br>
            </p>
            <p>
                <input class="button" type="submit" id="address" value="View address">
            </p>
        </form>

    </div>
</body>

</html>