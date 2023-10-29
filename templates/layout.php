<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Notebook</title>
</head>
<body>
    <div class="header">
        <h1>Moje notatki</h1>
    </div>

    <div class="container">
        <div class="menu">
            <ul>
                <li><a href="/">Lista notatek</a></li>
                <li><a href="/?action=create">Nowa notatka</a></li>
            </ul>
        </div>

        <div>
            <?php
                // if($page === "create"){
                //     include_once "./templates/pages/create.php";
                // } else {
                //     include_once "./templates/pages/list.php";
                // }
                require_once "./templates/pages/$page.php";
            ?>
        </div>
    </div>
</body>
</html>