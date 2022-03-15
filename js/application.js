App = Ember.Application.create();

App.Store = DS.Store.extend({
	revision:13,
	adapter: DS.RESTAdapter.create({
		bulkCommit: true, 
		url: 'http://sysgames.net/midatacs/api'
	}),
});

/*
*	Model
*/
App.Post = DS.Model.extend({
	message: DS.attr('string'),
});

/*
* 	Controller
*/
App.PostsController = Ember.ArrayController.create({
	content: [],
});


/*
* 	Route
*/
App.IndexRoute = Ember.Route.extend({
	deserialize: function(){
		App.set('PostsController.content', App.Post.find());

		setInterval(function(){
			App.postController = App.Post.find();
			App.set('PostsController.content', App.postController);
		}, 1500);
	}
});


/*
* 	View
*/
App.IndexView = Ember.View.extend({
});

App.PostView = Ember.View.extend({
	templateName: 'post',
	tagName:'li'
});

