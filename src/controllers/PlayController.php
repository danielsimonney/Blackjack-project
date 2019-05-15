<?php

namespace Controllers;
use \Models\Game;
class PlayController{


  private function getBoard(){
    $board = new Game();
   
    
    if(isset($_SESSION["game"])){
      $board=$board->EntireLoad();
    }
    
    return $board;
  }

  function Initialisation(){
    $board = $this->getBoard();
    if($board->getStatus()!="initial"){
        $board->redirect();
      }
      include("../views/initial.php");
  }

  function new_player(){
      $board = $this->getBoard();
      $player=htmlspecialchars($_POST["player_name"]);

      $board->addPlayer($player);
      
      $board->EntireSave($board);
      header("Location: /"); exit;  
  }

  function supress_player(){
   
    $board = $this->getBoard();

    if($board->suppress($_POST["supress"])){

    }else{

    }
    $board->EntireSave($board);
    header("Location: /"); exit;
  }


  function begin(){
    $board = $this->getBoard();
    if($board->verify()){
      $board->startBet();
    
      $board->gameBegin();
      $board->arrayreinit();
      $board->EntireSave($board);
    header("Location:/?controller=index&action=home"); 
    exit();
    }else{
      $board->GameCantBegin();
      $board->EntireSave($board);
      header("Location: /"); exit;
    }    
  }
}