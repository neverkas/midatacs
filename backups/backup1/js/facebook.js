(function($){
	$.fn.facebook = function(){
	    return this.each(
	        $.fn.feed = function(){
				var args = {access_token: "92222174958|kSlY5xEyzwSzSPu24111lJ_a10A", since: '1347074580', limit: '25'};
				FB.api('/MiDataCs/feed', "get", args, function(get_data){
					document.body.appendChild(document.createTextNode(JSON.stringify(get_data.data)));
				});
	        }
	    );
	};
})(jQuery);

/*
	http://www.cristalab.com/tutoriales/crear-plugins-para-jquery-c251l/
	http://codigoprogramacion.com/cursos/javascript/como-hacer-un-plugin-de-jquery-basico.html#.UbfE__n-Gzw

	http://www.7sabores.com/blog/crear-un-plugin-jquery
	http://www.josemendezblog.com/2013/04/como-crear-un-plugin-con-jquery.html
*/
(function($){
$(document).ready(function(){
//	$().facebook('posteando');
	$().facebook().feed();
});


})(jQuery);

function isObjectEmpty(getObject){
	for(var getProperty in getObject){
		if(getObject.hasOwnProperty(getProperty)) return false;
	}
	return true;
}

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
		if(response.status == 'connected'){
			checkLike('252565641532717');
			window.logged = true;
		}
	}, { scope: 'publish_stream' });
}

function checkLike(user_id){
	FB.api('/me/likes/' + user_id, function(response){
		if(response.data){
			if(isObjectEmpty(response.data)){
				console.log('agregar anuncio');
			}
		}
	});
}

function getFeed(){
	var args = {access_token: "92222174958|kSlY5xEyzwSzSPu24111lJ_a10A", since: '1347074580', limit: '25'};
	FB.api('/MiDataCs/feed', "get", args, function(get_data){
		document.body.appendChild(document.createTextNode(JSON.stringify(get_data.data)));
	});
}

/*
$(document).ready(function(){
	window.fbAsyncInit = function(){
		FB.init({ appId: '398812390191860', channelUrl : 'http://www.sysgames.net/midatacs/channel.html', cookie: true, xfbml: true, oauth: true});
		facebookLogin();
	};

	$(document).on("click", function(){
		getFeed();		
	});

});
*/