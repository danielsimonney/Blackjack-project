


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="result.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Document</title>

<style>




  </style>
</head>
<body>
<div class="container">
  <div class="title">
    <h1>C'est maintenant le moment d'afficher les résultats.</h1>
  </div>
<?php foreach($board->getPlayers() as $player):?>
<?php if($player->getname()!="croupier"): ?>
<div class="playerResolve col-lg-12">
  <?php echo $player->result()." " ?>
  <?php echo $player->printBet() ?>
</div>


<?php endif ?>
<?php endforeach;?>


<div class="mysubmit">

<form method="post" action="/?controller=result&action=reinit">
<div class="quest">Que voulez vous faire maintenant ??</div>
<button type="submit" class="btn btn-primary btn-lg"> recommencer ? </button>
</form>

<form method="post" action="/?controller=result&action=reinitialise">

<button type="submit" class="btn btn-outline-dark btn-lg"> Tout réinitialiser ? </button>

</form>
</div>
</div>
<?php $board->getMyAlert() ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script src="index.js"></script>
</body>