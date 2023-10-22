<?php
$servername = "localhost";
$username = "tim";
$password = "Solidarity1989";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Problem z połączeniem: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html>
<?php include('header.php') ?>
<body>
<h4 class="glowny">Kody pocztowe dla miasta</h4> 
<div class="container">
<form method="post" action="index.php" />
<label>Szukaj miasta</label>
<input type="text" name="search">
<input type="submit" name="szukaj" value=Szukaj>
</form>
<div class="row">
<div id="results">
<?php 
include("szukanie.php");
?>
</div>
<div class="col">
<?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start_from = ($page-1) * $results_per_page;
$sql = "SELECT * FROM miasta ORDER BY ID ASC LIMIT $start_from, ".$results_per_page;
$rs_result = $conn->query($sql);
$miasta = $result->fetch_assoc();
?> 
<form action="index.php" method="POST">
<input type="hidden" name="id_to_delete" value="<?php echo $miasta['ID'] ?>">
<br><br><br>
<table border="1" cellpadding="4" cellspacing="0">
<thead>
<tr>
<th> Nazwa miasta </th>
<th> Kod pocztowy </th>
</tr>
</thead>
<tbody>
<?php 
while($row = $rs_result->fetch_assoc()) {
		$status = '';
		echo '<tr>';
		echo '<td>'.$row['Nazwa_miasta'].'</td>';
		echo '<td>'.$row['Kod_pocztowy'].'</td>';
//		echo '<td><input type="submit" name="delete" value="Usuń"></td>';
		echo '</tr>';
} ?>
</tbody>
</table>
</form>
<?php 
$sql = "SELECT COUNT(ID) AS total FROM miasta";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
  
for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
            echo "<a href='index.php?page=".$i."'";
            if ($i==$page)  echo " class='curPage'";
            echo ">".$i."</a> "; 
}; 
?>
</div>
</div>
</div>
</body>
<?php include('footer.php') ?>
</html>