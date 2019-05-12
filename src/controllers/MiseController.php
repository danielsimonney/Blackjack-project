<?php

namespace Controllers;
use \Models\Game;
class MiseController{ 
    private function getBoard(){
        $board = new Game();
       
        
        if(isset($_SESSION["game"])){
          $board=$board->EntireLoad();
        }
        
        return $board;
      }


public function Mise(){

    $board = $this->getBoard();
    if($board->getStatus()!="mise"){
        $board->redirect();
      }
    include("../views/mise.php");
}

public function beginGame(){
    $board = $this->getBoard();
    $BetsArray=[];
    
    for ($i = 1; $i <= $board->NumberofPlayers(); $i++) {
        $perso=($_POST["bet$i"]);
        array_push($BetsArray,$perso);
    }
    var_dump($BetsArray);
    $i=0;
    $test=true;
   foreach ($BetsArray as $key => $value) {
       if($board->verifyBet($value,$i)==false){
$test=false;
       }
      $i+=1;
   }
   if($test==true){
       var_dump("victoire");
       $board->EntireSave($board);
       $board->startGame();
       $board->addcroupier();
       header("Location:/?controller=game&action=begin"); 
   }else{
    $board->SetAlertBetNotGood();
    header("Location: /"); exit;
    
   }
   


    
}




}