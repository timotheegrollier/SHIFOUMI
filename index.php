<?php
require('./controllers/MainController.php');

use SHIFOUMI\controllers\MainController;

$ctrl = new MainController;

if (isset($_GET['action'])) { {
        $ctrl->playing();
    }
} else {
    $ctrl->index();
}
