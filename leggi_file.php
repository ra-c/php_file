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
    </head>
    <body>
        <?php if ($file_letto != false): ?>
            <h2>Contenuto file</h2>
            <h3>Percorso: <?=$percorso_caricamenti . DIRECTORY_SEPARATOR . $_GET['nome_file']?> </h3>
            <h3>Byte da leggere: <?=$_GET['numero_byte']?></h3> <br>
            <div><?=$file_letto?></div>
        <?php endif; ?>
    </body>
</html>