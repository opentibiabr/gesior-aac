<?php

if (!session_id()) @session_start();

$last = NULL;
if (!isset($_SESSION)) {
	$_SESSION = [];
}

if (isset($_SESSION['server_status_last_check'])) {
	$last = $_SESSION['server_status_last_check'];
}
if ($last == NULL || time() > $last + 30) {
	$_SESSION['server_status_last_check'] = time();
	$_SESSION['server_status'] = $config['status']['serverStatus_online'];
}

$infobar = Website::getWebsiteConfig()->getValue('info_bar_active');

if ($_SESSION['server_status'] == 1) {
	$qtd_players_online = $SQL->query("SELECT count(*) as total from `players_online`")->fetch();
	if ($qtd_players_online["total"] == "1") {
		$players_online = ($infobar ? $qtd_players_online["total"] . ' Player Online' : $qtd_players_online["total"] . '<br/>Player Online');
	} else {
		$players_online = ($infobar ? $qtd_players_online["total"] . ' Players Online' : $qtd_players_online["total"] . '<br/>Players Online');
	}
} else {
	$players_online = ($infobar ? 'Server Offline' : 'Server<br/>Offline');
}

$query = $SQL->prepare("SELECT * FROM newsticker ORDER BY id DESC LIMIT " . Website::getWebsiteConfig()->getValue('landpage_max_notices'));
$query->execute();
$noticias = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
	<title><?= $config['server']['serverName']; ?></title>

	<!-- CSS  -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="./materialize/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
	<link href="./materialize/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
	<link href="bg_img.css?vs=4" type="text/css" rel="stylesheet" media="screen,projection" />
</head>

<body>
	<div class="bg"></div>
	<div>
		<div class="bgwhitetransp">
			<nav class="bg-black-transp" role="navigation">
				<div class="nav-wrapper container">
					<ul class="left hide-on-med-and-down">
						<li><a href="./?subtopic=worlds"><?= $players_online ?></a></li>
					</ul>
					<ul class="center">
						<li>
							<a id="logo-container" href="#" class="brand-logo center">
								<img src="./images/logos/logo-artwork.png" />
							</a>
						</li>
					</ul>
					<ul class="right">
						<li><a class="" href="./">Ir para o site</a></li>
					</ul>
				</div>
			</nav>

			<div class="bgwhitetransp">
				<div class="container">
					<br /><br />
					<div class="section">
						<div class="row">
							<form class="col s12 m5" action="./?subtopic=createaccount" method="post">
								<h5 class="center white-text">Criar account</h5>
								<div class="row" style="margin-top: -15px !important;">
									<div class="input-field s12">
										<input required id="accountname" name="accountname" type="text" class="white-text">
										<label for="accountname">Account Name</label>
									</div>
								</div>
								<div class="row" style="margin-top: -15px !important;">
									<div class="input-field s12">
										<input required id="email" name="email" type="email" class="white-text">
										<label for="email">Email</label>
									</div>
								</div>
								<div class="row" style="margin-top: -15px !important;">
									<div class="input-field s12">
										<input required id="password1" name="password1" type="password" class="white-text">
										<label for="password1">Password</label>
									</div>
								</div>
								<div class="row" style="margin-top: -15px !important;">
									<div class="input-field s12">
										<input required id="password2" name="password2" type="password" class="white-text">
										<label for="password2">Repita o password</label>
									</div>
								</div>
								<div class="row" style="margin-top: -15px !important;">
									<div class="input-field s12">
										<input disabled value="<?= $config['server']['serverName']; ?>" id="disabled" type="text" class="validate">
										<label for="disabled">World</label>
									</div>
								</div>
								<p style="margin-top: -15px !important;">
									<label>
										<input required type="checkbox" id="agreeagreements" name="agreeagreements" value="true" class="filled-in" checked="checked" />
										<span>Concordo com as <a href="./?subtopic=tibiarules">regras</a></span>
									</label>
								</p>
								<input type="hidden" value="docreate" id="docreate" name="step" />
								<div class="row center">
									<div class="input-field s12">
										<input value="Cadastrar" type="submit" class="validate btn-primary" />
									</div>
								</div>
							</form>
							<div class="col s12 m6 offset-m1" style="margin-top: 100px;">
								<!--<iframe width="<?= (560 / 1.47) ?>" height="<?= (315 / 1.47) ?>"-->
								<div class="fluid-width-video-wrapper" style="padding-top: 56.25%;">
									<iframe src="https://www.youtube.com/embed/<?= Website::getWebsiteConfig()->getValue('landpage_youtube') ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
									</iframe>
								</div>
								<div class="carousel carousel-slider">
									<?php foreach ($noticias as $noticia) { ?>
										<div class="carousel-item icon-block" href="#<?= $noticia['id'] ?>!">
											<h5 class="center white-text">Notícia <?= $noticia['id'] ?></h5>
											<p class="light center white-text"><?= $noticia['text'] ?></p>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-black-transp">
			<div style="padding: 50px">
				<div class="center">
					<a href="./?subtopic=downloadclient" id="download-button" class="btn-primary">Fazer Download</a>
				</div>
			</div>
		</div>
	</div>




	<!--  Scripts-->
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="./materialize/js/materialize.js"></script>
	<script src="./materialize/js/init.js"></script>
	<script>
		$(document).ready(function() {
			$('.carousel.carousel-slider').carousel({
				fullWidth: true,
				indicators: true
			});
			$('.carousel.carousel-slider').height(250);
			$('.materialboxed').materialbox();
			$(document).ready(function() {
				$('.modal').modal();
			});
		});
	</script>

</body>

</html>