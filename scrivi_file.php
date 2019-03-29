<?php
$percorso_caricamenti = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "file_caricati";
session_start();
if (isset($_GET['scrivi'])) {
    if(empty($_GET['nome_file']) ||
    empty($_GET['modalita']) ||
    empty($_GET['testo']) ) {
        $_SESSION['messaggio_scrittura'] = "Compilare tutti i campi";
        header("location: index.php");
        exit();
    }

    if(!preg_match("/^[rwa]\+?$/", $_GET['modalita'])){
        $_SESSION['messaggio_scrittura'] = "Specificare modalità di apertura corretta";
            header("location: index.php");
            exit();
    }
    $modalita = $_GET['modalita'];
    if($_GET['binario'] == 'binario'){
        $modalita .= 'b';
    }

    $file = fopen($percorso_caricamenti . DIRECTORY_SEPARATOR . $_GET['nome_file'], $modalita);

    if($file==false){
        $_SESSION['messaggio_scrittura'] = "Errore durante l'apertura del file";
            header("location: index.php");
            exit();
    }

    $byte_scritti= fwrite($file , $_GET['testo']);
    if ($byte_scritti == false){
        $_SESSION['messaggio_scrittura'] = "fwrite() ha restituito false, si è verificato un errore durante la scrittura o la modalità di apertura scelta non consente la scrittura.";
        header("location: index.php");
        exit();
    } else {
        $_SESSION['messaggio_scrittura'] = "Sono stati scritti " . $byte_scritti . " byte sul file " . $_GET['nome_file'];
        header("location: index.php");
        exit();
    }

} else {
    header("location: index.php");
        exit();
}