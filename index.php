<html lang="fi">

<head>
    <meta charset="utf-8" />
    <title> </title>
    <link rel="stylesheet" href="BS/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="BS/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
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
                echo '
                <nav class="navbar navbar-expand-sm bg-success navbar-dark">
                    <a class="navbar-brand" href="#">Logo</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="./?tapahtumat">Tapahtumat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./?osallistujat">Osallistujat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./?kayttajat">Käyttäjät</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">', $displayName, '
                            <a href="./logout.php" class="btn btn-danger my-2 my-sm-0">
                                Kirjaudu ulos <i class="fa fa-sign-out"></i>
                            </a>
                        </li>
                    </ul>
                </nav>';
                require_once __DIR__ . "/view/tapahtumat.php";
            } else if (isset($_GET["osallistujat"])) {
                echo '
                <nav class="navbar navbar-expand-sm bg-success navbar-dark">
                    <a class="navbar-brand" href="#">Logo</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="./?tapahtumat">Tapahtumat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./?osallistujat">Osallistujat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./?kayttajat">Käyttäjät</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">', $displayName, '
                            <a href="./logout.php" class="btn btn-danger my-2 my-sm-0">
                                Kirjaudu ulos <i class="fa fa-sign-out"></i>
                            </a>
                        </li>
                    </ul>
                </nav>';
                require_once __DIR__ . "/view/osallistujat.php";
            } else if (isset($_GET["kayttajat"])) {
                echo '
                <nav class="navbar navbar-expand-sm bg-success navbar-dark">
                    <a class="navbar-brand" href="#">Logo</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="./?tapahtumat">Tapahtumat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./?osallistujat">Osallistujat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./?kayttajat">Käyttäjät</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">', $displayName, '
                            <a href="./logout.php" class="btn btn-danger my-2 my-sm-0">
                                Kirjaudu ulos <i class="fa fa-sign-out"></i>
                            </a>
                        </li>
                    </ul>
                </nav>';
                require_once __DIR__ . "/view/kayttajat.php";
            } else {
                echo '
                <nav class="navbar navbar-expand-sm bg-success navbar-dark">
                    <a class="navbar-brand" href="#">Logo</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="./?tapahtumat">Tapahtumat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./?osallistujat">Osallistujat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./?kayttajat">Käyttäjät</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">', $displayName, '
                            <a href="./logout.php" class="btn btn-danger my-2 my-sm-0">
                                Kirjaudu ulos <i class="fa fa-sign-out"></i>
                            </a>
                        </li>
                    </ul>
                </nav>';
                require_once __DIR__ . "/view/tapahtumat.php";
            }
        } else {
            if (isset($_GET["tapahtumat"])) {
                echo '
                <nav class="navbar navbar-expand-sm bg-success navbar-dark">
                    <a class="navbar-brand" href="#">Logo</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="./?tapahtumat">Tapahtumat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./?osallistujat">Osallistujat</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">', $displayName, '
                            <a href="./logout.php" class="btn btn-danger my-2 my-sm-0">
                                Kirjaudu ulos <i class="fa fa-sign-out"></i>
                            </a>
                        </li>
                    </ul>
                </nav>';
                require_once __DIR__ . "/view/tapahtumat.php";
            } else if (isset($_GET["osallistujat"])) {
                echo '
                <nav class="navbar navbar-expand-sm bg-success navbar-dark">
                    <a class="navbar-brand" href="#">Logo</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="./?tapahtumat">Tapahtumat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./?osallistujat">Osallistujat</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">', $displayName, '
                            <a href="./logout.php" class="btn btn-danger my-2 my-sm-0">
                                Kirjaudu ulos <i class="fa fa-sign-out"></i>
                            </a>
                        </li>
                    </ul>
                </nav>';
                require_once __DIR__ . "/view/osallistujat.php";
            } else {
                echo '
                <nav class="navbar navbar-expand-sm bg-success navbar-dark">
                    <a class="navbar-brand" href="#">Logo</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="./?tapahtumat">Tapahtumat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./?osallistujat">Osallistujat</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">', $displayName, '
                            <a href="./logout.php" class="btn btn-danger my-2 my-sm-0">
                                Kirjaudu ulos <i class="fa fa-sign-out"></i>
                            </a>
                        </li>
                    </ul>
                </nav>';
                require_once __DIR__ . "/view/tapahtumat.php";
            }
        }
    } else {
        require_once __DIR__ . "/view/login-form.php";
    }
    ?>
</body>

</html>