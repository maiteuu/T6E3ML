<?php 
session_start();
if (isset($_SESSION["nombreUsuario"])) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="irudiak/Ikono-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="estiloa/nireestiloa.css">
    <title>FNFS - Hasiera</title>
</head>
<body>
    <main>
        <a href="index.php" class="logo-link">
            <img src="irudiak/FNFS Logo granate transparente.png" alt="FNFS Logo" class="logoa">
        </a>

        <p class="error">
            <?php if (isset($_GET['error']))
                echo 'Erabiltzaile edo pasahitza okerra';
            ?>
        </p>
        
        <form action="balidatu.php" method="POST">
            <label for="">Erabiltzaile: </label>
            <input type="text" name="user" required><br><br>
            <label for="">Pasahitza: </label>
            <input type="password" name="password" required><br><br>
            <input type="submit" value="Sartu">
        </form>
    </main>
</body>