App = Ember.Application.create();

App.Router.map(function() {
	this.resource('index', {path: '/'});
});

App.IndexRoute = Ember.Route.extend({
  model: function() {
    return ['red', 'yellow', 'blue'];
  }
});
App.IndexView = Ember.View.extend({
	didInsertElement: function(){
//		window.fbAsyncInit = function(){
//			FB.init({ appId: '398812390191860', channelUrl : 'http://www.sysgames.net/midatacs/channel.html', cookie: true, xfbml: true, oauth: true});
//			facebookLogin();
//		};
	}
});

/*

*/