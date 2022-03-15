<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta charset="utf-8">
<title>MiDataCs.com - Consegui data facil</title>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
</head>
<body>

<script type="text/x-handlebars">
<div class="span12">
	<div class="container">
		{{view App.Navbar}}

		{{outlet}}
	</div>
</div>
</script>

<script type="text/x-handlebars" id="navbar">
<div class="navbar navbar-static-top">
	<div class="navbar-inner">
		<ul class="nav">
			<li class="active">
				{{#linkTo "index"}}Inicio{{/linkTo}}
			</li>
			<li>
				{{#linkTo "noticias"}}Noticias{{/linkTo}}
			</li>
			<li>  
				{{#linkTo "team"}}Team{{/linkTo}}
			</li>
			<li>
				{{#linkTo "sponsor"}}Sponsor{{/linkTo}}
			</li>
		</ul>
	</div>
</div>
</script>

<script type="text/x-handlebars" id="index">
	{{#each App.PublicacionesController}}
	{{/each}}

	{{view Ember.TextArea valueBinding="view.texto"}}
	<button class="btn btn-primary">Enviar</button>
</script>
<script src="js/libs/jquery-1.9.1.js"></script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script src="js/libs/handlebars-1.0.0-rc.4.js"></script>
<script src="js/libs/ember-1.0.0-rc.5.js"></script>
<script src="js/libs/prototype.js"></script>
<script>
Storage.prototype.setObject = function(key, value) {
    this.setItem(key, JSON.stringify(value));
}
 
Storage.prototype.getObject = function(key) {
    var value = this.getItem(key);
    return value && JSON.parse(value);
}
</script>
<script src="js/plugins/facebook.js"></script>
<script src="js/application.js"></script>
<!--
<script type="text/javascript" src="http://www.sysgames.net/min/g=midatacs"></script>
-->
</body>
</html>
