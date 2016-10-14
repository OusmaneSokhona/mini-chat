<html>

<head>
	<title>Mini-Chat</title>
	<meta charset="utf-8" />
</head>


<body>

	<h1>Chatroom</h1>
	<p>Bienvenue sur la page du Chatroom</p>
	<img src="image/index.php" />
	<!-Formulaire d'ajout qui redirige sur la meme page c'est une facon plus simple de le faire...->

	<form method="post" action="index.php">
		<label for="pseudo">Pseudo: </label>
		<input type="text" id='pseudo' name='pseudo' />
		<label for="message">Message: </label>
		<input type="text" id='message' name='message' />

		<input type='submit' id='envoyer' name='envoyer' />


	</form>

	<?php
	
						/*Connection a la Bdd*/
		$bdd=new PDO('mysql:host=localhost;dbname=test2;charset=utf8','root','',array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION));
		if (isset($_POST['message'] )AND isset($_POST['pseudo'])){
			
							/*Appli pré-préparer pour Inserer des Variable dans la Bdd*/
			$ajout=$bdd->prepare('INSERT INTO chat(datemodif,pseudo,message)VALUES(NOW(),:pseudo, :message)');
			
			$ajout->execute(array(
				'pseudo'=>$_POST['pseudo'],
				'message'=>$_POST['message']
			
			));
			
		}
	
			
						/*Affiche les 10 premiers message suivi du pseudo et de la date*/
			$affiche=$bdd->query('SELECT datemodif,pseudo,message FROM chat ORDER BY ID DESC LIMIT 0,10 ');
				while($donnees=$affiche->fetch()){
					echo '</br>[',$donnees['datemodif'],']<strong> ',$donnees['pseudo'],'</strong> a tapé: ' ,$donnees['message'],'</br>';
			
			}
		?>
		<?php
	$mot="j aime jouer de la guitare ";
	if(preg_match("#guitare#",$mot)){
		echo 'Vrai';
	}
	else{
		echo 'Faux';
	};
	?>

</body>

</html>