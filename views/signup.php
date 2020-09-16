<?php
    session_start();
?>

<DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>

    <div id="signupform">

        <h1>Sign up</h1>

        <form action="../controllers/signup.php" method="post">
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
                <label>Forename: </label>
                <input type="text" id="forenames" name="forenames"><br>
            </p>
            <p>
                <label>Surname: </label>
                <input type="text" id="surname" name="surname"><br>
            </p>
            <p>
                <label>Title: </label>
                <input type="text" id="title" name="title"><br>
            </p>
            <p>
                <label>Date of birth: </label>
                <input type="text" id="dateofbirth" name="dateofbirth"><br>
            </p>
            <p>
                <label>Mobile number: </label>
                <input type="text" id="mobilenumber;" name="mobilenumber"><br>
            </p>
            <p>
                <label>Phone number: </label>
                <input type="text" id="phonenumber" name="phonenumber"><br>
            </p>
            <p>
                <label>Email address: </label>
                <input type="text" id="emailaddress;" name="emailaddress"><br>
            </p>
            <p>
                <label>Password: </label>
                <input type="text" id="password" name="password"><br>
            </p>
            <p>
                <label>Repeat password: </label>
                <input type="text" id="repeatpassword" name="repeatpassword"><br>
            </p>
            <p>
                <input class="button" type="submit" id="signup" value="signup">
            </p>
        </form>

    </div>

</body>

</html>
