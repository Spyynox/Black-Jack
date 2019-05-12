<?php

    require_once('../controllers/start.php');
    require_once('../models/Game.php');
    require_once('style.php')
?>


<html>
<head>
</head>
<body>
    <h2>Blackjack de Maxime Mbiya Kiaku</h2>
    <div>Ton argent de départ: 100</div>
    <div class="jumbotron">
        <div class='status_cards'>Tes deux cartes sont:</div><br/>
    <?php 
	for ($i = 0; $i < sizeof($_SESSION['userHand']); $i++) {
        echo $game->translateCard($_SESSION['userHand'][$i]) . "<br />";
    }

    echo "<div class='status_cards'><br /><br /> Les cartes de ton adversaire est: </div><br />";
	if ($gameOver == 0)
	{
		for ($j = 1; $j < sizeof($_SESSION['dealerHand']); $j++) {
			echo $game->translateCard($_SESSION['dealerHand'][$j]) . "<br />";
		}
	}
	else
	{
		for ($j = 0; $j < sizeof($_SESSION['dealerHand']); $j++) {
			echo $game->translateCard($_SESSION['dealerHand'][$j]) . "<br />";
		}
	}
	
	echo "<br /><br />";
    /**game is not over; reload screen like normal**/
    if ($gameOver == 0){
        echo '<form action=\'index.php\' method=\'get\'>
                      <input class=\'btn btn-success\' type=\'submit\' name=\'Miser\' value=\'Miser encore\'/><br />
                      <input class=\'btn btn-danger\' type=\'submit\' name=\'Finish\' value=\'Arrêter de miser\'/></form>';
    } /**Victory conditions are met; print final screen**/
    else{

      echo 'Ton score final est de: ' . $_SESSION['uHandValue'] . '<br /> Le score final du croupier est de: '.$_SESSION['dHandValue'].'
            <form action=\'index.php\' method=\'get\'>
            <input class=\'btn btn-primary\' type=\'submit\' name=\'again\' value=\'Recommencer\'/></form>';
    } ?>
</div>
</body>
</html>


