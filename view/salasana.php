<div class="container tile-container text-center">
    <?php
    if (isset($_SESSION["errorMessage"])) {
    ?>
        <div class="validation-message"><?php echo $_SESSION["errorMessage"]; ?></div>
    <?php
        unset($_SESSION["errorMessage"]);
    }
    ?>
    <h2>Vaihda salasana</h2>
    <form action="./crud/updatePassword.php" method="post" id="frmLogin" onSubmit="return validate();">
        <div class="row">
            <label class="text-left" for="oldpswd">
                Vanha salasana:
                <span id="oldpswd_info" class="validation-message"></span>
            </label>
            <input type="password" class="form-control" id="oldpswd" placeholder="Vanha salasana" name="oldpswd">
        </div>
        <div class="row">
            <label class="text-left" for="newpswd">
                Uusi salasana:
                <span id="newpswd1_info" class="validation-message"></span>
            </label>
            <input type="password" class="form-control" id="newpswd" placeholder="Uusi salasana" name="newpswd">
        </div>
        <div class="row">
            <label class="text-left" for="cnfrmpswd">
                Vahvista salasana:
                <span id="newpswd2_info" class="validation-message"></span>
            </label>
            <input type="password" class="form-control" id="cnfrmpswd" placeholder="Uusi salasana" name="cnfrmpswd">
        </div>
        <button type="submit" name="valmis" value=" " class="full-width btn btn-primary btn-success">Vaihda salasana</button>
    </form>
</div>
<script>
    function validate() {
        var $valid = true;
        document.getElementById("oldpswd_info").innerHTML = "";
        document.getElementById("newpswd1_info").innerHTML = "";
        document.getElementById("newpswd2_info").innerHTML = "";

        var oldpswd = document.getElementById("oldpswd").value;
        var newpswd1 = document.getElementById("newpswd").value;
        var newpswd2 = document.getElementById("cnfrmpswd").value;
        if (oldpswd == "") {
            document.getElementById("oldpswd_info").innerHTML = "pakollinen";
            $valid = false;
        }
        if (newpswd1 == "") {
            document.getElementById("newpswd1_info").innerHTML = "pakollinen";
            $valid = false;
        }
        if (newpswd2 == "") {
            document.getElementById("newpswd2_info").innerHTML = "pakollinen";
            $valid = false;
        }
        if (newpswd1 != newpswd2) {
            document.getElementById("newpswd1_info").innerHTML = "salasanat eivät täsmää";
            $valid = false;
        }
        return $valid;
    }
</script>