<?php
if(isset($_POST["submit"])) {
    echo "error";
    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Controleer of het formulier verzonden is
        if (!empty($_POST['username']) &&
            !empty($_POST['email']) &&
            //!empty($_POST['gender']) &&
            !empty($_POST['password']) &&
            !empty($_POST['password2'])
        ) { // Controleer of benodigde velden wel ingevuld zijn
            include "../includes/db.php";

            $username = mysqli_real_escape_string($db, $_POST["username"]);
            $email = mysqli_real_escape_string($db, $_POST["email"]);
            //$gender = mysqli_real_escape_string($db, $_POST["gender"]);
            $gender = '';
            $password = mysqli_real_escape_string($db, md5($_POST["password"]));
            $registerDate = date('Y/m/d', time());

            if ($_POST["password"] != $_POST["password2"]) { // Controleren of wachtwoorden gelijk zijn
                //header("Refresh: 3; url=register.php");
                echo "Oh oh! De wachtwoorden komen niet met elkaar overeen";
                echo "error";
            } elseif (mysqli_num_rows($result) > 0) { //checken of result meer dan 0 rijen teruggegeven, of gebruikersnaam al bestaat
                //header("Refresh: 3; url=register.php");
                echo "Deze gebruikersnaam is al door iemand ander in gebruik!";
                echo "error";
            } else {
                mysqli_query($db, "INSERT INTO users (id, username, email, password, age, gender, registerDate)
										VALUES ('', '$username', '$email', '$password', '', '$gender', '$registerDate') ");
                echo "ok";
            }
        } else {
            //header("Refresh: 3; url=register.php");
            echo "Je moet wel alle velden invullen!";
            echo "error";
        }
    }
}
?>