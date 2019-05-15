<?php
namespace controllers;

use \Models\Game;

class GameController{
  
  
  private function getBoard(){
    $board = new Game;
    $board=$board->EntireLoad();
    
    
    
    return $board;
  }
  
  
  function begin(){
    $board = $this->getBoard();
    //  $board->reinit();
    $board->builDeck();
    if($board->getStatus()!="begin"){
      $board->redirect();
    }
    
    
    if($board->verifyNumberOfCardsOfCroupier()>1){
      
    }else{
      $board->dealCroupierCards();
      $board->dealCroupierCards();
    }
    
 
    if($board->verifyNumberOfCards()>1)
    {
      $board->VerirfyIfWin();
      $board->EntireSave($board);
      
    }else{
      $board->DealCard();
      $board->Dealcard();
      $board->VerirfyIfWin();  
    }  
    
    $board->EntireSave($board,true);
    include("../views/game.php");
  }
  
  function addCard(){
    $board = $this->getBoard();
    $board->DealCard();
    header("Location: /"); exit;
    
  }
  
  function changePlayer(){
    
    $board = $this->getBoard();
    
    $board->ChangeTurn();
    
    if($board->isTurnCroupier()==true){
      $board->SetStateTurnCroupier();
      $board->EntireSave($board);
      header("Location:/?controller=index&action=home");
      exit();
    }else{
      header("Location: /"); exit;
      
    }
  }
  
  function Goresult(){
    $board = $this->getBoard();
    $board->SetAlertResults();
    $board->stateResults();
    header("Location:/?controller=index&action=home");
  }
  
  function croupierTurn(){
    
    $board = $this->getBoard();
    
    //  $board->reinit();
    $sum=($board->GetSum());
    while($sum<17){
      $board->dealCroupierCards();
      $sum=($board->GetSum());
    }    
    $board->VerirfyIfWinCroupier();
   
    $board->EntireSave($board);
    include("../views/croupier.php");
    
  }
}  