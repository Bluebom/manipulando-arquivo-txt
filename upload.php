<?php
include_once('conect.php');
$sql = "SELECT * FROM txt_teste";
$pdo = $pdo->prepare($sql);
$pdo->execute();
$row = $pdo->fetch();
$text = '';
if($pdo->rowCount() != 0) $text = $row['file'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="file" name="blocoTxt">
        <button type="submit">Enviar</button>
    </form>
    <?php if($pdo->rowCount() != 0):?>
    <h1>If file already exist</h1>
    <input type="hidden" id="txtData" value="<?= $text ?>">
    <button type="button" id="btnSave" onclick="save()">SAVE</button>
    <script>
        function save() {
            let data = document.getElementById("txtData").value,
                c = document.createElement("a");
            c.download = "jogo";
            var t = new Blob([data], {
                type: "text/plain"
            });
            c.href = window.URL.createObjectURL(t);
            c.click();
        }
    </script>
    <?php endif; ?>
</body>
</html>