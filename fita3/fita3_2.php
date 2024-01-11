<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple de Filtrar Llengües</title>
    <style>
        table, td {
            border: 1px solid black;
            border-spacing: 0px;
        }
    </style>
</head>

<body>
    <h1>Exemple de Filtrar Llengües</h1>
    <h2>Filtrar Llengües</h2>
    <form method="post">
        <label for="nom_llengua">Nom de la llengua:</label>
        <input type="text" name="nom_llengua" >
        <button type="submit">Filtrar</button>
    </form>
    <?php
    $conn = mysqli_connect('localhost', 'xavi', 'Superlocal123@');

    mysqli_select_db($conn, 'world');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom_llengua = $_POST["nom_llengua"];
        $consulta = "SELECT DISTINCT language, isofficial FROM countrylanguage WHERE language LIKE '%$nom_llengua%';";
    } else {
        $consulta = "SELECT DISTINCT language, isofficial FROM countrylanguage;";
    }

    $resultat = mysqli_query($conn, $consulta);

    if (!$resultat) {
        $message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
        $message .= 'Consulta realitzada: ' . $consulta;
        die($message);
    }
    ?>

    <table>
        <thead><td colspan="2" align="center" bgcolor="cyan">Llistat de Llengües</td></thead>
        <?php
        while ($registre = mysqli_fetch_assoc($resultat)) {
            echo "\t<tr>\n";
            echo "\t\t<td>" . $registre["language"];
            if ($registre["isofficial"] == "T") {
                echo " [OFICIAL]";
            } else {
                echo "";
            }
            echo "</td>\n";
            echo "\t</tr>\n";
        }
        ?>
    </table>


</body>
</html>