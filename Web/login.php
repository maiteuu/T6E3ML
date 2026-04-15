<?php 
session_start();
if (isset($_SESSION["nombreUsuario"])) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="irudiak/Ikono-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="estiloa/nireestiloa.css">
    <title>FNFS - Saioa Hasi</title>
</head>

<body class="login-body">
    <main class="login-main">
        <a href="index.php" class="login-logo-link">
            <img src="irudiak/FNFS Logo granate transparente.png" alt="FNFS Logo" class="logoa-login">
        </a>

        <div class="login-txartela">
            <img src="irudiak/foto_perfil_predefinido.webp" alt="Erabiltzailea" class="login-ikonoa">

            <p class="error-mezua">
                <?php if (isset($_GET['error']))
                    echo 'Erabiltzaile edo pasahitza okerra';
                ?>
            </p>
            
            <form action="balidatu.php" method="POST" class="login-form">
                <div class="input-taldea">
                    <label for="user">Erabiltzailea</label>
                    <input type="text" name="user" id="user" required>
                </div>
                
                <div class="input-taldea">
                    <label for="password">Pasahitza</label>
                    <input type="password" name="password" id="password" required>
                </div>
                
                <div class="botoi-ekintzak">
                    <a href="index.php" class="bueltatu-botoia">Bueltatu</a>
                    <input type="submit" value="Sartu" class="sartu-botoia">
                </div>
            </form>
        </div>
    </main>
</body>

</html>