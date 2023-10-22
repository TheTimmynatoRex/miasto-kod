<?php
$conn = mysqli_connect('localhost', 'tim', 'Solidarity1989', 'miasta');

if (!$conn){
echo 'Błąd z konekcji do bazy danych: ';
}

$results_per_page = 10;

$sql = 'SELECT * FROM miasta ORDER BY "Nazwa miasta"';

$result = mysqli_query($conn, $sql);

$miasto = mysqli_fetch_assoc($result);

$id_to_delete = '';

if(isset($_POST['delete'])){
mysqli_real_escape_string($conn, $_POST['id_to_delete']);
$sql_delete = "DELETE FROM miasta WHERE ID = $id_to_delete";
if(mysqli_query($conn, $sql_delete)){
header('Location: index.php');
} {
echo "Problem z usuńięciem: " . mysqli_error($conn);
}
}

date_default_timezone_set('Europe/Warsaw');
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {
background-color: lightgrey;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: lightblue;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 20px;
  text-decoration: none;
}

li a:hover {
  background-color: azure;
  color: black;
}

footer {
  text-align: center;
  padding: 25px 20px;
}

section {
max-width: 750px;
margin: 30px auto;
padding: 20px;
background-color: darkgrey;
}

h4.form {
text-align: center;
font-size: 28px;
font-family: impact;
}

h4.glowny {
text-align: center;
font-size: 20px;
padding: 20px;
margin: 10px auto;
font-family: verdana;
}

form.dodawanie {
margin: 20px auto;
text-align: center;
color: white;
font-size: 20px;
font-family: "Arial";
}

div.error {
color: red;
font-size: 18px;
}

div.container{
align: center;
}

div.row{

}

div.col{
text-align: center;
}

div.timestamp {
  display: block;
  color: grey;
  text-align: center;
  padding: 14px 20px;
  text-decoration: none;
}

table {
font-family: serif;
font-size: 16px;
color: black;
}

</style>
<title>Miasto Kod</title>
</head>

<body onload=timer_function();>
<ul>
  <li><a class="active" href="index.php">Miasto Kod</a></li>
  <li style="float:right"><a href="dodaj.php" onclick="timer_function();">Dodaj kod miasta</a></li>
  <li style="float:right"><div class="timestamp" id="msg"><?php include('zegar2.php')?></div></li>
</ul>