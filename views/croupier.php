<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="play.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
  <div class="container">

  
  <div class="containcroupier"> 

  
  <h1>C'est au tour du <?php echo ($board->getPlayerWhoPlay()->getname()) ?> </h1>
<div class="explication">C'est maintenant au tour du croupier ,son système de fonctionnement est très simple, en plus de ses 2 
    cartes du début il pioche autant de cartes que nécessaires pour avoir au moins 17 points . A plus de 21 points , il a perdu comme les autre 
    joueurs .
  </div>

<div class="croupierBoard">
<div class="croupierCards">
  <?php $numItems = count($board->writeTheCards()); ?>
  <?php $i=0; ?>
  <?php echo ($board->getPlayerWhoPlay()->getname()); ?> a 
  <?php foreach($board->writeTheCards() as $value): ?>
 <?php if(++$i === $numItems): ?>
 <?php echo $value."." ?>
<?php else: ?>
  <?php echo $value." et"; ?>
  <?php endif ?>
  <?php endforeach ?>
  Cela lui fait donc <?php echo $board->getSum()." points" ?>
  </div>
  <?php $board->showImg() ?>
</div>
</div>
<form method="post" action="/?controller=game&action=Goresult">
<div class="submitCroupier">
<button type="submit" class="btn btn-warning"> Passer aux résultats !! </button></div>
</div>
</form>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script src="index.js"></script>
</body>
</html>
