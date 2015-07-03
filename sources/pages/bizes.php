<div class="page-header">
  <h1>Lista de negócios <small>SA:MP </small></h1>
</div>
<?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
if (isset($_GET['order'])) { $order = $_GET['order']; } else { $order = 0; };
$start_from = ($page-1) * 20;

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

switch($order)
{
	case 0:
	{
		$sql = "SELECT * FROM bizes ORDER BY id ASC LIMIT $start_from, 20";
		break;
	}
	case 1:
	{
		$sql = "SELECT * FROM bizes ORDER BY dono ASC LIMIT $start_from, 20";
		break;		
	}
	case 2:
	{
		$sql = "SELECT * FROM bizes ORDER BY level DESC LIMIT $start_from, 20";
		break;
	}
	case 3:
	{
		$sql = "SELECT * FROM bizes ORDER BY vendida DESC LIMIT $start_from, 20";
		break;
	}
	case 4:
	{
		$sql = "SELECT * FROM bizes ORDER BY descricao DESC LIMIT $start_from, 20";
		break;
	}
	default:$sql = "SELECT * FROM bizes ORDER BY id ASC LIMIT $start_from, 20";
}
$url = "http://".$_SERVER['HTTP_HOST'];

?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th><a href="index.php?action=bizes&order=0&page=<?php echo $page; ?>">#ID</a></th>
			<th><a href="index.php?action=bizes&order=1&page=<?php echo $page; ?>">#Dono</a></th>
			<th><a href="index.php?action=bizes&order=2&page=<?php echo $page; ?>">#Nivel</a></th>
			<th><a href="index.php?action=bizes&order=4&page=<?php echo $page; ?>">#Descrição</a></th>
			<th><a href="index.php?action=bizes&order=3&page=<?php echo $page; ?>">#Venda</a></th>
		</tr>
	</thead>
<?php
foreach ($db->query($sql) as $row) {

            echo'<tr>
			<td>'.$row["id"].'</td>
            <td><a href="index.php?action=users;id='.$row["donoid"].'">'.$row["dono"].'</a></td>
			<td>'.$row["level"].'</td>
			<td>'.$row["descricao"].'</td>
			<td>';
			if($row["vendida"] == 1){
				echo "<span class='label label-danger'>Comprada</span>";
			} else {
				echo "<span class='label label-success'>Há venda</span>";
			} 
			echo'</td>
            </tr>';

}
?>
</table>
<div class="center-block text-center">
<?php

	Pagination(3, "index.php?action=bizes&order=".$order)
?>
</div>