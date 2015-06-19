webstoreApp.controller('SidebarCategories', ['$scope', '$http', 'mainFactory', function($scope, $http, mainFactory) {
	$scope.main = {
		urlExploded: (window.location.href).split('/'),
		url: window.location.origin,
		linkTo: '/category/',
		getCategories: '/category/getCategories',
	};
	$scope.Factory = mainFactory;
	$http.get('/category/getCategories').success(function(data){
		mainFactory.setCategories(data);
	});
}]);