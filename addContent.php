<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data entry</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="docs"> <br>
    <textarea name="description"></textarea>><br>
    <input type="submit">
</form>
<a href="index.php">Список обработанных текстов</a>
<?php
$pdo = new PDO ('mysql:dbname=SqlBD;host=localhost:3306', 'root', 'root');

$insertQueryWords = 'INSERT INTO 
word(text_id,word,count) 
VALUES (?,?,?)';
$insertQueryuptext = 'INSERT INTO 
uploaded_text(content, date, words_count) 
VALUES (?,?,?)';
$insertQueryWordsDB = $pdo->prepare($insertQueryWords);
$insertQueryuptextDB = $pdo->prepare($insertQueryuptext);


function countWord($pdo, $word, $insertQueryWordsDB, $insertQueryuptextDB)
{
    $result = [];
    $count = 0;
    $countWord = [];

    $masWord = explode(' ', preg_replace("/[^a-z\']+/", ' ', strtolower($word)));
    $filtMasword = array_filter($masWord, fn($elem) => $elem != '');

    foreach ($filtMasword as $value) {
        $countWord[$value]++;
        $count++;
    }

    $date = date('Y-m-d');
    $insertQueryuptextDB->execute([$word, $date, $count]);
    $text_id = $pdo->lastInsertId();

    foreach ($countWord as $key => $value) {
        $insertQueryWordsDB->execute([$text_id, $key, $value]);
    }
}


if (!empty($_FILES['docs']['name'])) {
    countWord($pdo, file_get_contents($_FILES['docs']['tmp_name']), $insertQueryWordsDB, $insertQueryuptextDB);
}
if (!empty($_POST['description'])) {
    countWord($pdo, $_POST['description'], $insertQueryWordsDB, $insertQueryuptextDB);
}
?>
</body>
</html>