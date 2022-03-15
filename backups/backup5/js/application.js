App = Ember.Application.create();

App.Router.map(function() {
	this.resource('index', {path: '/'});
	this.route('noticias', {path: 'noticias'});
	this.route('team', {path: 'team'});
	this.route('sponsor', {path: 'sponsor'});
});

App.Navbar = Ember.View.extend({
	templateName: 'navbar',
});

App.PublicacionesController = Ember.ArrayController.extend({
	publicaciones: [],
	lista: function(){
		this.set('publicaciones', JSON.stringify(localStorage.getObject('feed')));
	}
});

App.IndexView = Ember.View.extend({
	texto: '',

	publicar: function(){

	},
	didInsertElement: function(){
		facebook();
		facebook({action: 'login'});
		facebook({action: 'feed'});
	}
});

/*

*/