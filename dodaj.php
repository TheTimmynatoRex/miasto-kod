<?php 
$conn = mysqli_connect('localhost', 'tim', 'Solidarity1989', 'miasta');

if (!$conn){
echo 'Błąd z konekcji do bazy danych: ';
}
$miasta = $kod_pocztowy = '';
$errors = array('miasto'=>'', 'kod_pocztowy'=>'');
if(isset($_POST['submit'])){
if (empty($_POST['miasto'])){
$errors['miasto'] = 'Miasto musi być wymagane <br />';
} else {
$miasta = $_POST['miasto'];
if(!preg_match('/^[a-zA-Z\s]+$/', $miasta)){
$errors['miasto'] = 'Miasto nie jest ważne; musi miać tylko litery i spacje <br />';
}
}
if (empty($_POST['kod_pocztowy'])){
$errors['kod_pocztowy'] = 'Kod pocztowy musi być wymagane <br />';
} else {
$kod_pocztowy = $_POST['kod_pocztowy'];
if(!preg_match('/^[0-9\-]+$/', $kod_pocztowy)){
$errors['kod_pocztowy'] = 'Kod pocztowy nie jest ważne; musi miać tylko numery <br />';
}
}
if(array_filter($errors)){

} else {
$miasta = mysqli_real_escape_string($conn, $_POST['miasto']);
$kod_pocztowy = mysqli_real_escape_string($conn, $_POST['kod_pocztowy']);
$sql = "INSERT INTO miasta(`Nazwa_miasta`,`Kod_pocztowy`) VALUES('$miasta', '$kod_pocztowy')";
if(mysqli_query($conn, $sql)){
header('Location: index.php');
} else {
echo 'Problem z zapisaniem: ' . mysqli_error($conn);
}
}
}
?>

<!DOCTYPE html>
<html>
<?php include('header.php') ?>
<body>
<section>
<h4 class="form">Dodaj kod miasta </h4>
<form class="dodawanie" action="dodaj.php" method="POST">
<br />
<label>Nazwa miasta:</label>
<br />
<input type="text" name="miasto" value="<?php echo htmlspecialchars($miasta) ?>">
<div class="error"><?php echo $errors['miasto']; ?></div>
<br />
<label>Kod pocztowy:</label>
<br />
<input type="text" name="kod_pocztowy" value="<?php echo htmlspecialchars($kod_pocztowy) ?>">
<div class="error"><?php echo $errors['kod_pocztowy']; ?></div>
<br />
<div>
<input type="submit" name="submit" value="Dodaj">
</div>
</form>
</section>
</body>
<?php include('footer.php') ?>
</html>