<?php
$percorso_caricamenti = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "file_caricati";
session_start();
if(isset($_GET['leggi']))
{
    if(empty($_GET['nome_file']) ||
    empty($_GET['modalita']) ||
    empty($_GET['numero_byte']) ) {
        $_SESSION['messaggio_lettura'] = "Compilare tutti i campi";
        header("location: index.php");
        exit();
    }

    if(!preg_match("/^[rwa]\+?$/", $_GET['modalita'])){
        $_SESSION['messaggio_lettura'] = "Specificare modalità di apertura corretta";
            header("location: index.php");
            exit();
    }
    $modalita = $_GET['modalita'];
    if($_GET['binario'] == 'binario'){
        $modalita .= 'b';
    }

    $file = fopen($percorso_caricamenti . DIRECTORY_SEPARATOR . $_GET['nome_file'], $modalita);

    if($file==false){
        $_SESSION['messaggio_lettura'] = "Errore durante l'apertura del file";
            header("location: index.php");
            exit();
    }

    $file_letto = fread($file, $_GET['numero_byte']);
    if($file_letto == false){
            $_SESSION['messaggio_lettura'] = "Si è verificato un errore durante la lettura del file";
            header("location: index.php");
            exit();
    }

} else {
    header("location: index.php");
        exit();
} ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Test file PHP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = "stylesheet" type = "text/css" href = "header_style.css" />
        <link rel = "stylesheet" type = "text/css" href = "leggi_file.css" />
    </head>
    <body>
    <a href="index.php" id="header_link">
    <div class="header">
        <h1>Test File in PHP</h1>
    </div>
    </a>
        <?php if ($file_letto != false): ?>
            <div id="file_letto">
                <h2>Contenuto file</h2>
                <h3>Percorso: <span class="attribute"><?=$percorso_caricamenti . DIRECTORY_SEPARATOR . $_GET['nome_file']?> </span></h3>
                <h3>Byte da leggere: <span class="attribute"><?=$_GET['numero_byte']?></span></h3> <br>
                <div id="contenuto"><?=$file_letto?></div>
            </div>
        <?php endif; ?>
    </body>
</html>