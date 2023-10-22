<?php

$con = new PDO("mysql:host=localhost;dbname=miasta",'tim','Solidarity1989');

if (isset($_POST["szukaj"])) {
	$str = $_POST["search"];
	$sth = $con->prepare("SELECT * FROM `miasta` WHERE Nazwa_miasta LIKE '%$str%' OR Kod_pocztowy LIKE '%$str%'");

	$sth->setFetchMode(PDO:: FETCH_OBJ);
	$sth -> execute();
?>
		<br><br><br>
		<table border="1" cellpadding="4" cellspacing="0">
			<tr>
				<th>Nazwa miasta</th>
				<th>Kod pocztowy</th>
			</tr>
<?php 
	while($row = $sth->fetch())
	{
		?>
			<tr>
				<td><?php echo $row->Nazwa_miasta; ?></td>
				<td><?php echo $row->Kod_pocztowy;?></td>
			</tr>
<?php

	}
		
	


}
?>

		</table>