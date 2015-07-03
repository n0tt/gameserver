<div class="page-header">
  <h1>Lista de jogadores <small>SA:MP </small></h1>
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
		$sql = "SELECT * FROM usuarios ORDER BY userid ASC LIMIT $start_from, 20";
		break;
	}
	case 1:
	{
		$sql = "SELECT * FROM usuarios ORDER BY nome ASC LIMIT $start_from, 20";
		break;		
	}
	case 2:
	{
		$sql = "SELECT * FROM usuarios ORDER BY mortos DESC LIMIT $start_from, 20";
		break;
	}
	case 3:
	{
		$sql = "SELECT * FROM usuarios ORDER BY mortes DESC LIMIT $start_from, 20";
		break;
	}
	case 4:
	{
		$sql = "SELECT * FROM usuarios ORDER BY carteira DESC LIMIT $start_from, 20";
		break;
	}
	case 5:
	{
		$sql = "SELECT * FROM usuarios ORDER BY tempoingame DESC LIMIT $start_from, 20";
		break;
	}
	case 6:
	{
		$sql = "SELECT * FROM usuarios ORDER BY level DESC LIMIT $start_from, 20";
		break;
	}
	default:$sql = "SELECT * FROM usuarios ORDER BY userid ASC LIMIT $start_from, 20";
}
$url = "http://".$_SERVER['HTTP_HOST'];

?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th><a href="index.php?action=players&order=0&page=<?php echo $page; ?>">#ID</a></th>
			<th><a href="index.php?action=players&order=1&page=<?php echo $page; ?>">#Nome</a></th>
			<th><a href="index.php?action=players&order=6&page=<?php echo $page; ?>">#Nivel</a></th>
			<th><a href="index.php?action=players&order=2&page=<?php echo $page; ?>">#Mortos</a></th>
			<th><a href="index.php?action=players&order=3&page=<?php echo $page; ?>">#Mortes</a></th>
			<th><a href="index.php?action=players&order=4&page=<?php echo $page; ?>">#Dinheiro</a></th>
			<th><a href="index.php?action=players&order=5&page=<?php echo $page; ?>">#Tempo Online</a></th>
		</tr>
	</thead>
<?php
foreach ($db->query($sql) as $row) {

            echo'<tr>
			<td>'.$row["userid"].'</td>
            <td><a href="index.php?action=users;id='.$row["userid"].'">'.$row["nome"].'</a></td>
			<td>'.$row["level"].'</td>
			<td>'.$row["mortos"].'</td>
			<td>'.$row["mortes"].'</td>
			<td>'.$row['carteira'].'</td>
            <td>'.date('H:i:s', $row['tempoingame']).'</td>
            </tr>';

}
?>
</table>
<div class="center-block text-center">
<?php

	Pagination(1, "index.php?action=players&order=".$order)
?>
</div>