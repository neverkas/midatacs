<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta charset="utf-8">
<title>Ember Starter Kit</title>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
</head>
<body>

  <script type="text/x-handlebars">
	<h2>Welcome to Ember.js</h2>

	{{outlet}}
  </script>

  <script type="text/x-handlebars" id="index">
	<ul>
	{{#each item in model}}
	  <li>{{item}}</li>
	{{/each}}
	</ul>
  </script>

  <script src="js/libs/jquery-1.9.1.js"></script>
  <script src="http://connect.facebook.net/en_US/all.js"></script>
  <script src="js/libs/handlebars-1.0.0-rc.4.js"></script>
  <script src="js/libs/ember-1.0.0-rc.5.js"></script>
  <script src="js/facebook.js"></script>
  <script src="js/application.js"></script>
<!-- <script type="text/javascript" src="http://www.sysgames.net/min/g=midatacs"></script> -->

</body>
</html>
