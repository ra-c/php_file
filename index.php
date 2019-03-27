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
</head>
<body>

    <div>
        <span>
            <?php
            if(!empty($_SESSION['errore_upload'])){
                echo $_SESSION['errore_upload'];
                unset($_SESSION['errore_upload']);
            }
            ?>
        </span>

        <form action="carica_file.php" method="POST" enctype="multipart/form-data">
            <label for="campo_file">Inserisci il file da caricare: </label>
            <input type="file" id="campo_file" name="file_caricato">
            <input type="submit" name="submit" value="Carica"> 
        </form>
    </div>

    <div>
        <form action="operazioni_file.php" id="form_operazioni">
            <input type="text" name="nome_file" placeholder="Nome file...">
            <label for="modalita">Specificare modalità di apertura file</label>
            <select name="modalita" id="modalita">
                <option value="r">r</option>
                <option value="r+">r+</option>
                <option value="w">w</option>
                <option value="w+">w+</option>
                <option value="a">a</option>
                <option value="a+">a+</option>
            </select>
            <input type="checkbox" name="binario" value="binario">File binario<br>

            <div>
                <label for="numero_byte">Numero byte</label>
                <input type="number" name="numero_byte" id="numero_byte">
                <input type="submit" name="leggi" value="Leggi">
            </div>

            <div>
                <textarea form="form_operazioni" placeholder="Testo..."></textarea>
                <input type="submit" name="scrivi" value="Scrivi">
            </div> 
        </form>
    </div>

    <div>
        <ul>
            <?php foreach ($lista_file as $file): ?>
            <li> <?=$file?> </li>
            <?php endforeach; ?> 
        </ul>
    </div>
</body>
</html>