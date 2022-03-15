<?php
#chequea como arma la url la app de 5ya.com.ar, borrala de la parte app de fb, y agregala denuevo para poder ver la url cuando aparece el popup denuevo
#https://www.facebook.com/dialog/oauth?client_id=92222174958&redirect_uri=www.sysgames.net/fb&scope=publish_stream

/**
	Te falta hacer que solo puestan escribir si likearon la fanpage
	Fijate si podes hacer que si recien aceptan la aplicacion, que likee de forma automatica la fanpage
*/
require 'src/facebook.php';
$facebook = new Facebook(array(
#	'appId'  => '92222174958',
#	'secret' => 'f3fb83655a88813d55a8121cfce1c062',
	'appId'  => '398812390191860',
	'secret' => '07929532a19b4e73d1037b60b1544272',
));


$user = $facebook->getUser();
if ($user) {
	try {
#		$user_profile = $facebook->api('/me/likes/320413158025196');
		$user_profile = $facebook->api('/me/likes/320413158025196');
	} catch (FacebookApiException $e) {
	#	echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
		$user = null;
	}
}

$app_id 	= $facebook->getAppID();
$app_secret = $facebook->getApiSecret();
$app_token 	= $facebook->getAccessToken();

?>

<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta charset='utf-8'>
</head>
<body>
	<style>
	html,body,ul,li{ margin:0; padding:0; }
	body{ background:#232323; }
	ul,li{ list-style:none; }
	img{ border:none; }
	a{ text-decoration:none; }
	.clear{ clear:both; }
	.align_left{ float:left; }
	.align_right{ float:right; }
	.text_style_yellow{ color:#e6b300; }
	.text_style_blue{ color:#0062b5; }
	.text_style_red{ color:#b70000; }
	.text-align-left{ text-align:left; }

	#template{ display:none; }
	#app{
	    margin: 0 auto;
	    padding-top:20px;
	    padding-bottom:15px;
	    width: 730px;
	    background-color: #FFFFFF;
	    box-shadow: 0 0 10px #CCCCCC;
	}
	#app #publish{
	    background-color: #FFFFFF;
	    border: 1px solid #666;
	    border-radius: 5px 5px 5px 5px;
	    margin: 0 auto;
	    padding: 15px;
	    width: 430px;

background-image: linear-gradient(bottom, rgb(214,242,255) 10%, rgb(237,249,255) 64%, rgb(255,255,255) 82%);
background-image: -o-linear-gradient(bottom, rgb(214,242,255) 10%, rgb(237,249,255) 64%, rgb(255,255,255) 82%);
background-image: -moz-linear-gradient(bottom, rgb(214,242,255) 10%, rgb(237,249,255) 64%, rgb(255,255,255) 82%);
background-image: -webkit-linear-gradient(bottom, rgb(214,242,255) 10%, rgb(237,249,255) 64%, rgb(255,255,255) 82%);
background-image: -ms-linear-gradient(bottom, rgb(214,242,255) 10%, rgb(237,249,255) 64%, rgb(255,255,255) 82%);

background-image: -webkit-gradient(
	linear,
	left bottom,
	left top,
	color-stop(0.1, rgb(214,242,255)),
	color-stop(0.64, rgb(237,249,255)),
	color-stop(0.82, rgb(255,255,255))
);
	}
		#block{
			margin:auto;
			width:100%;
		}
		#publish #title{
			text-align:center;
			font-family:'Tahoma';
			font-size:1.5em;
		}
		#publish #content{
		}
		#publish #message{
		    background-color: #FFFFFF;
		    border: 1px solid #666666;
		    border-radius: 5px 5px 5px 5px;
		    color: #222222;
		    height: 45px;
		    margin: auto;
		    width: 350px;
		}
		#publish #send{
			cursor:pointer;
			margin-left:5px;
			width:70px;
			height:45px;
			line-height:45px;
			background-color:#3065c7;
			border-radius:5px;
			text-align:center;
			font-family:'Trebuchet MS';
			font-size:0.9em;
			color:#fff;
		}

	#app #content{ width:650px; margin:auto; }

