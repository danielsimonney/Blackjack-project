<?php
namespace controllers;

use \Models\Game;

class IndexController{

    private function getBoard(){
        $board = new Game();
       
        
        if(isset($_SESSION["game"])){
          $board=$board->EntireLoad();
        }
        
        return $board;
      }
      
      public function home(){
        
        $board = $this->getBoard();
        
        
        if($board->getStatus() == "initial"){
          header("Location:/?controller=play&action=Initialisation");
          exit(); 
        }
        if($board->getStatus()=="mise"){
          header("Location:/?controller=mise&action=Mise");
          exit(); 
        }
        if($board->getStatus()=="begin"){
          header("Location:/?controller=game&action=begin"); 
          exit(); 
        }

        if($board->getStatus()=="results"){
          header("Location:/?controller=result&action=results");
          exit();  
        }
        if($board->getStatus()=="croupierTurn"){
          header("Location:/?controller=game&action=croupierTurn");
          exit();  
        }
       
          
          
         
        
      }

    
}