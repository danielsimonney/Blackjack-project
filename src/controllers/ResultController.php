<?php
namespace controllers;

use \Models\Game;

class ResultController{
    private function getBoard(){
        $board = new Game;
        $board=$board->EntireLoad();
        
        
        
        return $board;
      }

      function results(){
    
        $board = $this->getBoard();
        $board->stateResults();
        $board->verifyHowWin();
        if($board->isBetSet()==false){
          foreach($board->getPlayers() as $player){
            if($player->getname()!="croupier"){
              $player->resolveBet();
              $board->Miseresolved();
            }
          }
        }
        $board->EntireSave($board);
        include("../views/results.php");
    }


    function reinit(){
        $board = $this->getBoard();
        $board->replay();
        $board->Entiresave($board);
        header("Location:/?controller=index&action=home");
        
      }
      function reinitialise(){
        $board = $this->getBoard();
        
        $board->reinit();
        header("Location:/?controller=index&action=home");
      }
}
