<?php
    session_start();

    if (isset($_SESSION['address'])) {
        $editaddress = $_SESSION['address'];
    }
    else
    {
        $editaddress = false;
    }
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

            <?php
                if ($editaddress)
                {
            ?>
                <form action="../controllers/update_address.php" method="post">
            <?php
                }
                else
                {
            ?>
                <form action="../controllers/create_address.php" method="post">
            <?php
                }
            ?>
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
                <input type="text" id="contactname" name="contactname"
                    <?php
                        if (isset($editaddress))
                        {  
                    ?>
                        value="<?php echo $editaddress['contact_name'] ?>"
                    <?php
                        }
                    ?>
                ><br>
            </p>
            <p>
                <label>Business name: </label>
                <input type="text" id="businessname" name="businessname"
                    <?php
                        if (isset($editaddress))
                        {
                    ?>
                        value="<?php echo $editaddress['business_name'] ?>"
                    <?php
                        }
                    ?>
                ><br>
            </p>
            <p>
                <label>Address line 1: </label>
                <input type="text" id="addressline1" name="address_line1"
                    <?php
                        if (isset($editaddress))
                        {  
                    ?>
                        value="<?php echo $editaddress['address_line1'] ?>"
                    <?php
                        }
                    ?>
                ><br>
            </p>
            <p>
                <label>Address line 2: </label>
                <input type="text" id="addressline2" name="address_line2"
                <?php
                        if (isset($editaddress))
                        {  
                    ?>
                        value="<?php echo $editaddress['address_line2'] ?>"
                    <?php
                        }
                    ?>
                ><br>
            </p>
            <p>
                <label>City: </label>
                <input type="text" id="city;" name="city"
                    <?php
                        if (isset($editaddress))
                        {  
                    ?>
                        value="<?php echo $editaddress['city'] ?>"
                    <?php
                        }
                    ?>
                ><br>
            </p>
            <p>
                <label>County: </label>
                <input type="text" id="county" name="county"
                    <?php
                        if (isset($editaddress))
                        {  
                    ?>
                        value="<?php echo $editaddress['county'] ?>"
                    <?php
                        }
                    ?>
                ><br>
            </p>
            <p>
                <label>Country: </label>
                <input type="text" id="country" name="country"
                    <?php
                        if (isset($editaddress))
                        {  
                    ?>
                        value="<?php echo $editaddress['country'] ?>"
                    <?php
                        }
                    ?>
                ><br>
            </p>
            <p>
                <label>Postcode: </label>
                <input type="text" id="postcode" name="postcode"
                    <?php
                        if (isset($editaddress))
                        {  
                    ?>
                        value="<?php echo $editaddress['postcode'] ?>"
                    <?php
                        }
                    ?>
                ><br>
            </p>
            <p>
                <label>Address type: </label>
                <input type="text" id="addresstype" name="addresstype"
                    <?php
                        if (isset($editaddress))
                        {  
                    ?>
                        value="<?php echo $editaddress['address_type'] ?>"
                    <?php
                        }
                    ?>
                ><br>
            </p>
            <p>
                <?php
                    if ($editaddress)
                    {
                ?>
                    <input class="button" type="submit" id="address" value="Update">
                    <a class="button" href="../controllers/delete_address.php?id=<?php echo $editaddress['id'] ?>">Delete</a>
                <?php
                    }
                    else
                    {
                ?>
                    <input class="button" type="submit" id="address" value="Create address">
                <?php
                    }
                ?>
            </p>
        </form>

    </div>
</body>

</html>