<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="mise.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <title>Document</title>
</head>
<body>
  <div class="container">
    <div class="containAll">
      <h1 class="title">Mise en place des mises</h1>
      <p class="explication">
  C'est le moment de mettre votre mise , ici chaque joueur choisit combien il va miser pour un maximum de 100€, <b>attention</b> tout de même car chaque joueur ne peut pas
miser plus que ce qu'il a et chaque joueur doit miser au moins 10€      </p>
  <h3>Liste des joueurs</h3>
  <ul class="list-group">
      <?php $i="1" ?>
      
      <form method="post" action="/?controller=mise&action=beginGame" id="betForm">
    <?php foreach($board->getPlayers() as $player):?>
    
      <li class="list-group-item">
      
        <?php echo $player->name; ?> dispose de <?php echo $player->ArgentJoueur ?>€ et son choix de mise <label for="bet<?php echo $i; ?>">s'effectue dans l'input situé juste ici</label><br><input type="hidden" name="idPerso<?php echo $i; ?>" value=" <?php echo $i; ?>">
        <div class="select">
        <select name="bet<?php echo $i; ?>" form="betForm" class="custom-select" id="bet<?php echo $i; ?>">
        <option value="0">0</option>
  <option value="10">10</option>
  <option value="20">20</option>
  <option value="30">30</option>
  <option value="40">40</option>
  <option value="50">50</option>
  <option value="60">60</option>
  <option value="70">70</option>
  <option value="80">80</option>
  <option value="90">90</option>
  <option value="100">100</option>

</select>
    
         
        
      </li>
    
      <?php $i=$i+1 ?>
    <?php endforeach;?>
   </ul>
    <button type="submit" class="btn btn-outline-success bouton">Lancer la partie ✅</button>
         </form> 
      </div>
        
      </div>
      </div>
 
  </div>
  <?php $board->getMyAlert() ?>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="index.js"></script>
</body>
</html>

