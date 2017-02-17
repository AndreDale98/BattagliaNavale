<?php
session_start();

require_once 'Classes/Ship.php';
require_once 'Classes/Table.php';

$messageError = "Scegli una nave!";

if (isset($_SESSION['tableShip'])) {
	$tableShip = unserialize($_SESSION['tableShip']);
} else {
	$tableShip = new Table();
	$tableShip->initializeTable();
}

if (isset($_POST['x']) && isset($_POST['y'])) {
	$_SESSION['x'] = $_POST['x'];
	$_SESSION['y'] = $_POST['y'];
}

// STEP 2
if (isset($_POST['type'])) {
	$_SESSION['type'] = $_POST['type'];
}

// STEP 3
if (isset($_POST['direction'])) {
	$_SESSION['direction'] = $_POST['direction'];
}

if (isset($_SESSION['x']) && isset($_SESSION['y']) && isset($_SESSION['direction']) && isset($_SESSION['type'])) {
	
	$x = $_SESSION['x'];
	$y = $_SESSION['y'];
	$position = Array($x, $y);
	$direction = $_SESSION['direction'];
	$type = $_SESSION['type'];
	
	$ship = new Ship($type, $direction, $position);
	$messageError = $tableShip->putShip($type, $direction, $position);

	$_SESSION['x'] = null;
	$_SESSION['y'] = null;
	$_SESSION['type'] = null;
	$_SESSION['direction'] = null;

	$_SESSION['tableShip'] = serialize($tableShip);
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="main.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body class="body">
        <div class="game_tables">
            <div>
                <?php
                
                $lettere = Array("A","B","C","D","E","F","G","H","I","L");
                
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
                            echo '<input type="submit" class="buttShip" value="'.$tableShip->getTable($x-1,$y-1).'"></input>';
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
                			echo '<input type="hidden" name="x" value="'.($x-1).'">';
                			echo '<input type="hidden" name="y" value="'.($y-1).'">';
                			echo '<input type="submit" class="buttShip" value="'.$tableShip->getTable($x-1,$y-1).'"></input>';
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
            <div class="info_ship_title">Game info</div>
	        <div class="info_ship_content">
<!-- 	            <a href="?type=2">3 - Navi ||</a><p> -->
<!-- 	            <a href="?type=3">2 - Navi |||</a><p> -->
<!-- 	            <a href="?type=4">2 - Navi ||||</a><p> -->
<!-- 	            <a href="?type=5">1 - Navi |||||</a><p>  -->
	            <form method="POST" action="main.php">
	            	<button class="type" name="type" value="2" style="background: url(image/ship2.png); width:400px; height: 55px;"></button>
	            </form>
	            <form method="POST" action="main.php">
	    	        <button class="type" name="type" value="3" style="background: url(image/ship3.png); width:400px; height: 55px;"></button>
	            </form>
	            <form method="POST" action="main.php">
	            	<button class="type" name="type" value="4" style="background: url(image/ship4.png); width:400px; height: 55px;"></button>
	            </form>
	            <form method="POST" action="main.php">
	         	   <button class="type" name="type" value="5" style="background: url(image/ship5.png); width:400px; height: 55px;"></button>
	   	        </form>
   	        </div>
   	        
            <div class="ship_direction">
	            <form method="POST" action="main.php">
            		<button class="direction" name="direction" value="up"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
            	</form>
                <form method="POST" action="main.php">
              		<button class="direction" name="direction" value="left"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
              	</form>
              	<form method="POST" action="main.php">
             		<button class="direction" name="direction" value="right"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
              	</form>
            	<form method="POST" action="main.php">
             		<button class="direction" name="direction" value="down"><i class="fa fa-arrow-down" aria-hidden="true"></i></button>
              	</form>
        	</div>
                    
            Per inserire una type seleziona il tipo e la direction. In seguito clicca sulla cella da cui far partire la type
            <?php echo 'errore: '.$messageError?>
    	</div>
    </body>
</html>

