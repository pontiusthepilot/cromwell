<DOCTYPE html>
<html>
<head>
    <title>Please login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <div id="newuserform">

        <h1>Sign up</h1>

        <form>
            <?php
                if ( isset($_GET['message']) )
                {
            ?>
                    <p class="message"><?php echo $_GET['message'] ?></p>
            <?php
                    unset($_SESSION['message']);
                }
            ?>
            <p>
                <a class="button" href="views/signup.php">Create account</a>
            </p>
        </form>
    </div>

    <div id="loginform">

        <h1>Log in</h1>

        <form action="controllers/login.php" method="post">
            <?php
                if ( isset($_GET['message']) )
                {
            ?>
                    <p class="message"><?php echo $_GET['message'] ?></p>
            <?php
                }
            ?>
            <p>
                <label>E-mail: </label>
                <input type="text" id="email" name="email"><br>
            </p>
            <p>
                <label>Password: </label>
                <input type="password" id="password" name="password"><br>
            </p>
            <p>
                <input class="button" type="submit" id="login" value="login">
            </p>
        </form>

    </div>

</body>

</html>