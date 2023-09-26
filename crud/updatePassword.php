<?php
include "../dataaccess.php";
include "../connection.php";
$dataAccess = new DataAccess($connection);
session_start();
$query = $connection->prepare(
    "SELECT * FROM kayttajat WHERE id = :id"
);
$query->execute(array(
    ":id" => $_SESSION["userId"]
));
$result = $query->fetch();
$success = 0;
if (!empty($result)) {
    $oldPassword = $_POST["oldpswd"];
    $newPassword = $_POST["newpswd"];
    $password = $result["salasana"];
    if ($oldPassword == $password) {
        $setPassword = $newPassword;
        $user = new User("", "", $setPassword, "");
        $user->setID($_SESSION["userId"]);
        $dataAccess->updatePassword($user);
        $success = 1;
    }
    if ($success == 0) {
        $_SESSION["errorMessage"] = "Väärä vanha salasana";
        header("Location: ../?salasana");
    } else{
        header("Location: ../?tapahtumat");
    }
}
exit();
