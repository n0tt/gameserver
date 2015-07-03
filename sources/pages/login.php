
<?php
if($login->UserLogged() == true){
	echo'<META HTTP-EQUIV="refresh" CONTENT="0; URL=index.php">';
}
else {
echo '<style>
.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="text"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
.bs-callout-warning{
	border-left-color:
}
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
</style>';

	echo '
				<form class="form-signin" method="post" role="form" style="max-width: 330px;padding: 15px;margin: 0px auto;">
					<h2 class="form-signin-heading"><span class="glyphicon glyphicon-log-in"></span> Please sign in</h2>';
					if (isset($login)) {
						if ($login->errors) {
							echo' <div class="bs-callout-warning bs-callout"><p class="bg-danger">';
							foreach ($login->errors as $error) {
								echo $error;
							}
							echo '</p></div>';
						}
						if ($login->messages) {
							echo '<div class="center-block"><p class="bg-sucess">';
							foreach ($login->messages as $message) {
								echo $message;
							}
							echo '</p></div>';
						}
					}
		echo '			
					<hr>
						<input name="user_name" placeholder="Email / Nickname" required="" autofocus="" class="form-control" type="text">
						<input name="user_password" placeholder="Password" required="" autofocus="" class="form-control" type="password">
					<hr>
						<button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
				</form>
			';
}
?>