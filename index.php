<?php
require_once("sources/config.php");
require_once("sources/functions.php");
require_once("sources/classes/Login.php");

####################################################################
## criar variavel para saber as infos do usuario caso esteja logado#
$login = new Login();											   #
####################################################################
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tuga-Revolution | Gameserver</title>

    <!-- STYLES CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
	<script src="js/bootstrap.min.js"></script>
  </head>
	
    <div class="navbar-wrapper">
      <div class="container">

        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="">TR - GameServer</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li <?php if (!isset($_REQUEST['action']) || $_REQUEST['action'] == 'home') { echo'class="active"'; } ?>><a href="index.php">Inicio</a></li>
                <li><a href="http://www.tuga-revolution.com">Forum</a></li>
                <li <?php if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'players') { echo'class="active"'; } ?>><a href="index.php?action=players">Jogadores</a></li>
				<li <?php if (isset($_REQUEST['action']) &&$_REQUEST['action'] == 'houses') { echo'class="active"'; } ?>><a href="index.php?action=houses">Casas</a></li>
				<li <?php if (isset($_REQUEST['action']) &&$_REQUEST['action'] == 'bizes') { echo'class="active"'; } ?>><a href="index.php?action=bizes">Negócios</a></li>
                
				
              </ul>
			  
			  <?php if($login->UserLogged() == true){
						echo '
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Olá, <b>' . $_SESSION['u_name'] .' </b><span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="index.php?action=ucp"><span class="glyphicon glyphicon-wrench"></span> User CP</a></li>';
										if($login->UserIsAdmin()) echo "<li><a href='?admin'><span class='glyphicon glyphicon-cog'></span> Admin CP</a></li>";
						echo '
										<li><a href="?logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
									</ul>
								</li> 
							</ul>
							'
						;
					}
					else echo '<ul class="nav navbar-nav navbar-right">
								<li><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">Login</a></li>';?>
            </div>
			
          </div>
        </div>
      </div>
    </div>
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myLargeModalLabel">Login </h4>
        </div>
        <div class="modal-body">
          <?php ShowLoginModel(1); ?>
        </div>
    </div>
  </div>
</div>

    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class=""></li>
        <li class="active" data-target="#myCarousel" data-slide-to="1"></li>
        <li class="" data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
	  <div class="carousel-inner">
		<div class="item">
			<img src="http://i.imgur.com/5kpgM38.png"/>
			<div class="container">
            <div class="carousel-caption">
              <h1>Um evento de race!</h1>
              <p>Uma screencapture de um evento de Race que ocorreu no nosso servidor de SA:MP!</p>
            </div>
          </div>
        </div>

        <div class="item active">
          <img src="http://i.imgur.com/IbI4fmF.png" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Informações Tuga-Revolution</h1>
              <p>Aqui estam as informações sobre os ips dos servidores.</p>
              <p><a class="btn btn-sm btn-primary" href="#" role="button">Mais informações</a></p>
            </div>
          </div>
        </div>
		
		<div class="item">
			<img src="http://i.imgur.com/JqZ8Byp.jpg "/>
			<div class="container">
            <div class="carousel-caption">
              <h1>O nosso forum!</h1>
              <p>Visita o nosso forum lá vais encontrar todo o tipo de assuntos!</p>
			  <p><a class="btn btn-sm btn-primary" href="http://www.tuga-revolution.com/forum" role="button">Visitar forum</a></p>
            </div>
          </div>
        </div> 
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->

	<hr class="featurette-divider">

	<div class="container">
	<?php
			$actionArrays = array(
				'home' => array('sources/pages/ranking.php'),
				'login' => array('sources/pages/login.php'),
				'players' => array('sources/pages/players.php'),
				'ucp' => array('sources/pages/ucp.php'),
				'houses' => array ('sources/pages/houses.php'),
				'bizes' => array ('sources/pages/bizes.php'),
			);
			if (!isset($_REQUEST['action']) || !isset($actionArrays[$_REQUEST['action']]))
			{
				include('sources/pages/ranking.php');
			}
			else{
				include($actionArrays[$_REQUEST['action']][0]);
			}
	?>

	
      <hr class="featurette-divider">
	
      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href=""><span class="glyphicon glyphicon-chevron-up"></span>Back to top</a></p>
        <p><b style="color:#428BCA;">Gameserver v0.1b</b> © <b>Rui Almeida</b> 2015 </p>
      </footer>

    </div><!-- /.container -->


   
  

<div data-original-title="Copy to clipboard" title="" style="position: absolute; left: 0px; top: -9999px; width: 15px; height: 15px; z-index: 999999999;" class="global-zeroclipboard-container" id="global-zeroclipboard-html-bridge">      <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" id="global-zeroclipboard-flash-bridge" height="100%" width="100%">         <param name="movie" value="/assets/flash/ZeroClipboard.swf?noCache=1410878124400">         <param name="allowScriptAccess" value="sameDomain">         <param name="scale" value="exactfit">         <param name="loop" value="false">         <param name="menu" value="false">         <param name="quality" value="best">         <param name="bgcolor" value="#ffffff">         <param name="wmode" value="transparent">         <param name="flashvars" value="trustedOrigins=getbootstrap.com%2C%2F%2Fgetbootstrap.com%2Chttp%3A%2F%2Fgetbootstrap.com">         <embed src="/assets/flash/ZeroClipboard.swf?noCache=1410878124400" loop="false" menu="false" quality="best" bgcolor="#ffffff" name="global-zeroclipboard-flash-bridge" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="trustedOrigins=getbootstrap.com%2C%2F%2Fgetbootstrap.com%2Chttp%3A%2F%2Fgetbootstrap.com" scale="exactfit" height="100%" width="100%">                </object></div>
	
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
  </body>
</html>