<html>

<head>
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="./view/css/style.css" />
</head>

<body>
    <div class="container tile-container text-center">
        <?php
        if (isset($_SESSION["errorMessage"])) {
        ?>
            <div class="validation-message"><?php echo $_SESSION["errorMessage"]; ?></div>
        <?php
            unset($_SESSION["errorMessage"]);
        }
        ?>
        <h2>Kirjaudu Sisään</h2>
        <form action="login-action.php" method="post" id="frmLogin" onSubmit="return validate();">
            <div class="row">
                <label class="text-left" for="email">
                    Sähköposti:
                    <span id="email_info" class="validation-message"></span>
                </label>
                <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="row">
                <label class="text-left" for="password">
                    Salasana:
                    <span id="password_info" class="validation-message"></span>
                </label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
            </div>
            <button type="submit" name="login" value=" " class="full-width btn btn-primary btn-success">Kirjaudu sisään</button>
        </form>
    </div>
    <script>
        function validate() {
            var $valid = true;
            document.getElementById("email_info").innerHTML = "";
            document.getElementById("password_info").innerHTML = "";

            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            if (email == "") {
                document.getElementById("email_info").innerHTML = "pakollinen";
                $valid = false;
            }
            if (password == "") {
                document.getElementById("password_info").innerHTML = "pakollinen";
                $valid = false;
            }
            return $valid;
        }
    </script>
</body>

</html>