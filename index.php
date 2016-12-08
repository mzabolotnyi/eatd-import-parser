<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Import</title>
    <style>
        form {
            border: 1px solid black;
            padding: 15px;
        }

        input[type=file] {
            padding-left: 15px;
        }

        button[type=submit] {
            font-weight: bold;
        }
    </style>
</head>
<body>

<form action="prepare_tom_dev.php" method="POST" enctype="multipart/form-data">

    <p><b>Подготовка файлов для импорта томов и разработчиков</b></p>

    <p>
        <label for="file">Файл с документами (excel)</label>
        <input type="file" name="file"/>
    </p>

    <button type="submit">Получить файлы импорта</button>

</form>

<form action="prepare_documents.php" method="POST" enctype="multipart/form-data">

    <p><b>Подготовка файла для импорта документов</b></p>

    <p>
        <label for="file">Файл с документами (excel)</label>
        <input type="file" name="file"/>
    </p>

    <p>
        <label for="file_toms">Файл с томами (xml)</label>
        <input type="file" name="file_toms"/>
    </p>

    <p>
        <label for="file_developers">Файл с разработчиками (xml)</label>
        <input type="file" name="file_developers"/>
    </p>

    <p>
        <label for="file_developers">Файл с типами документов (xml)</label>
        <input type="file" name="file_types"/>
    </p>

    <button type="submit">Получить файл импорта</button>

</form>

</body>
</html>