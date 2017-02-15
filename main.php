<?php
session_start();

require_once 'Classes/Ship.php';
require_once 'Classes/Table.php';

if (isset($_SESSION['grigliaNavi'])) {
	$tableShip = unserialize($_SESSION['tableShip']);
} else {
// 	for ($i=0; $i<10; $i++) {
// 		for ($ii=0; $ii<10; $ii++) {
// 			$grigliaNavi[$i][$ii] = 0;
// 		}
// 	}

	$tableShip = new Table();
	$tableShip->initializeTable();
}

if (isset($_POST['x']) && isset($_POST['y'])) {
	$_SESSION['x'] = $_POST['x'];
	$_SESSION['y'] = $_POST['y'];
}

// STEP 2
if (isset($_GET['nave'])) {
	$_SESSION['nave'] = $_GET['nave'];
}

// STEP 3
if (isset($_POST['direzione'])) {
	$_SESSION['direzione'] = $_POST['direzione'];
}

if (isset($_SESSION['x']) && isset($_SESSION['y']) && isset($_SESSION['direzione']) && isset($_SESSION['nave'])) {

	$x = $_SESSION['x'];
	$y = $_SESSION['y'];
	$position = Array($x, $y);
	$direzione = $_SESSION['direzione'];
	$nave = $_SESSION['nave'];
	
	$ship = new Ship($nave, $direzione, $position);
	$tableShip[$x][$y] = 1;

// 	$ship->putShip($nave, $direzione, $position);

	$_SESSION['x'] = null;
	$_SESSION['y'] = null;
	$_SESSION['nave'] = null;
	$_SESSION['direzione'] = null;

	$_SESSION['table'] = serialize($tableShip);
}


// // STEP 1
// if (isset($_POST['x']) && isset($_POST['y'])) {
// 	$_SESSION['x'] = $_POST['x'];
// 	$_SESSION['y'] = $_POST['y'];
// }

// // STEP 2
// if (isset($_GET['nave'])) {
// 	$_SESSION['nave'] = $_GET['nave'];
// }

// // STEP 3
// if (isset($_POST['direzione'])) {
// 	$_SESSION['direzione'] = $_POST['direzione'];
// }

// // HO TUTTO PER POSIZIONARE LA NAVE
// if (isset($_SESSION['x']) && isset($_SESSION['y']) && isset($_SESSION['direzione']) && isset($_SESSION['nave'])) {
// 	$x = $_SESSION['x'];
// 	$y = $_SESSION['y'];
// 	$direzione = $_SESSION['direzione'];
// 	$nave = $_SESSION['nave'];
	
// 	for ($i=0; $i<$nave; $i++) {
// 		$grigliaNavi[$x][$y] = 1;
// 		if ($direzione == 'su') {
// 			$y--;
// 		}
// 	}
	
// 	$_SESSION['x'] = null;
// 	$_SESSION['y'] = null;
// 	$_SESSION['nave'] = null;
// 	$_SESSION['direzione'] = null;
	
// 	$_SESSION['grigliaNavi'] = serialize($grigliaNavi);
// }
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
                        if($x == 0){
                            echo '<td class="cell" width="30px">'.$y.'</td>';
                        }
                        else if($y == 0) {
                            echo '<td class="cell" width="30px">'.$lettere[$x -1].'</td>';
                        }
                        else if($x == 0 && $y == 0) {
                            echo '<td class="cell"></td>'; 
                        }
                        else {
                            echo '<td class="cell">';
                            echo '<form method="POST" action="main.php">';
                            echo '<input type="hidden" name="x" value="'.($x-1).'">';
                            echo '<input type="hidden" name="y" value="'.($y-1).'">';
                            echo '<input type="submit" class="button_cell" value="'.$tableShip[$x-1][$y-1].'"></input>'; 
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
                		if($x == 0){
                			echo '<td class="cell" width="30px">'.$y.'</td>';
                		}
                		else if($y == 0) {
                			echo '<td class="cell" width="30px">'.$lettere[$x -1].'</td>';
                		}
                		else if($x == 0 && $y == 0) {
                			echo '<td class="cell"></td>';
                		}
                		else {
                			echo '<td class="cell"><input type="submit" class="button_cell" value=""></input></td>';
                		}
                	}
                	echo '</tr>';
                }
                echo '</table>';
                ?>
            </div>
        </div>
        <div class="info_ship">
            <div class="info_ship_title">Info Ship</div>
            <div class="info_ship_content">3 - <a href="?nave=2">Navi</a> || <p> 2 - Navi ||| <p> 2 - Navi |||| <p> 1 - Nave ||||| <p> 
                <div class="ship_direction">
                    <form method="POST" action="main.php">
                    	<button name="direzione" value="su"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
                    </form>
                    <button><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                    <button><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                    <button><i class="fa fa-arrow-down" aria-hidden="true"></i></button>
                </div>
                    
            Per inserire una nave seleziona il tipo e la direzione. In seguito clicca sulla cella da cui far partire la nave</div>
    </body>
</html>

