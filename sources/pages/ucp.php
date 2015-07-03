<?php
if($login->UserLogged() == false){
	echo'<META HTTP-EQUIV="refresh" CONTENT="0; URL=index.php?action=login">'; 
}else{

echo "<style>

.bs-callout{
	padding: 10px 10px 0px 10px;
	margin: 20px 0px;
	border-width: 1px 1px 1px 5px;
	border-style: solid;
	border-color: rgba(255, 0, 0, 0.76);
	-moz-border-top-colors: none;
	-moz-border-right-colors: none;
	-moz-border-bottom-colors: none;
	-moz-border-left-colors: none;
	border-image: none;
	border-radius: 3px;
}
.bs-callout-warning{
	border-color:rgba(255, 0, 0, 0.76);
}
.bs-callout-success{
	border-color:rgba(74, 255, 0, 0.46);
}
</style>
";
if (isset($login)) {
		if ($login->errors) {
			echo' <div class="bs-callout-warning bs-callout">';
				foreach ($login->errors as $error) {
					echo '<p class="bg-danger">'.$error.'</p>';
				}
			echo '</div>';
		}
		if ($login->messages) {
			echo '<div class="bs-callout-success bs-callout">';
				foreach ($login->messages as $message) {
					echo '<p class="bg-success">'.$message.'<p>';
				}
			echo '</div>';
		}
	}
?>
<div class="row">
<div class="col-md-8 col-xs-12">
<form class="form-horizontal" role="form" method="post"> 
	<h2>Mudar e-mail <small>SA:MP</small></h2>
		<div class="form-group">
			<label class="col-sm-2 control-label">E-mail atual</label>
			<div class="col-sm-10">
				<p class="form-control-static"><?php echo $_SESSION['u_email']; ?></p>
			</div>
		</div>
		<div class="form-group">
			<label for="email" class="col-sm-2 control-label">Novo e-mail</label>
			<div class="col-sm-10">
				<input type="mail" class="form-control" id="email" name="email" required=""placeholder="example@example.com">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="c_mail" >Mudar e-mail</button>
			</div>
		</div>
</form>

<hr>

<form class="form-horizontal" role="form" method="post">
	<h2>Mudar password <small>SA:MP</small></h2>
		<div class="form-group">
			<label class="col-sm-2 control-label">Password antiga</label>
			<div class="col-sm-10">
				<input type="password" class="form-control" id="apw" name="apw" required=""placeholder="*********">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Password</label>
			<div class="col-sm-10">
				<input type="password" class="form-control" id="email" name="pw" required=""placeholder="*********">
			</div>
		</div>
		<div class="form-group">
			<label for="email" class="col-sm-2 control-label">Repete a password</label>
			<div class="col-sm-10">
				<input type="password" class="form-control" id="email" name="rpw" required=""placeholder="*********">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="c_pw" >Mudar password</button>
			</div>
		</div>
</form>

<hr>

<h2>Gerador de assinaturas <small>SA:MP</small></h2>
<select id="choose" class="form-control" style="width:650px;">
	<option value ="1">Type #1</option>
	<option value ="2">Type #2</option>
	<option value ="3">Type #3</option>
	<option value ="4">Type #4</option>
	<option value ="5">Type #5</option>
</select>
<hr>
<div class="panel panel-default"  id ="update">
  <div class="panel-heading">
    <h3 class="panel-title">Assinatura Type 1</h3>
  </div>
  <div class="panel-body text-center" >
    <img src="http://84.200.10.52/stats/stats.php?user=<?php echo $_SESSION['u_name']; ?>&type=1"/><div class="well well-sm"><code>[img]http://84.200.10.52/stats/stats.php?user=<?php echo $_SESSION['u_name']; ?>&type=1[/img]</code></div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
    $('#choose').change(function(event) {
        $('#update').html('<div class="panel-heading"><h3 class="panel-title">Assinatura Type ' + $('#choose').val() + '</h3></div><div class="panel-body text-center"><img src="http://84.200.10.52/stats/stats.php?user=<?php echo $_SESSION['u_name']; ?>&type=' + $('#choose').val() + '"/><div class="well well-sm"><code>[img]http://84.200.10.52/stats/stats.php?user=<?php echo $_SESSION['u_name']; ?>&type=' + $('#choose').val() + '[/img]</code></div></div>');
    }); 

</script>
</div>
</div>
<?php
}
?>
