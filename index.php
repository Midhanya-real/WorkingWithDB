<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Processing result</title>
</head>
<body>
<?php
$pdo = new PDO('mysql:dbname=SqlBD;host=localhost:3306', 'root', 'root');    // запрос
$selectQueryuptext = 'SELECT * FROM `uploaded_text`';
$result = $pdo->query($selectQueryuptext)->fetchAll(PDO::FETCH_ASSOC);
?>
<table border=1 width='800px' align=center>
<?php foreach ($result as $row) {?>
    <tr>
        <td><a href="fullContent.php?id=<?= $row['ID'] ?>"><?= $row['ID'] ?></a></td>
        <td><?= substr($row['content'], 0, 80), '...' ?></td>
        <td> <?= $row['date'] ?></td>
        <td><?= $row['words_count'] ?></td>
    </tr>
     <?php } ?>
</table>
<a href="addContent.php">Добавить текст</a>
</body>
</html>

