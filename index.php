<?php
include_once('conect.php');
// nomeia
$file = $_FILES['blocoTxt'];
$filePath = $file['tmp_name'];
// retira o tipo do arquivo
$array = explode('.',$file['name']);
$type = array_pop($array);
// limpa o nome
$cleanName = preg_replace('/[^1-9a-zA-Z]+/', '', implode('',$array));
// seta o novo destino
$uploadedFileName = "txtFiles/$cleanName.$type";
// move o arquivo
if (move_uploaded_file($filePath, $uploadedFileName)) {
    $text = file_get_contents($uploadedFileName);
    $sql = "INSERT INTO txt_teste (file) VALUES (:text)";
    $pdo = $pdo->prepare($sql);
    $pdo->execute([$text]);
}