/* THEME FIELDS #START */
#theme-colors{ margin:10px; }
.theme_fields{ display:block; width:25px; height:25px; float:left; border-radius:5px; border: solid 1px #222; margin-right:1px; text-align:center; }
.theme_fields input{ visibility: hidden; }
.theme_field_blue{ background-color:#cde8ff; }
.theme_field_bluedark{ background-color:#c4dafe; }
.theme_field_red{ background-color:#ffcdcd; }
.theme_field_green{ background-color:#d4ffcd; }
.theme_field_orange{ background-color:#fff3cd; }
.theme_field_purple{ background-color:#e5cdff; }
/* THEME FIELDS #END */

/* THEME STYLES LIGHT #START */
.themeBlue_block{ background-color:#f0f8ff; border: solid 1px #cde8ff; }
.themeBlue_text1{ color:#0062b5; }
.themeBlue_text2{ color:#222; }

.themeBlueDark_block{ background-color:#c4dafe; border: solid 1px #81b0ff; }
.themeBlueDark_text1{ color:#0062b5; }
.themeBlueDark_text2{ color:#222; }

.themeRed_block{ background-color:#fff0f0; border: solid 1px #ffcdcd; }
.themeRed_text1{ color:#b50000; }
.themeRed_text2{ color:#222; }

.themeGreen_block{ background-color:#f2fff0; border: solid 1px #d4ffcd; }
.themeGreen_text1{ color:#1eb500; }
.themeGreen_text2{ color:#222; }

.themeOrange_block{ background-color:#fff6dc; border: solid 1px #fff3cd; }
.themeOrange_text1{ color:#db7700; }
.themeOrange_text2{ color:#222; }

.themePurple_block{ background-color:#fffbf0; border: solid 1px #e6cdff; }
.themePurple_text1{ color:#6c00db; }
.themePurple_text2{ color:#222; }

/* THEME STYLES LIGHT #END */

#block-liked{
	display:none;
	z-index:999999;
	position:absolute;
	top:50%;
	left:50%;
	margin-left:-220px;
	margin-top:-90px;
	width:440px;
	height:180px;
	background:url(http://www.sysgames.net/images/liked.png) no-repeat center center transparent;
}
	#liked-hide{
		cursor:pointer;
	    bottom: 10px;
	    left: 170px;
	    padding: 3px 0;
	    width: 105px;
	    background: none repeat scroll 0 0 #111111;
	    border: 2px solid #666666;
	    border-radius: 5px 5px 5px 5px;
	    color: #FFFFFF;
	    font-family: 'Verdana';
	    font-size: 0.9em;
	    font-weight: 600;
	    letter-spacing: 1px;
	    position: absolute;
	    text-align: center;
	}

.data_stream{ width:99%; margin:0 auto 10px; padding:5px; border-radius:10px; }
.data_picture{ margin-right:5px; width:50px; }
.data_picture img{ margin:auto; border-radius:5px; }
.data_stream_info{ width:90%; }
.data_top{ height:25px; line-height:25px; margin-bottom:3px; }
.data_middle{ min-height:30px; width:100%; }
.data_bottom{ margin-top:5px; height:25px; line-height:25px; width:100%; border-top: solid 1px #ccc; border-radius:12px 12px 0 0; text-indent:10px; background-color:#fff; }
	</style>
	<div style="position:absolute; top:0; left:0;" data-font="arial" data-show-faces="false" data-width="120" data-layout="button_count" data-send="false" data-href="http://www.facebook.com/SysGamesRadio" class="fb-like" fb-xfbml-state="rendered"></div>
	<div id="block-liked">
		<div id="liked-hide">OCULTAR</div>
	</div>

	<div id="app">
		<div id="publish">
			<div>
				<div style="width:80%; text-align:center; display:none;">
					<span id="title">POSTEAR EN EL MURO</span>
				</div>
				<div>
					<div class="align_left" style="width:350px;">
						<textarea id="message"></textarea>
					</div>
					<div id="send" class="align_left">Enviar</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>

		<div id="theme-colors">
			<label class="theme_fields theme_field_bluedark">
				<input type="radio" name="theme_color" value="BlueDark" />
			</label>
			<label class="theme_fields theme_field_blue">
				<input type="radio" name="theme_color" value="Blue" />
			</label>
			<label class="theme_fields theme_field_red">
				<input type="radio" name="theme_color" value="Red" />
			</label>
			<label class="theme_fields theme_field_green">
				<input type="radio" name="theme_color" value="Green" />
			</label>
			<label class="theme_fields theme_field_orange">
				<input type="radio" name="theme_color" value="Orange" />
			</label>
			<label class="theme_fields theme_field_purple">
				<input type="radio" name="theme_color" value="Purple" />
			</label>
			<div class='clear'></div>
		<input type="hidden" id="theme_color_old" value="Blue" />
		</div>

		<div id="content"></div>
		<div id="template" class="theme_block data_stream">
			<div class="data_picture align_left">
				<img src="" />
			</div>
			<div class="data_stream_info align_left">
				<div class="data_top">
					<div class="align_left ">
						<a class="theme_text1 data_name" href="#"></a>
						<span class='data_datetime'>
							<span class='theme_text1'></span>
							<input type='hidden' class='' value=''>
						</span>
					</div>
					<div class="align_right">
						<a class="theme_text1 data_link_comments" href="#"></a>
					</div>
					<div class="clear"></div>
				</div>
				<div class="data_middle">
					<span class="theme_text2 data_message"></span>
				</div>
			</div>
			<div class="clear"></div>
			<div class="data_bottom">
				<span class="theme_text2 data_extra"></span>
			</div>	
		</div>
	</div>
<?php
/*
$signed_request = $facebook->getSignedRequest();
$like_status = $signed_request["page"]["liked"];
*/
/*
Para Obtener el Access Token
Debes reemplazar el client_id y client_secret por el de la app que necesites,
esto es para obtener datos del muro de la pagina.

https://graph.facebook.com/oauth/access_token?client_id=92222174958&client_secret=f3fb83655a88813d55a8121cfce1c062&grant_type=client_credentials
*/
?>
	<div id="fb-root"></div>
	<script>
	window.fbAsyncInit = function(){
		FB.init({ appId: '<?php echo $app_id; ?>', cookie: true, xfbml: true, oauth: true});
		getFeed();
		setInterval("getFeed()", 5000);
		facebookLoaded();
		//facebookLogin();
	};

	(function() {
	var e = document.createElement('script');
	e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
	e.async = true;
	document.getElementById('fb-root').appendChild(e);
	}());
	</script>
	<!-- <script async="" src="http://www.sysgames.net/fb/all.js"></script> -->
	<script type="text/javascript" src="xdate.js"></script>
	<script>
	window.adCount 				= 0;
	window.adCountForPublish 	= 5;

	window.gameinfo 	= true;
	window.spam 		= true;
	window.filterwords 	= ['.com', '.net', '.tk'];
	window.limit 		= 10;
	window.fechas 		= null;
	window.prevlist 	= new Array();
	window.admsg		= 'MiDataCs.com la mejor manera de pedir data..! http://www.facebook.com/MiDataCs';

	window.sendingMessage = "Enviando mensaje...";
	window.successMessage = "Enviado correctamente! Espera cinco segundos antes de postear de vuelta.";

	function postToPage(user_id, msg) {
		var args = {
			message: msg, // msg
			link: 'http://www.facebook.com/MiDataCs',
			name: 'MiDataCs.com',
			description: 'Disfruta mejor tus horas de juego con nosotros',
			picture: 'http://www.demo.lookmywebpage.com/publish-on-facebook-wall/Google-Twitter-Facebook.jpg',
		};

		FB.api("/"+user_id+"/feed", "post", args, function (a) {
			alert('enviadooo')
			//if (typeof a.id != "undefined" && a.id != null) { checkApproval(a.id);  }
		});
	}

	function facebookLogin(){
		FB.login(function(response){
			if(response.status=='connected'){
				checkLike('252565641532717');
//				postToPage('464462326903399', getmessage());
//				postToPage('76145712316', window.admsg);
			}
		}, { scope: 'publish_stream' });
	}

	function checkLike(user_id){
		FB.api('/me/likes/' + user_id, function(response){
			if(response.data){
				console.log(response);				
				if(isObjectEmpty(response.data)){
					adLikedOn();
				}
			}
		});
	}

	function isObjectEmpty(getObject){
		for(var getProperty in getObject){
			if(getObject.hasOwnProperty(getProperty)) return false;
		}
		return true;
	}



	function getFeed(){	
		var args = {access_token: "92222174958|kSlY5xEyzwSzSPu24111lJ_a10A", since: '1347074580', limit: '25'};
		FB.api('/LocalStrikeGameServers/feed', "get", args, function(get_data){
//		FB.api('/SysGamesRadio/feed', "get", args, function(get_data){
			data = get_data.data;
			delta =compare(data, window.prevlist);

			for (i = (delta - 1); i >= 0; i--) {
				addRow(get_data.data[i]);							
				window.adCount++;
				if(window.adCount == window.adCountForPublish){
					get_time_last = data[0].created_time;
					addAd('SysGames', 'Comunidad SysGames', 'Servidores alojados en LocalStrike, Radio Online con DJs propios, y mucho más..!', 'www.SysGames.net' ,get_time_last);
					window.adCount = 0;
				}

				removeRows();			
			}
			window.prevlist = data;
		});
		//updateDate();
	}


	function timeago(date){
		today 	 = new XDate();
		datetime = new XDate(date);
		diff_time = window.diff_time;
		diff_seconds	 = datetime.diffSeconds(today);
		diff_minutes	 = datetime.diffMinutes(today);
		diff_hours		 = datetime.diffHours(today);
		diff_days		 = datetime.diffDays(today);
		diff_weeks		 = datetime.diffWeeks(today);
		diff_months		 = datetime.diffMonths(today);

			if(diff_seconds < 60 ){
				if(diff_seconds < 1){
					diff_time = '1 segundo';
				}else{
					diff_time = Math.round(diff_seconds) + ' segundos';				
				}
			}
			else if(diff_minutes >= 1 ){
				if(diff_minutes < 2){
					diff_time = '1 minuto';
				}else{
					diff_time = Math.round(diff_minutes) + ' minutos';				
				}
			}
			else if(diff_hours >= 1 ){
				if(diff_hours < 2){
					diff_time = '1 hora';				
				}else{
					diff_time = diff_hours + ' horas';				
				}
			}
			else if(diff_days >= 1){
				if(diff_days < 2){
					diff_time = '1 dia';
				}else{
					diff_time = diff_days + ' dias';				
				}
			}
			else if(diff_weeks >= 1){
				if(diff_weeks < 1){
					diff_time = '1 semana';
				}else{
					diff_time = diff_weeks + ' semanas';				
				}
			}
			else if(diff_months >= 1){
				if(diff_months < 2){
					diff_time = '1 mes';				
				}else{
					diff_time = diff_months + ' meses';				
				}
			}
		return diff_time;
	}
 
	function compare(a, b) {
		if(b[0] != null){
			for(i=0; i<a.length;i++){
//				if(a[i].from.id == b[0].from.id) return i;
				if(a[i].id == b[0].id) return i;
			}
		}

		return 25;
	}

</script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
	function facebookLoaded(){
		$("#send").click(function(){ facebookLogin(); });
	}
	function updateDate(){
		$(".data_datetime").each(function(){
			datetime 		= $(this).children('input').val();
			datetime_parse 	= timeago(datetime);
			$(this).children('span').text(datetime_parse);
		});
	}

	function removeRows(){		
		if(getRows().length > window.limit){
			for(z = 0; z <= (getRows().length - window.limit); z++){
				getRows().last().remove();				
			}
		}
	}
	function getRows(){
		return $("#app > #content .data_stream").not("div[name='template']");		
	}

	function addAd(user_id, name, description, web_url, get_time_last){
		var template = $("#template").clone();
		template.removeAttr('id');

		picture 		= 'https://graph.facebook.com/'+ user_id +'/picture';
		profile_link 	= 'http://www.facebook.com/'+ user_id;
		web_link 		= '<a href="'+web_url+'" target="_blank">'+ web_url +'</a>';
		
		datetime_text 	= get_time_last;
		datetime_parse 	= timeago(datetime_text);

		$(".data_name", template).text(name);
		$(".data_name", template).css('font-weight', 600);
		$(".data_name", template).attr('href', profile_link);
		$(".data_message", template).text(description);
		$(".data_picture > a", template).attr('href', profile_link);
		$(".data_picture > img", template).attr('src', picture);

		$(".data_datetime > input", template).val(datetime_text);
		$(".data_datetime > span", template).text(datetime_parse);

		$(".data_extra", template).html(web_link);
		
		addRowAnimate(template);
	}

	function addRow(get_data){
		var template = $("#template").clone();
		template.removeAttr('id');

		id 				= get_data.from.id;
		name 			= get_data.from.name;
		picture 		= 'https://graph.facebook.com/'+id+'/picture';
		profile_link 	= 'http://www.facebook.com/' + id;
		message  		= parseString(get_data.message);
		message_link 	= 'http://www.facebook.com/messages/' + get_data.from.id;
		message_text 	= message.substr(0, 65);

		game_connect 	= null;
		game_address 	= getGameAddress(message);
		game_password 	= getGamePassword(message);

		datetime_text 	= get_data.created_time;
		datetime_parse 	= timeago(datetime_text);
		comments_text 	= get_data.comments.count;

		$(".data_name", template).text(name);
		$(".data_name", template).attr('href', profile_link);
		$(".data_picture > a", template).attr('href', profile_link);
		$(".data_picture > img", template).attr('src', picture);

		$(".data_datetime > input", template).val(datetime_text);
		$(".data_datetime > span", template).text(datetime_parse);

		$(".data_link_comments > a", template).text(comments_text);
		$(".data_message", template).text(message_text);
		
		if(game_address  != null) game_connect = 'connect '+ game_address;
		if(game_password != null) game_connect +='; password '+ game_password;

		if(window.gameinfo == true && game_connect != null){
			$(".data_extra", template).text(game_connect);
		}
		else{
			$(".data_bottom", template).remove();
		}

		if((window.spam == false) && (filterSpam(message_text) == true)) return;
		addRowAnimate(template);
	}
	
	function filterSpam(message){
		words = window.filterwords;
		for(n=0; n < words.length; n++){
			if(message.indexOf(words[n]) != -1) return true;
		}
		
	}

	function getGameAddress(message){
		pattern = /(\d{2,3}\.\d{2,3}\.\d{2,3}\.\d{2,3}\:\d{5})/;
		check 	= pattern.exec(message);
		if(check != null) return check[0];
		return null;
	}	

	function getGamePassword(message){
		pattern = /(password|pw|pass)\s*\:?\s*([\w]*)/;
		check   = pattern.exec(message);
		if(check != null) return check[2];
		return null;
	}


	function parseString(message){
		message = message.replace(/(\n\r|\r\n)/gm, '');
		message = message.replace(/\s+/g, ' ');
		return message;
	}

	function getmessage(){
		return $("#message").val();
	}

	function addRowAnimate(get_data){
		get_data.css('visibility', 'hidden');
		$("#app > #content").prepend(get_data);

		get_data.slideDown(1200, function(){
			$(this).css('visibility', 'visible');
			$(this).css('display', 'none');
			$(this).fadeIn(700);
		});
	}

	function adLikedOn(){
		$('#block-liked').fadeIn(0);
	}
	function adLikedOff(){
		$('#block-liked').fadeOut(0);
	}
	$("#liked-hide").click(function(){
		adLikedOff();
	});

	function customTheme(){
		$('.theme_fields').click(function(){
			color_new = $(this).children('input');
			color_old = $("#theme_color_old");
			theme_new = color_new.val();
			theme_old = color_old.val();

			removeTheme(theme_old);
			setTheme(theme_new);

			color_old.val(color_new.val());
		});
	}

	function setTheme(get_color){
		theme = 'theme'+get_color;
		$(".theme_block").addClass(theme+'_block');
		$(".theme_text1").addClass(theme+'_text1');
		$(".theme_text2").addClass(theme+'_text2');		
	}
	function removeTheme(get_color){		
		theme = 'theme'+get_color;
		$(".theme_block").removeClass(theme+'_block');
		$(".theme_text1").removeClass(theme+'_text1');
		$(".theme_text2").removeClass(theme+'_text2');		
	}

	customTheme();
	setTheme('Blue');
	</script>	
</body>
</html>