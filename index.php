<!DOCTYPE html>
<html lang="pr-br">
<head>
	<meta charset="UTF-8">
	
	<title>Home</title>
	
	<link type="text/css" rel="stylesheet" href="_assets/_css/materialize.min.css"  media="screen,projection"/>
	<link type="text/css" rel="stylesheet" href="_assets/_css/style.css"  media="screen,projection"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="_assets/_css/codemirror.css">
	<link rel="stylesheet" type="text/css" href="_assets/_css/show-hint.css">
	<link rel="stylesheet" href="_assets/_css/theme/dracula.css">

	<script src="http://codemirror.net/lib/codemirror.js"></script>
	<script src="_assets/_js/script.js"></script>
	<script src="_assets/_js/show-hint.js"></script>
	<script src="_assets/_js/addon/search/search.js"></script>
	<script src="_assets/_js/addon/search/searchcursor.js"></script>
	<script src="_assets/_js/addon/dialog/dialog.js"></script>
	<script src="_assets/_js/addon/comment/comment.js"></script>
	<script src="_assets/_js/addon/wrap/hardwrap.js"></script>
	<script src="_assets/_js/addon/edit/closebrackets.js"></script>
	<script src="_assets/_js/addon/selection/active-line.js"></script>
	<script src="_assets/_js/addon/edit/matchbrackets.js"></script>
	<script src="_assets/_js/keymap/sublime.js"></script>
	<script src="_assets/_js/_mode/clike/clike.js"></script>
	<script src="_assets/_js/_mode/python/python.js"></script>
	<script src="_assets/_js/_mode/ruby/ruby.js"></script>
	<script src="_assets/_js/_mode/css/css.js"></script>
</head>
<body onload="init();">
	<?php require_once "_includes/connection.php"; ?>
	<?php $COD = $_GET["cod_arc"]; ?>
	<?php
		$data = [];
		$result = mysqli_query($connection,'SELECT * FROM archive WHERE archive_cod = '.$COD);
		while ($row = mysqli_fetch_array($result,2)){
			$data[] = array("cod" => $row[0], "name" => $row[1]);
		}
	?>
	<headar>
		<nav class="grey darken-4">
			<div class="nav-wrapper">
				<a href="#" class="brand-logo center">Code Bits</a>
				<ul id="nav-mobile" class="right hide-on-med-and-down"">
					<li>
						<a href="archives.php">Arquivos</a>
					</li>
				</ul>
			</div>
		</nav>
	</headar>
	<main class="grey lighten-3">
		<div class="container grey lighten-3">
			<div class="row blue-grey">
				<div class="col s12">
					<div class="input-field col s3">
						<?php if($COD == NULL){ ?>
							<input id="arq_name" type="text" onkeyup="identify_language();">
							<label for="arq_name">Nome do Arquivo</label>
						<?php }else{ ?>
							<input id="arq_name" value=<?php echo($data[0]["name"]); ?> type="text" onkeyup="identify_language();">
							<label for="arq_name">Nome do Arquivo</label>
						<?php } ?>
					</div>
					<div class="input-field col s9">
						<a class="btn">SALVAR</a>
					</div>
				</div>
				<div id="block" class="col s12 blue-grey lighten-2 block">
					<?php if($COD == NULL){ ?>
						<textarea id="code"></textarea>
					<?php }else{ ?>
						<?php $fp = fopen("_files/".$data[0]['name'], "r"); ?>
						<textarea id="code"><?php while(!feof($fp)) { $row = fgets($fp, 4096); echo $row; } ?> </textarea>
						<?php fclose($fp); ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</main>
    
	<footer class="page-footer grey darken-4">
		<div class="container">
		</div>
		<div class="footer-copyright">
			<div class="container">
				© CarlosCuzik
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="_assets/_js/materialize.min.js"></script>
</body>
</html>