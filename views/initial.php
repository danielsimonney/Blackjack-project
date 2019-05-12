<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="theme.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <title>Document</title>
</head>

<style>
    body{
        color:rgba(223, 112, 68, 0.836);
       }
        
        
        .setting{
            text-align: center;
            margin-top: 25%;
        }



</style>
<body>

    <div class="container">
        <div class="initialContent">
    <h1 class="title">Bienvenue dans mon jeu de  blackjack</h1>
    <div class="ruleblock">
    <p class=" rules">Pour commencer  voici un petit rappel des règles :</p>
    <div class="col-lg-12">
        <blockquote class="blockquote text-center ">
        Une partie de Blackjack se joue entre la banque et les autres joueurs. 
        Pour chaque joueur, le but est d’obtenir un total de points supérieur à celui du croupier sans jamais dépasser 21. 
        Dès qu'un joueur dépasse 21, il perd sa mise initiale. 
        Contrairement à la plupart des autres jeux de casino, le blackjack donne au joueur la possibilité d’influer sur le cours de la partie. 
        En effet, le joueur peut utiliser certaines options mais également varier son jeu ainsi que ses mises.
        Dans ce jeu de blackjack vous pourrez jouer entre 1 à 4 joueurs contre le croupier et vous pourrez miser entre 10 et 100 € par partie
        avec seuleument des dizaines .
        </blockquote>
    </div>
    </div>
<?php if(count($board->getPlayers())):?>
  <h3>Liste des joueurs</h3>
  <div class="containList">
  <ul class="list-group list-group-flush">
    <?php foreach($board->getPlayers() as $player):?>
      <li class="list-group-item">
      <form method="post" action="/?controller=play&action=supress_player">
        <span class="player"><?php echo $player->name; ?></span> <input type="hidden" name="supress" value="<?php echo $player->name; ?>">
         <button type="submit" class="btn btn-outline-danger">suppress player❌</button>
         </form>
        
      </li>
  
    <?php endforeach;?>
  </ul>
  </div>
<?php else:?>
  <h1>Pas encore de joueurs inscrits</h1>

<?php endif;?>

<h3 class="title">Ajouter un joueur</h3>

<form method="post" action="/?controller=play&action=new_player">
  <input type="text" name="player_name" class="form-control">
  
  <button type="submit" class="btn btn-primary ">Ajouter</button>

</form>
<?php if(count($board->getPlayers())):?>
<h3 class="title">Prêt ????</h3>
<form method="post" action="/?controller=play&action=begin">

<button class="btn btn-outline-success btn-lg btn-block" type="submit"> Commencer la partie ! </button>
</form>
<?php endif;?>     
 
    </div>
<?php $board->getMyAlert() ?>
</div>
    </div>

   
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="index.js"></script>

</body>

</html>