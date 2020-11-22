<?php

require_once 'app/init.php';

if (isset($_GET['as'], $_GET['element'])) {
    $as = $_GET['as'];
    $element = $_GET['element'];

    switch ($as) {
        case 'done':
            $doneQuery = $db->prepare("UPDATE elements SET done = 1 WHERE id = :element AND user = :user");

            $doneQuery->execute([
                'element' => $element,
                'user' => $_SESSION['user_id']
            ]);
            break;
        case 'notdone':
            $doneQuery = $db->prepare("UPDATE elements SET done = 0 WHERE id = :element AND user = :user");

            $doneQuery->execute([
                'element' => $element,
                'user' => $_SESSION['user_id']
            ]);
            break;
    }
}

header('Location:index.php');
die();
