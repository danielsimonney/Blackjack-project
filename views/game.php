
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="play.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>
<?php $board->getMyAlert() ?>
<div class="contain">
  <div class="col-lg-12">
  <h1>C'est au tour de <?php echo ($board->getPlayerWhoPlay()->getname()) ?> </h1>
  </div>
<div class="player col-lg-5">
  
  <div class="cards">
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
  </div>
  <div>
    Cela lui fait donc <?php echo $board->getSum()." points" ?>
  </div>
  <div class="images">
      <?php $board->showImg() ?>
  </div>
</div>
  <div class="croupier col-lg-5">
    <div class="croupiercontent">
  Et le croupier a <?php echo $board->firstcardName() ?> 
  <div>
  Ainsi qu'une une autre carte face cachée .
  </div>
    </div>
  
  <div class="images">
  <?php $board->showFirstImg(); ?>
  </div>
  </div>
<div class="submit col-lg-5">

<form method="post" action="/?controller=game&action=addCard">

<button type="submit" class="btn btn-outline-light add"> Ajouter une carte </button>
</form>

<form method="post" action="/?controller=game&action=changePlayer">

<button type="submit" class="btn btn-outline-primary"> s'arrêter la </button>
</form>
</div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script src="index.js"></script>
</body>
</html>




