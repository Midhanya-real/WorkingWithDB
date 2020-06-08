<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detailed analysis</title>
</head>
<body>
<?php
$id = $_GET['id'];
$pdo = new PDO('mysql:dbname=SqlBD;host=localhost:3306', 'root', 'root');
$rsWord = 'SELECT word.text_id,word.word, word.count 
FROM uploaded_text 
RIGHT OUTER JOIN word ON uploaded_text.ID = word.text_id
where text_id = :id';

$selectQueryWordsDB = $pdo->prepare($rsWord);
$selectQueryWordsDB->execute(['id' => $id]);
$selectQueryWords = $selectQueryWordsDB->fetchAll(PDO::FETCH_ASSOC);

$rsText = 'SELECT ID ,content FROM `uploaded_text` where ID=:id';
$selectQueryTextsDB = $pdo->prepare($rsText);
$selectQueryTextsDB->execute(['id' => $id]);
$selectQueryTexts = $selectQueryTextsDB->fetchAll(PDO::FETCH_ASSOC);
?>
<table border=1 width='800px' align=center>
    <?php foreach ($selectQueryTexts as $row) { ?>
        <tr>
            <td><?= $row['content'] ?></td>
        </tr>
    <?php } ?>
</table>
<table border=1 width='800px' align=center>
    <?php foreach ($selectQueryWords as $row) { ?>
        <tr>
            <td><?= $row['text_id'] ?></td>
            <td><?= $row['word'] ?></td>
            <td><?= $row['count'] ?></td>
        </tr>
    <?php } ?>
</table>
<a href="index.php">Список обработанных текстов</a>
<a href="addContent.php">Добавить текст</a>
</body>
</html>