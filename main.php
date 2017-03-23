<?php
session_start();

#unset($_SESSION['tableShip']);

require_once 'Classes/Ship.php';
require_once 'Classes/Table.php';

$messageError = "Scegli una nave!";
$gameState;
$lettere = Array("A","B","C","D","E","F","G","H","I","L");

if (isset($_SESSION['tableShip'])) {
	$tableShip = unserialize($_SESSION['tableShip']);
} else {
	$tableShip = new Table();
}

$_SESSION['gameState'] = $tableShip->getGameState();

if (isset($_POST['x']) && isset($_POST['y'])) {
	$_SESSION['x'] = $_POST['x'];
	$_SESSION['y'] = $_POST['y'];
}

if (isset($_POST['CPUx']) && isset($_POST['CPUy'])) {
	$tableShip->userShoot($_POST['CPUx'], $_POST['CPUy']);
}

// STEP 2
if (isset($_POST['type'])) {
	$_SESSION['type'] = $_POST['type'];
}

// STEP 3
if (isset($_POST['direction'])) {
	$_SESSION['direction'] = $_POST['direction'];
}

if (isset($_SESSION['x']) && isset($_SESSION['y']) && isset($_SESSION['direction']) && isset($_SESSION['type']) && isset($_SESSION['gameState'])) {

	$x = $_SESSION['x'];
	$y = $_SESSION['y'];

	$position = Array($x, $y);
	$direction = $_SESSION['direction'];
	$type = $_SESSION['type'];

	$gameState = $_SESSION['gameState'];

	$tableShip->putShip($type, $direction, $position);

	$_SESSION['x'] = null;
	$_SESSION['y'] = null;
	$_SESSION['type'] = null;
	$_SESSION['direction'] = null;
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="CSS/main.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body class="body">
        <div class="game_tables">
            <div>
                <?php
                echo '<table border="1" class="table_ship_hit">';
                for ($y = 0; $y < 11; $y++) {
                    echo '<tr class="td">';
                    for ($x = 0; $x < 11; $x++) {
                        if($x == 0 && $y == 0){
                            echo '<td class="cell" width="30px"></td>';
                        }
                        else if($y == 0) {
                            echo '<td class="cell" width="30px">'.$lettere[$x -1].'</td>';
                        }
                        else if($x == 0) {
                            echo '<td class="cell" width="30px">'.$y.'</td>';
                        }
                        else {
                            echo '<td class="cell">';
                            echo '<form method="POST" action="main.php">';
                            echo '<input type="hidden" name="x" value="'.($x-1).'">';
                            echo '<input type="hidden" name="y" value="'.($y-1).'">';
                            echo '<input type="submit" class="buttShip" style="background-color:'.$tableShip->getTable($x-1,$y-1).'" value=""></input>';
                            echo'</form>';
                            echo '</td>';
                        }
                    }
                    echo '</tr>';
                }
                echo '</table>';
                ?>
            </div>
            <div>
                <?php
                echo '<table border="1" class="table_ship">';
                for ($y = 0; $y < 11; $y++) {
                	echo '<tr class="td">';
                	for ($x = 0; $x < 11; $x++) {
                		if($x == 0 && $y == 0){
                			echo '<td class="cell" width="30px"></td>';
                		}
                		else if($y == 0) {
                			echo '<td class="cell" width="30px">'.$lettere[$x -1].'</td>';
                		}
                		else if($x == 0) {
                			echo '<td class="cell" width="30px">'.$y.'</td>';
                		}
                		else {
                			echo '<td class="cell">';
                			echo '<form method="POST" action="main.php">';
                			echo '<input type="hidden" name="CPUx" value="'.($x-1).'">';
                			echo '<input type="hidden" name="CPUy" value="'.($y-1).'">';
											$color = $tableShip->getTableCPUUser($x-1, $y-1);
											if($_SESSION['gameState'] == 1){
												echo '<input type="submit" class="buttShip" style="background-color:'.$color.'" value=""></input>';
											} else {
												echo '<input class="buttShip" style="background-color:'.$color.'" value=""></input>';
											}
                			echo'</form>';
                			echo '</td>';
                		}
                	}
                	echo '</tr>';
                }
                echo '</table>';
                ?>
            </div>
        </div>
        <div class="info_ship">
					<?php
					if($_SESSION['gameState'] == 0){
						echo '<div class="info_ship_title">Game info</div>';
						echo '<div class="info_ship_content">';
						echo '	<form method="POST" action="main.php">';
						echo '		<button class="type" name="type" value="2" style="background: url(image/ship2.png); background-repeat: no-repeat; width:300px; height: 60px;"></button>';
						echo '	</form>';
						echo '	<form method="POST" action="main.php">';
						echo '	 	<button class="type" name="type" value="3" style="background: url(image/ship3.png); background-repeat: no-repeat; width:300px; height: 60px;"></button>';
						echo '	 </form>';
						echo '	<form method="POST" action="main.php">';
						echo '  	<button class="type" name="type" value="4" style="background: url(image/ship4.png); background-repeat: no-repeat; width:300px; height: 60px;"></button>';
						echo '	 </form>';
						echo '	<form method="POST" action="main.php">';
						echo '		<button class="type" name="type" value="5" style="background: url(image/ship5.png); background-repeat: no-repeat; width:300px; height: 60px;"></button>';
						echo '	 </form>';
						echo '</div>';
						echo '<div class="ship_direction">';
						echo '	<form method="POST" action="main.php">';
						echo '		<button class="direction" name="direction" value="up"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>';
						echo '	 </form>';
						echo '	<form method="POST" action="main.php">';
						echo '		<button class="direction" name="direction" value="left"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>';
						echo '  </form>';
						echo '	<form method="POST" action="main.php">';
						echo '		<button class="direction" name="direction" value="right"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>';
						echo '	 </form>';
						echo '	<form method="POST" action="main.php">';
						echo '		<button class="direction" name="direction" value="down"><i class="fa fa-arrow-down" aria-hidden="true"></i></button>';
						echo '	 </form>';
						echo '</div>';
						echo 'Per inserire una type seleziona il tipo e la direction. In seguito clicca sulla cella da cui far partire la type';
						echo 'errore: '.$messageError;
					} else {
						echo '<div class="info_ship_title">Game start</div>';
					}
					 ?>
    	</div>
    </body>
</html>

<?php 	$_SESSION['tableShip'] = serialize($tableShip); ?>
