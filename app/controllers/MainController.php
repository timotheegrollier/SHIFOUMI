<?php

namespace SHIFOUMI\controllers;





class MainController
{

    protected array $choices;
    protected string $computer;
    protected bool $win;
    protected bool $loose;
    protected bool $equal;
    

   

    public function __construct(array $choices = ['STONE', 'PAPER', 'SCISSOR'], string $computer = "", $win = 0, $loose = 0,$equal = 0)
    {
        $this->choices = $choices;
        $this->computer = $computer;
        $this->win = $win;
        $this->loose = $loose;
        $this->equal = $equal;
        // $this->bdd = $bdd;
    }

    public function resetBest(){
        include './config/Database.php';
        $req = $pdo->prepare('UPDATE score SET score = :score WHERE id = :id');
    
        $req->execute(array(
               'score' => 0,
               'id' => 1
               ));

    }


    public function getBestScore(){
        include './config/Database.php';
        $data = $pdo->query('SELECT * FROM score')->fetch();
        return $data;
    }

    public function setBestScore($score,$bestScore){
        if($score > $bestScore){
            include './config/Database.php';
            $req = $pdo->prepare('UPDATE score SET score = :score WHERE id = :id');
    
            $req->execute(array(
                   'score' => $score,
                   'id' => 1
                   ));
    
        }
    }

    public function setComputer($computer)
    {
        $this->computer = $computer;
    }

    public function getComputer()
    {
        return $this->computer;
    }


    public function getWin()
    {
        return $this->win;
    }

    public function setWin($win)
    {
        $this->win = $win;
    }
    public function getLoose()
    {
        return $this->win;
    }

    public function setLoose($loose)
    {
        $this->loose = $loose;
    }

    function index()
    {
        
        $score = $this->getBestScore()['score'];
        require_once("./view/home.php");
    }

    public function stone()
    {
        if ($this->getComputer() === "SCISSOR")
            return true;
        elseif ($this->getComputer() === "STONE")
            $this->setLoose(false);
        else
            $this->setLoose(true);
        return false;
    }

    public function paper()
    {
        if ($this->getComputer() === "STONE")
            return true;
        elseif ($this->getComputer() === "PAPER"){
            $this->setLoose(false);
            $this->equal = true;
        }
        else
            $this->setLoose(true);
        return false;
    }

    public function scissor()
    {
        if ($this->getComputer() === "PAPER")
            return true;
            elseif ($this->getComputer() === "SCISSOR"){
                $this->setLoose(false);
                $this->equal = true;
            }
        else
            $this->setLoose(true);
            return false;
    }

    function playing()
    {
        $rand = random_int(0, 2);
        $computer = $this->choices[$rand];
        $this->setComputer($computer);
        if ($_GET['action'] === "stone") {
            $win =  $this->stone();
            $this->loose ? $loose = true : $loose = false;
        }
        if ($_GET['action'] === "paper") {
            $win =  $this->paper();
            $this->loose ? $loose = true : $loose = false;
        }
        if ($_GET['action'] === "scissor") {
            $win =  $this->scissor();
            $this->loose ? $loose = true : $loose = false;
        }
        $res = [$computer, $win, $loose,$this->equal];
        echo json_encode($res);
    }


}
