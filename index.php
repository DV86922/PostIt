<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Post It!</title>
</head>
<body>
<div>
<?php
require_once "header_responsive.php";
?>

    <main>
        <div>
<!--        Taak toevoegen  -->
            <div>
                <a href="pages/taakToevoeg.php"><i class="fas fa-plus"> Taak toevoegen</i></a>
            </div>

<!--        Zoekbalk  -->

        </div>
<!--        Nog in te plannen taken  -->
        <div class="ITPTaken">
            <h3 id="demo">Nog in te plannen taken:</h3>
        </div>

<!--        Taken overzicht  -->
        <div class="takenOverzicht">
            <h3>Taken</h3>
        </div>
    </main>

    <footer>
    </footer>
</div>

<script>
</script>
</body>
</html>
