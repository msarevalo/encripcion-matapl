<?php
header('Content-Type: text/html; charset=UTF-8');

?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <title>Taller PreParcial | Punto A</title>
    <meta http-equiv="content-type" content="utf-8">
    <!-- Estilos -->
    <link href="../css/estilos.css" rel="stylesheet">
    <!--<link href="../css/estilos.css" rel="stylesheet">
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/script.js" type="application/javascript"></script>
</head>
<body>
<?php

$abecedario=[0=>'a',
1=>'b',
2=>'c',
3=>'d',
4=>'e',
5=>'f',
6=>'g',
7=>'h',
8=>'i',
9=>'j',
10=>'k',
11=>'l',
12=>'m',
13=>'n',
14=>'ñ',
15=>'o',
16=>'p',
17=>'q',
18=>'r',
19=>'s',
20=>'t',
21=>'u',
22=>'v',
23=>'w',
24=>'x',
25=>'y',
26=>'z',
27=>'1',
28=>'2',
29=>'3',
30=>'4',
31=>'5',
32=>'6',
33=>'7',
34=>'8',
35=>'9',
36=>'0'];

if (isset($_POST['solicitud'])){
    $solicitud = $_POST['solicitud'];
}

if (isset($_POST['cadena'])){
    $cadena = $_POST['cadena'];
     
    //echo $cadena . "<br>";
    //$prueba = str_split($cadena);
    for ($position = 0, $textLen = mb_strlen($cadena,'UTF-8'); $position < $textLen; $position++){
         $prueba[] = mb_substr ($cadena,$position,1,'UTF-8');
    }

    $original = array();
    $respuesta = array();
    $encriptada = array();
    
    for($i=0; $i<sizeof($prueba);$i++){
        $letra = array_search($prueba[$i], $abecedario);
        array_push($original, $letra);
        $encripcion = ($letra + $solicitud) % 37;
        array_push($respuesta, $encripcion);
        array_push($encriptada, $abecedario[$encripcion]);
    }
}

?>
<a href="../index.php"><img src="../img/home.png" width="60"></a>
<div style="margin-left: 500px; margin-top: -20px">
    <form action="../encripcion.php" enctype="multipart/form-data" method="post" id="encriptar">
        <div class="group">
            <input type="number" id="solicitud" name="solicitud" required min="0" max="36">
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Entrada</label>
        </div>
        <div class="group">      
            <input type="text" pattern="[a-z0-9ñ]+" title="Valores unicamente alfanumericos" id="cadena" name="cadena" required>
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Cadena</label>
        </div>
        <button type="submit" class="btn w-M br-0 stl-3" style="cursor:pointer">Encriptar</button>
        <?php
            if (isset($_POST['cadena'])){
                echo "<a href='../encripcion.php' class='btn w-M br-0 stl-3'>Limpiar</a>";
            }
        ?>
    </form>
</div>
<div style="margin-top: 50px">
    <center><?php
        if (isset($_POST['cadena'])){
            ?>
            <p>Entrada: <?php echo $solicitud; ?> | Cadena: <?php echo $cadena; ?></p>
            <table border="1">
                <tr>
                    <th>Cadena</th>
                    <?php
                        for($i=0; $i<sizeof($prueba);$i++){
                            echo "<td>" . $prueba[$i] . "</td>";
                        }
                    ?>
                </tr>
                <tr>
                    <th>ID Letra</th>
                    <?php
                        for($i=0; $i<sizeof($original);$i++){
                            echo "<td>" . $original[$i] . "</td>";
                        }
                    ?>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <th>Encripcion</th>
                    <?php
                        for($i=0; $i<sizeof($respuesta);$i++){
                            echo "<td>" . $respuesta[$i] . "</td>";
                        }
                    ?>
                </tr>
                <tr>
                    <th>Salida</th>
                    <?php
                        $salida = null;
                        for($i=0; $i<sizeof($encriptada);$i++){
                            $salida = $salida . $encriptada[$i];
                            echo "<td>" . $encriptada[$i] . "</td>";
                        }
                    ?>
                </tr>
            </table>
            <p>Salida: <?php echo $salida; ?></p>
            <div style="margin-top:-80px">
            <center>
                <form action="../desencripcion.php" enctype="multipart/form-data" method="post" id="deencriptar">
                    <input value="<?php echo $solicitud ?>" style="visibility: hidden" id="solicitudd" name="solicitudd">
                    <input value="<?php echo $salida ?>" style="visibility: hidden" id="cadenad" name="cadenad">
                    <button type="submit" class="btn w-M br-0 stl-3" style="cursor:pointer">Desencriptar</button>
                </form></center>
                
            <?php
        }
    ?>
    </center>
</div>
</body>
</html>