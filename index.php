<html lang="fi">

<head>
    <meta charset="utf-8" />
    <title> </title>
    <link rel="stylesheet" href="BS/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="BS/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/style.css"/>
    <script src="js/script.js"></script>
</head>

<body>
    <?php
    include "connection.php";
    session_start();
    if (!empty($_SESSION["userId"])) {
        $query = $connection->prepare(
            "SELECT * FROM kayttajat WHERE id = :id"
        );
        $query->execute(array(
            ":id" => $_SESSION["userId"]
        ));
        $result = $query->fetch();
        $displayName = $result["nimi"];
        if ($result["admin"] == 1) {
            if (isset($_GET["tapahtumat"])) {
                require_once __DIR__ . "/view/tapahtumat.php";
            } else if (isset($_GET["osallistujat"])) {
                require_once __DIR__ . "/view/osallistujat.php";
            } else if (isset($_GET["kayttajat"])) {
                require_once __DIR__ . "/view/kayttajat.php";
            } else if (isset($_GET["salasana"])) {
                require_once __DIR__ . "/view/salasana.php";
            } else {
                require_once __DIR__ . "/view/tapahtumat.php";
            }
        } else {
            if (isset($_GET["tapahtumat"])) {
                require_once __DIR__ . "/view/tapahtumat.php";
            } else if (isset($_GET["osallistujat"])) {
                require_once __DIR__ . "/view/osallistujat.php";
            } else if (isset($_GET["salasana"])) {
                require_once __DIR__ . "/view/salasana.php";
            } else {
                require_once __DIR__ . "/view/tapahtumat.php";
            }
        }
    } else {
        require_once __DIR__ . "/view/login-form.php";
    }
    ?>
</body>

</html>