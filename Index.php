<?php

require_once 'app/init.php';

$elementsQuery = $db->prepare("SELECT id, name, done FROM elements WHERE user = :user");

$elementsQuery->execute(['user' => $_SESSION['user_id']]);

$elements = $elementsQuery->rowCount() ? $elementsQuery : [];




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>To do</title>

    <link href="https://fonts.googleapis.com/css2?family=Fruktur&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,700;1,300&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/main.css">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
</head>

<body>
    <div class="list">
        <center>
            <h1 class="header">A faire aujourd'hui.</h1>
        </center>
        <?php if (!empty($elements)) : ?>

            <ul class="elements">
                <?php foreach ($elements as $element) : ?>
                    <li>
                        <span class="element<?php echo $element['done'] ? ' done' : '' ?>">
                            <?php echo $element['name']; ?>
                        </span>
                        <?php if (!$element['done']) : ?>
                            <a href="done.php?as=done&element=<?php echo $element['id']; ?>" class="button-done">Tâche terminée</a>
                        <?php endif; ?>
                        <?php if ($element['done']) : ?>
                            <a href="done.php?as=notdone&element=<?php echo $element['id']; ?>" class="button-done">Tâche non terminée</a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Vous n'avez ajouté aucun élément</p>
        <?php endif; ?>
        <form class="element-add" action="add.php" method="post">
            <input type="text" name="name" placeholder="Entrez une nouvelle tâche ici" class="input" autocomplete="off" required>
            <input type="submit" value="Ajouter" class="submit">
        </form>

    </div>
</body>

</html>