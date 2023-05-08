<?php
use SHIFOUMI\controllers\MainController;

require_once('./controllers/MainController.php');

$ctrl = new MainController();

if (isset($_GET['action'])) { {
        $ctrl->playing();
    }

} else {
    $ctrl->index();
    if (isset($_POST['score']) && isset($_POST['bestScore'])){
        $ctrl->setBestScore($_POST['score'],$_POST['bestScore']);
    }
    if(isset($_POST['delete']) && $_POST['delete'] === 'bestScore'){
        $ctrl->resetBest();
    }
}
