<?php


class Game
{
	public $DECK = array();
	public $DEALER = array();
	public $PLAYER = array();
	public $cards = array("A","2","3","4","5","6","7","8","9","10","Valet","Dame","Roi");
	public $suits = array('A','B','C','D');
	
	public function Game()
	{
		$this->createDeck();
		for ($t = 0; $t <= 3; $t++)
		{
			shuffle($this->DECK);
		}
	}
	
	public function createDeck()
	{
		for ($i = 0; $i < 13; $i++)
		{
			for($x = 0; $x < 4; $x++)
			{
				array_push($this->DECK,$this->cards[$i].$this->suits[$x]);
			}
		}
	}
	
	public function dealDealer()
	{
		return array_pop($this->DECK).",".array_pop($this->DECK);
	}
	
	public function dealPlayer()
	{
		return array_pop($this->DECK).",".array_pop($this->DECK);
	}
	
	public function dealCard()
	{
		return array_pop($this->DECK);
	}
	
	public function translateCard($card)
	{
		$face = substr($card,0,-1);
		$suit = substr($card,-1,1);
		switch($suit)
		{
			case 'A':
				return $face;
			case 'B':
				return $face;
			case 'C':
				return $face;
			case 'D':
				return $face;
		}
	}
	
	public function getHandValue($cards)
	{
		$value = 0;
		foreach ($cards as &$values)
		{
			$value += $this->getCardValue($values);
		}
		return $value;
	}
	
	public function getCardValue($card)
	{
		$face = substr($card,0,-1);
		$suit = substr($card,-1,1);
		$num_pattern = '/[0-9]/';
		$face_pattern = '/[ValetDameRoi]/';
		if (preg_match($num_pattern,$face))
		{
			return $face;
		}
		else if (preg_match($face_pattern,$face))
		{
			return 10;
		}
		else if ($Joueur < 11 || $Croupier < 11)
		{
			return 11;
		}

		else if ($Joueur >= 11 || $Croupier >= 11)
		{
			return 1;
		}


		echo "Face: ".$face."<br />Suit: ".$suit."<br />";
	}
	
    public function winCheck($Joueur, $Croupier, $stand){
		$base_total=100;
		$multiplication_2 = 2;
		$plus_total=$base_total*2;
		$none_total=$base_total-$base_total;
        if($Joueur > 21){
			echo "<div class='lost'>Tu as perdu!<br/>Pourquoi: Ton nombre est supérieur à 21</div>";
			echo "<div class='lost'>Ton argent actuel: ".$none_total."$</div>";
			return 1;

        }
        else if ($Croupier > 21){
            
			echo "<div class='win'>Tu as gagné!<br/> Pourquoi: Le croupier à dépasser le nombre 21</div>";
			echo "<div class='win'>Ton argent actuel: ". $base_total * $multiplication_2 ."$</div>" ;
            return 1;
        }
        else if ($stand == 1){
            if($Joueur > $Croupier){
                
                echo "<div class='win'>Tu as gagné! <br/> Pourquoi: Ton nombre total est supérieur à celui du croupier</div>";
				echo "<div class='win'>Ton argent actuel: ". $base_total * $multiplication_2 ."$</div>" ;
				return 1;
            }
            else{
                echo "<div class='lost'>Tu as perdu! <br/>Pourquoi: le nombre total du croupier est supérieur au tiens</div>";
				echo "<div class='lost'>Ton argent actuel: ".$none_total."$</div>";
				return 1;
            }
		}
		
		elseif ($Croupier > 21 && $Joueur > 21) {
			echo "<div class='lost'>Vous avez tous les deux perdus</div>";
			echo "<div class='lost'>Ton argent actuel: ".$none_total."$</div>";
			return 1;
		}
    }
}



$game = new Game();
?>