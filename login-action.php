<?php

include "connection.php";
if (! empty($_POST["login"])) {
    session_start();
    $query = $connection->prepare(
        "SELECT * FROM kayttajat WHERE email = :em"
    );
    $query->execute(array(
        ":em" => $_POST["email"]
    ));
    $result = $query->fetch();
    $loginPassword = 0;
    if (! empty($result)) {
        $inputPassword = $_POST["password"];
        $password = $result["salasana"];
        if ($inputPassword == $password) {
            $loginPassword = 1;
        }
        if ($loginPassword == 1) {
            $_SESSION["userId"] = $result["id"];
            $isLoggedIn = true;
        }
    }
    if (! $isLoggedIn) {
        $_SESSION["errorMessage"] = "Väärä sähköpostiosoite tai salasana";
    }
    header("Location: ./?tapahtumat");
    exit();
}
