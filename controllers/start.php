<?php
require_once("../models/Game.php");

$gameOver = 0;


if (isset($_GET['again'])) {

}
session_start();
if (!isset($_GET['Miser']) && !isset($_GET['Finish'])) {
    $userHand[0] = $game->dealCard();
    $dealerHand[0] = $game->dealCard();
    $userHand[1] = $game->dealCard();
    $dealerHand[1] = $game->dealCard();
    $_SESSION['userHand'] = $userHand;
    $_SESSION['dealerHand'] = $dealerHand;
	$_SESSION['dHandValue'] = $game->getHandValue($_SESSION['dealerHand']);
} else if (isset($_GET['Miser'])) {
    $_SESSION['userHand'][sizeof($_SESSION['userHand'])] = $game->dealCard();
    $_SESSION['userValue'] = $game->getHandValue($_SESSION['userHand']);
	$_SESSION['dHandValue'] = $game->getHandValue($_SESSION['dealerHand']);
	$_SESSION['uHandValue'] = $game->getHandValue($_SESSION['userHand']);
    if ($_SESSION['userValue'] == 21)
		header("Location: index.php?Finish=Finish");
	$gameOver = $game->winCheck($_SESSION['userValue'], $_SESSION['dHandValue'], 0);
} else if (isset($_GET['Finish'])) {
    while ($_SESSION['dHandValue'] < 17) {
        $_SESSION['dealerHand'][sizeof($_SESSION['dealerHand'])] = $game->dealCard();
        $_SESSION['dHandValue'] = $game->getHandValue($_SESSION['dealerHand']);
		$_SESSION['uHandValue'] = $game->getHandValue($_SESSION['userHand']);		
    }
	$gameOver = $game->winCheck($_SESSION['uHandValue'], $_SESSION['dHandValue'], 1);
}

?>