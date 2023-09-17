<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sopa de letras</title>
</head>
<body>
    <!-- Gustavo Flores Mejía No Contrl 210120167-->
    <h1 style="font-family: Arial;"> -- Sopa de letras -- </h1>
    <form method="get" action="">
    <spin style="font-family: Arial;">Inserta la palabra a buscar:</spin> 
    <br>
    <input type="text" name="palabra" >
    <input type="submit" value="Buscar">
    </form>
    <br>
    <?php
     $sopa_letras = [
        ['Y','R','E','U','Q','J','S','M','A','P'],
        ['R','A','H','L','X','W','P','Q','Z','A'],
        ['E','L','C','M','K','A','A','W','L','H'],
        ['V','B','A','T','P','C','N','W','E','B'],
        ['R','H','P','H','Q','V','G','N','V','Y'],
        ['E','T','A','M','B','F','U','F','A','B'],
        ['S','T','O','U','J','C','L','M','R','L'],
        ['T','P','I','R','C','S','A','V','A','J'],
        ['W','R','H','S','T','A','R','F','L','Q'],
        ['W','H','S','P','Q','G','T','Q','Y','S']
    ];

    if (!empty($_GET)) {
        /**
         * Aqui obtengo el número de filas y columnas de la matriz, 
         * Tambien la longitud de la palabra
         */
        $palabra = $_GET['palabra'];
        $filas = count($sopa_letras);
        $columnas = count($sopa_letras[0]);
        $longitud = strlen($palabra);
        /**
         * Con este for hago recorrer cada celda de la matriz y 
         * comprueba si esta la primera letra de la matriz
         */
        for ($i = 0; $i < $filas; $i++) {
            for ($j = 0; $j < $columnas; $j++) {
                if ($sopa_letras[$i][$j] == $palabra[0]) {
                    // explorar las ocho direcciones posibles desde la celda
                    for ($dir = 0; $dir < 8; $dir++) {
                        /***
                         * Variables para guardar las coordenadas de las letras encontradas
                         * Junto don el contador de las letras ya encontradas
                         * y en el array guardar las coords
                         */ 
                        $x = $i;
                        $y = $j;
                        $cont = 0;
                        $posicion_palabra = array();
                        // recorrer la palabra letra por letra
                        for ($k = 0; $k < $longitud; $k++) {
                            // comprobar si las coordenadas son válidas y si hay una coincidencia con la letra actual
                            if ($x >= 0 && $x < $filas && $y >= 0 && $y < $columnas && $sopa_letras[$x][$y] == $palabra[$k]) {
                                // incrementar el contador y guardar las coordenadas en el array de posiciones
                                $cont++;
                                array_push($posicion_palabra, array($x, $y)); // gUARDO las coordenadas 
                                switch ($dir) {
                                    case 0: // arriba
                                        $x--;
                                        break;
                                    case 1: // abajo
                                        $x++;
                                        break;
                                    case 2: // izquierda
                                        $y--;
                                        break;
                                    case 3: // derecha
                                        $y++;
                                        break;
                                    case 4: // diagonal superior izquierda
                                        $x--;
                                        $y--;
                                        break;
                                    case 5: // diagonal superior derecha
                                        $x--;
                                        $y++;
                                        break;
                                    case 6: // diagonal inferior izquierda
                                        $x++;
                                        $y--;
                                        break;
                                    case 7: // diagonal inferior derecha
                                        $x++;
                                        $y++;
                                        break;
                                }
                            } else {
                                break;
                            }
                        }
                        // Aqui confirmo si la palabra se encontro completa con el contador ya antes icializado
                        if ($cont == $longitud) {
                            // aqui ya nomas se le cambia el findo a las letras que fueron encontradas
                            foreach ($posicion_palabra as $pos) {
                                $x = $pos[0];
                                $y = $pos[1];
                                $sopa_letras[$x][$y] = "<spin style='background-color: greenyellow'>" . $sopa_letras[$x][$y] . "</spin>";
                            }
                        }
                    }
                }
            }
        }

    }
echo "<table border=3>"; //Bucle para imprimir la matriz ya cambiada
    for ($i = 0; $i < count($sopa_letras); $i++) {
        echo "<tr>";
        for ($j = 0; $j < count($sopa_letras[$i]); $j++) {
            echo "<td>" . $sopa_letras[$i][$j] . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    ?>
    
</body>
</html>