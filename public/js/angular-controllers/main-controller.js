webstoreApp.controller('MainController',  function($scope, $http, $route, $location, mainFactory) {
	$scope.Factory = mainFactory;
	$scope.main = {
		title: 'Web Store Categories',
		categoryId: (window.location.href).split('/').pop(),
		urlExploded: (window.location.href).split('/'),
		url: window.location.origin,
		linkTo: '/product/category/',
		getCategories: '/product/navigation/',
		get: '',
		categoryIsEmtpy: 'No have products',
		navLink: ''
	};
	$scope.loadCategories = function(){
		$http.get('/product/navigation/').success(function(data){
			mainFactory.setCategories(data);
		});
	};
	$scope.loadCategories();
});