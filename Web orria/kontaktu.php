<?php session_start(); ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="irudiak/Ikono-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="estiloa/nireestiloa.css">
    <title>FNFS - Iradokizunak</title>
</head>

<body>
    <header>
        <a href="index.php" class="logo-link">
            <img src="irudiak/FNFS Logo blanco transparente.png" alt="FNFS Logo" class="logoa">
        </a>
        
        <nav>
            <div class="menuBotoia"><a href="kontaktu.php">Iradokizunak</a></div>
            <div class="menuBotoia"><a href="taldeak.php">Taldeak</a></div>
            <div class="menuBotoia"><a href="index.php">Hasiera</a></div>
            <div class="menuBotoia"><a href="">Sailkapena</a></div>
            <div class="menuBotoia"><a href="">Fitxaketak</a></div>
            <div class="menuBotoia"><a href="">Partiduak</a></div>
        </nav>

        <div class="saioa-kontenedorea">
            <?php if (!isset($_SESSION["nombreUsuario"])): ?>
                <a href="login.php" class="hasi-saioa-botoia">Saioa Hasi</a>
            <?php else: ?>
                <span class="erabiltzaile-testua">Kaixo, <?php echo $_SESSION["nombreUsuario"]; ?> (<?php echo $_SESSION["tipoUsuario"]; ?>)</span>
                <a href="itxi.php" class="hasi-saioa-botoia">Itxi Saioa</a>
            <?php endif; ?>
        </div>
    </header>

    <main class="iradokizun-main">
        <div class="formulario-txartela">
            
            <?php if(isset($_GET['egoera']) && $_GET['egoera'] == 'ondo'): ?>
                <div class="mezu-berdea">
                    Iradokizuna ondo gorde da! Eskerrik asko.
                </div>
            <?php endif; ?>
            
            <form action="gorde.php" method="POST" class="iradokizun-form">
                
                <div class="input-gaia-taldea">
                    <input type="text" name="gaia" class="iradokizun-input" placeholder="Gaia / Asuntoa" required>
                </div>

                <div class="input-errenkada">
                    <textarea name="mezua" class="testu-eremua" placeholder="Idatzi zure iradokizuna hemen..." required></textarea>
                </div>

                <div class="input-grid-2x2">
                    <div class="input-taldea-iradokizun">
                        <label for="izena" class="etiketa-beltza">Izena</label>
                        <input type="text" name="izena" id="izena" class="iradokizun-input" placeholder="Adibidea: juan" required>
                    </div>
                    
                    <div class="input-taldea-iradokizun">
                        <label for="abizena" class="etiketa-beltza">Abizena</label>
                        <input type="text" name="abizena" id="abizena" class="iradokizun-input" placeholder="Adibidea: agirre" required>
                    </div>
                    
                    <div class="input-taldea-iradokizun">
                        <label for="email" class="etiketa-beltza">Posta</label>
                        <input type="email" name="email" id="email" class="iradokizun-input" placeholder="Adibidea: juanagirre@gmail.com" required>
                    </div>
                    
                    <div class="input-taldea-iradokizun">
                        <label for="telefonoa" class="etiketa-beltza">Telefonoa</label>
                        <input type="text" name="telefonoa" id="telefonoa" class="iradokizun-input" placeholder="Adibidea: 987654321" pattern="[0-9]{9}" required>
                    </div>
                </div>

                <div class="botoi-ekintzak">
                    <input type="submit" value="Bidali" class="sartu-botoia">
                </div>

            </form>
        </div>
    </main>

    <footer>
        <div class="kontaktua">
            <a href="https://www.google.com/maps/place/P.%C2%BA+de+la+Castellana,+151,+4%C2%BAB,+Tetu%C3%A1n,+28046+Madrid/@40.4608003,-3.6930766,663m/data=!3m2!1e3!4b1!4m6!3m5!1s0xd42291b0928b133:0x9b65449e87642aa0!8m2!3d40.4608003!4d-3.6905017!16s%2Fg%2F11lkzhrg_k?entry=ttu&g_ep=EgoyMDI1MTAwNi4wIKXMDSoASAFQAw%3D%3D" target="_blank">P.º de la Castellana, 151, 4ºB</a>
            <p>+34 91 350 25 01</p>
            <a href="mailto:fnfs@fnfs.es">fnfs@fnfs.es</a>
        </div>
        <div class="links">
            <a href="https://www.instagram.com/lnfs89" class="icono instagram" target="_blank"></a>
            <a href="https://www.youtube.com/channel/UCiSSamUOaeCFQS9MXVqhOPw" class="icono youtube" target="_blank"></a>
            <a href="https://www.tiktok.com/@lnfs89?lang=es" class="icono tiktok" target="_blank"></a>
        </div>
    </footer>
</body>
</html>