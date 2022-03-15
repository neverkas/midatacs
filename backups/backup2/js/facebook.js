(function($){
	/*
		// Documentación de Facebook
		http://developers.facebook.com/docs/reference/javascript/FB.getLoginStatus/	
	*/

	/*
		// Crear plugin
		http://www.cristalab.com/tutoriales/crear-plugins-para-jquery-c251l/
		http://codigoprogramacion.com/cursos/javascript/como-hacer-un-plugin-de-jquery-basico.html#.UbfE__n-Gzw

		http://www.7sabores.com/blog/crear-un-plugin-jquery
		http://www.josemendezblog.com/2013/04/como-crear-un-plugin-con-jquery.html
	*/	

	$.fn.facebook = function(options){

	function init(){
		FB.init({ appId: '398812390191860', channelUrl : 'http://www.sysgames.net/midatacs/channel.html', cookie: true, xfbml: true, oauth: true});				
	}

	function login(){
		FB.login(function(response1){
			FB.getLoginStatus(function(response2){
				if(response2.status == 'connected'){
//					console.log(response2.authResponse.userID);		
					}
				}, true);			
		}, { scope: 'publish_stream, email, user_about_me, user_groups, user_likes, user_status, publish_actions'});		
	}

	function profile(){
		FB.getLoginStatus(function(response){
			if(response.status == 'connected'){
				uid = response.authResponse.userID;

				FB.api("/"+ uid, function(data){
					console.log('Conectado como: '+ data.name);
				});
			}
		}, true);					
	}

	function feed(){
		FB.getLoginStatus(function(response){
			if(response.status == 'connected'){
				uid = response.authResponse.userID;
				var accessToken = response.authResponse.accessToken;

				FB.api('/MiDataCs/feed', "get", function(get_data){
					document.body.appendChild(document.createTextNode(JSON.stringify(get_data.data)));
				});		

			}
		});
	}

	if(options == undefined){
		init();	
	}
	else{
		if(options.action == 'login') 	login();		
		if(options.action == 'profile') profile();
		if(options.action == 'feed') 	feed();
	}

	};
})(jQuery);

function facebook(action){
	(function($){
		$(document).ready(function(){
			$().facebook(action);
		});		
	})(jQuery);
}

facebook();
facebook({action: 'login'});
facebook({action: 'profile'});
facebook({action: 'feed'});