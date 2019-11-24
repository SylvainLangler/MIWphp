<?php
// Boilerplate for exercice DAY 3 at university MIW 05
// Code is bad and poor... but just enough for skills students :-) 

// Redirect to script to send email
if (!empty($_POST['email'])) {

    // Sending invitation by email
    header('Location: send_email.php?mail='.$_POST['email']);
    exit;

}

$body_class = "";

// Display delivery status, (tips anti-refreshing) 
if (!empty($_GET['delivery']) and $_GET['delivery'] === "sent") {
    header('Location: success.php');
}



?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Inscription Christmas Party</title>
        <link rel="stylesheet" href="style.css">

    </head>
    <body>
        <main>
            <form action="#" method="post">
                <input type="email" name="email" placeholder="Ton email de star..." required/>
                <input type="submit" value="Inscris-toi !">
            </form>
        </main>
    </body>
</html>