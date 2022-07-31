<?php $title = 'home'; ?>

<?php ob_start(); ?>


<div id="home">
    <h3 id="score"></h3>
    <div id="computer-choice">
        <img id="computer-stone" src="./public/assets/img/a-stone-meteorite-isolated-on-white-background-free-vector-removebg-preview.png"></img>
        <img id="computer-paper" src="./public/assets/img/Mirella-Gabriele-Fantasy-Mediaeval-Paper (1).png"></img>
        <img id="computer-scissor" src="./public/assets/img/scissor-icon-design-illustration-free-vector-removebg-preview.png"></img>
    </div>
    <div id="player-choice">
        <img class="choices" id="stone" src="./public/assets/img/a-stone-meteorite-isolated-on-white-background-free-vector-removebg-preview.png" alt="STONE">
        <img class="choices" id="paper" src="./public/assets/img/Mirella-Gabriele-Fantasy-Mediaeval-Paper (1).png" alt="PAPER">
        <img class="choices" id="scissor" src="./public/assets/img/scissor-icon-design-illustration-free-vector-removebg-preview.png" alt="SCISSOR">
    </div>
</div>





<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>