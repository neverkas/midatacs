(function($){

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

	function feed(xData){
		FB.getLoginStatus(function(response){
			if(response.status == 'connected'){
				uid = response.authResponse.userID;

				var accessToken = response.authResponse.accessToken;
				
				localStorage.getObject('feed');

				FB.api('/MiDataCs/feed', "get", function(get_data){
					localStorage.setObject('feed', JSON.stringify(get_data.data));
//					xData.push(get_data.data);
//					xData.push(JSON.stringify(get_data.data));
//					document.body.appendChild(document.createTextNode(JSON.stringify(get_data.data)));
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
		if(options.action == 'feed') 	feed([]);
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

//facebook();
//facebook({action: 'login'});
//facebook({action: 'profile'});
