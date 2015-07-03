
<!-- ROW	-->
<div class="row">
<!--STATS-->
	<div clasS="col-sm-6 col-md-4">
	<div class="panel panel-default">

  <div class="panel-heading"><h4><img src="images/radar_race.png" width="26px"/> Top caçador de patos</h4></div>
  <div class="panel-body">
    <table class="table table-striped ">
	<tbody>
		<?php 
			$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			foreach($db->query("SELECT nome, missao1 FROM usuarios ORDER BY missao1 DESC LIMIT 5") as $row){
				echo '<tr><td><b>'.$row['nome'].'</b><span class="badge pull-right" style="background:#428BCA;">'.$row['missao1'].'</span></td></tr>';
			} 
		?>
	</tbody>
	</table>
  </div>
</div>
</div>
<!--end STATS-->
<!--STATS-->
  <div clasS="col-sm-6 col-md-4">
	<div class="panel panel-default">

  <div class="panel-heading"><h4><img src="images/radar_emmetGun.png" width="26px"/> Top mortos</h4></div>
  <div class="panel-body">
    <table class="table table-striped ">
	<tbody>
		<?php 
			$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			foreach($db->query("SELECT nome, mortos FROM usuarios ORDER BY mortos DESC LIMIT 5") as $row){
				echo '<tr><td><b>'.$row['nome'].'</b><span class="badge pull-right" style="background:#428BCA;">'.$row['mortos'].'</span></td></tr>';
			} 
		?>
	</tbody>
	</table>
  </div>
</div>
</div>
<!--end STATS-->
<!--STATS-->
<div clasS="col-sm-6 col-md-4">
	<div class="panel panel-default">

  <div class="panel-heading"><h4><img src="images/radar_hostpital.png" width="26px"/> Top mortes</h4></div>
  <div class="panel-body">
    <table class="table table-striped ">
	<tbody>
		<?php 
			$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			foreach($db->query("SELECT nome, mortes FROM usuarios ORDER BY mortes DESC LIMIT 5") as $row){
				echo '<tr><td><b>'.$row['nome'].'</b><span class="badge pull-right " style="background:#428BCA;">'.$row['mortes'].'</span></td></tr>';
			} 
		?>
	</tbody>
	</table>
  </div>
</div>
</div>
</div>
<!--end STATS-->
<div class="row">
<!--CHANGE NICKS-->
<div class="col-md-6" >
	<div class="panel panel-default">
	
	<div class="panel-heading"><h4><span class="glyphicon glyphicon-align-justify"></span> Changenick Logs</h4></div>
	
	<div class="panel-body"style="height:300px;overflow-x:hidden;overflow-y:scroll;">
    <table class="table table-striped" >
	<tbody>
		<?php 
			$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			foreach ($db->query("SELECT anome,nnome,ip,data FROM nicklogs ORDER BY id DESC") as $row) {
				echo "<tr><td><b style='font-size:12px'> <font color='red'>" . $row['nnome'] . "</font> mudou de nick para <font color='red'>" . $row['anome'] . "</font> Em: <font color='red'>" . $row['data'] . "</font></b></td></tr>";
			} 
		?>
	</tbody>
	</table>
  </div>
</div>
</div>
<!-- END CHANGE NICKS-->
<!--CHANGE NICKS-->
<div class="col-md-6" >
	<div class="panel panel-default">
	
	<div class="panel-heading"><h4><span class="glyphicon glyphicon-align-justify"></span> Bans Logs</h4></div>
	
	<div class="panel-body"style="height:300px;overflow-x:hidden;overflow-y:scroll;">
    <table class="table table-striped" >
	<tbody>
		<?php
			$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			foreach ($db->query("SELECT admin,user,motivo,ip,fake,data FROM punidos ORDER BY id DESC") as $row) {
				echo "<tr><td><b style='font-size:12px'> Conta: <font color='red'>" . utf8_encode($row['user']) . "</font> "; 
				if($login->UserIsAdmin()) echo "(IP: <font color='#00c6ff'>" . $row['ip'] . "</font>) ";
				if($row['fake'] == 0){ 
					echo "banido por: <font color='#00DD00'>" . $row['admin'] . "</font> ";
				}else{
					echo "banido por: <font color='#00DD00'><font color='black'>Admin</font> "; 
				}
				echo "(Motivo: <font color='red'>" . utf8_encode($row['motivo']) . "</font>) em <font color='red'>" . $row['data'] . "</font></b></td></tr>";
			} 
		?>
	</tbody>
	</table>
  </div>
</div>
</div>
<!-- END CHANGE NICKS-->
<!-- GANGS TOPS-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<div class="col-md-6" >
	<div class="panel panel-default">
	
	<div class="panel-heading"><h4><img src="images/radar_enemyAttack.png" width="26px"/> Dominio de territórios</h4></div>
	
	<div class="panel-body">
	<?php
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$data = array();
	$query = $db->query("SELECT tag, numero, cor_string FROM gangs ORDER BY numero");
	while($row = $query->fetch_array()){
		$query2 = $db->query("SELECT id FROM territorios WHERE gangnum = ".$row['numero']."");
		$rows = $query2 ->num_rows;
		$data[] = array("name" => $row['tag'], "y" => $rows, "color" => "#" . $row['cor_string']);
	}
	$jSon = json_encode($data);
	?>
	<script type="text/javascript">//<![CDATA[ 

$(function () {
    $('#grafc').highcharts({

        title: {
            text: ''
        },
		credits: {
            enabled: false
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
		exporting: {
			enabled: false
		},
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '{point.color}',
                    connectorColor: '#000000',
                    format: '<b style="color:{point.color}">{point.name}</b>: {point.percentage:.1f} % territórios'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Quantidade de territórios',
            data: <?php echo $jSon;?>
        }]
    });
});
//]]>  

</script>
    <div id="grafc" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
  </div>
</div>
</div>
<!-- end gang tops-->
</div>
<!-- end ROW -->