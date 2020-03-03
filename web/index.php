<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// Conectando y seleccionado la base de datos 
$dbopts = getenv('DATABASE_URL');
$dbconn = pg_connect($dbopts)
    or die('No se ha podido conectar: ' . pg_last_error());

// Realizando una consulta SQL
$query = 'SELECT * FROM users';
$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

//Formulario de registro de usuarios
echo "<form action='index.php' method='POST' >
    <p>Registrate</p>\n
    <p>User: <input type='text' name='user'/></p>
    <p>Password: <input type='text' name='pass'/></p>
    <p><input type='submit' name='submit'/></p>
    </form>";

//Insertar en la base de datos
if (isset($_POST['submit'])){
    $newUser = 'INSERT INTO users values("'$_POST['user'], $_POST['pass']'")';

}

// Imprimiendo los resultados en HTML
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Liberando el conjunto de resultados
pg_free_result($result, $newUser);

// Cerrando la conexión
pg_close($dbconn);
?>
</body>
</html>