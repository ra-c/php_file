<?php
session_start();
$percorso_caricamenti = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "file_caricati";
$lista_file = array_diff(scandir($percorso_caricamenti), array('.', '..'));
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Test file PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "stylesheet" type = "text/css" href = "style.css" />
    <link rel = "stylesheet" type = "text/css" href = "header_style.css" />
</head>
<body>
    <a href="index.php" id="header_link">
    <div class="header">
        <h1>Test File in PHP</h1>
    </div>
    </a>

    <div class="container">
        <div class="column">
            <h2>Carica</h2>
            <span class="errore">
                <?php
                if(!empty($_SESSION['errore_upload'])){
                    echo $_SESSION['errore_upload'];
                    unset($_SESSION['errore_upload']);
                }
                ?>
            </span>

            <form action="carica_file.php" method="POST" enctype="multipart/form-data">
                <label for="campo_file">Inserisci il file da caricare: </label> <br>
                <input type="file" id="campo_file" name="file_caricato" required> <br> <br>
                <input type="submit" name="submit" value="Carica" class="button" required> 
            </form>
        </div>

        <div class="column">
            <h2>Leggi</h2>
            <span class="errore">
                <?php
                if(!empty($_SESSION['messaggio_lettura'])){
                    echo $_SESSION['messaggio_lettura'];
                    unset($_SESSION['messaggio_lettura']);
                }
                ?>
            </span>
            <form action="leggi_file.php" id="form_lettura">
                <input type="text" name="nome_file" placeholder="Nome file..." required> <br> <br>
                <label for="modalita">Modalità di apertura file</label> <br>
                <select name="modalita" id="modalita"> 
                    <option value="r">r</option>
                    <option value="r+">r+</option>
                    <option value="w">w</option>
                    <option value="w+">w+</option>
                    <option value="a">a</option>
                    <option value="a+">a+</option>
                </select>
    
                <label class="binario_checkbox"> <input type="checkbox" name="binario" value="binario"><span class="checkmark" required></span> File binario </label><br> <br>
                <label for="numero_byte">Numero byte</label> <br>
                <input type="number" name="numero_byte" id="numero_byte" required> <br> <br>
                <input type="submit" name="leggi" value="Leggi" class="button" required>
            </form>
        </div>

        <div class="column">
                <h2>Scrivi</h2>
                <span class="messaggio">
                    <?php
                    if(!empty($_SESSION['messaggio_scrittura'])){
                        echo $_SESSION['messaggio_scrittura'];
                        unset($_SESSION['messaggio_scrittura']);
                    }
                    ?>
                </span>
                <span class="errore">
                    <?php
                    if(!empty($_SESSION['errore_scrittura'])){
                        echo $_SESSION['errore_scrittura'];
                        unset($_SESSION['errore_scrittura']);
                    }
                    ?>
                </span>
                <form action="scrivi_file.php" id="form_scrittura">
                    <input type="text" name="nome_file" placeholder="Nome file..." required> <br> <br>
                    <label for="modalita">Modalità di apertura file</label> <br>
                    <select name="modalita" id="modalita">
                        <option value="r">r</option>
                        <option value="r+">r+</option>
                        <option value="w">w</option>
                        <option value="w+">w+</option>
                        <option value="a">a</option>
                        <option value="a+">a+</option>
                    </select>
                    <label class="binario_checkbox"> <input type="checkbox" name="binario" value="binario" required><span class="checkmark"></span> File binario </label><br> <br>

                    <textarea form="form_scrittura" placeholder="Testo..." name="testo"></textarea> <br> <br>
                    <input type="submit" name="scrivi" value="Scrivi" class="button" required>
                </form>
            </div>
            
            
            <div class="column">
                <h2 class="intestazione_campo">File caricati</h2>
                <ul>
                    <?php foreach ($lista_file as $file): ?>
                    <li> <?=$file?> </li>
                    <?php endforeach; ?> 
                </ul>
            </div>
    </div>
</body>
</html>