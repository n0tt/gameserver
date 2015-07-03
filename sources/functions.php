<?php
function hashsamp( $string ) {
    return strtoupper(hash('WHIRLPOOL',$string));
}
function Pagination($from, $link) {
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };

$start_from = ($page-1) * 20;
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($from == 1){
		$sql = "SELECT userid FROM usuarios";
	}else if($from == 2){
		$sql = "SELECT id FROM casas";
	}else if($from == 3){
		$sql = "SELECT id FROM bizes";
	}
	$query = $db->query($sql);
	$row = $query->num_rows;
	$total_records = $row;
	$start_pag_num = ($page - 6) < 1 ? 1 :  $page - 6;

	$total_pages = ceil($total_records / 20);
	$end_pag_num = ($page + 6) > $total_pages ? $total_pages :  $page + 6;
	echo '<ul class="pagination"> ';
	if($page == 1){
		echo '<li class="disabled"><a href="#">&laquo;</a></li>';
	}
	else{
		$nextpage=$page-1;
		echo '<li><a href="'.$link.'&page=1">&laquo;&laquo;</a></li>';
		echo '<li><a href="'.$link.'&page='.$nextpage .'">&laquo;</a></li>';
	}
	for ($i=$start_pag_num; $i <= $end_pag_num; $i++) {
		if($i <= $total_records){
			if($page == $i){
				echo '<li class="active"><a href="'.$link.'&page='.$i.'">'.$i.'</a></li>';
			}else {
			 
				echo '<li><a href="'.$link.'&page='.$i.'">'.$i.'</a></li>';
			}
		}
	};
	if($page == $total_pages){
		echo '<li class="disabled"><a href="#">»</a></li>';
	}
	else{
		$nextpage=$page+1;
		
		echo '<li><a href="'.$link.'&page='.$nextpage .'">»</a></li>';
		echo '<li><a href="'.$link.'&page='.$total_pages.'">»»</a></li>';
	}
	echo '</ul>';
}
function ShowLoginModel($form = 0)
{
	if($form == 0){
		echo '
				<form method="post" class="navbar-form navbar-right" role="form">
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input name="user_name" placeholder="Email / Nickname" class="form-control" type="text">
						<div class="input-group-btn">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
						  <input name="user_password" placeholder="Password" class="form-control" type="password">
					</div>
					<button type="submit" class="btn btn-primary" name="login">Login</button>
					</div>
				</div>	
				</form>
			';
	}
	else if($form == 1){
		echo '
				<form class="form-horizontal" role="form" method="post" >
				  <div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Email / Nickname</label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" id="inputEmail3" name="user_name" placeholder="Email / Nickname">
					</div>
				  </div>
				  <div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
					  <input type="password" class="form-control" id="inputPassword3" name="user_password" placeholder="Password">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					  <button class="btn btn-lg btn-primary btn-block" type="submit" name="login" >Login</button>
					</div>
				  </div>
				</form>
			';
	}
}

function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

?>