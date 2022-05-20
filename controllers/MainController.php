<?php

namespace SHIFOUMI\controllers;

class MainController
{

    protected array $choices;
    protected string $computer;
    protected bool $win;

    public function __construct(array $choices = ['STONE', 'PAPER', 'SCISSOR'], string $computer = "", $win = 0)
    {
        $this->choices = $choices;
        $this->computer = $computer;
        $this->win = $win;
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

    function index()
    {
        require_once("./view/home.php");
    }

    public function stone()
    {
        if ($this->getComputer() === "SCISSOR")
            return true;
        else
        return false;
    }

    public function paper(){
        if ($this->getComputer() === "STONE")
        return true;
        else
        return false;
    }

    public function scissor(){
        if ($this->getComputer() === "PAPER")
        return true;
        else
        return false;
    }

    function playing()
    {
        $rand = random_int(0, 2);
        $computer = $this->choices[$rand];
        $this->setComputer($computer);
        if($_GET['action'] === "stone"){
            $win =  $this->stone();
        }
        if($_GET['action'] === "paper"){
            $win =  $this->paper();
        }
        if($_GET['action'] === "scissor"){
            $win =  $this->scissor();
        }
        $res = [$computer,$win];
        echo json_encode($res);
    }
}
