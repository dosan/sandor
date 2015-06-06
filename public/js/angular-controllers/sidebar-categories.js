'use strict';

webstoreApp.controller('SidebarCategories', ['$scope', '$http', function($scope, $http) {
	$scope.main = {
		urlExploded: (window.location.href).split('/'),
		url: window.location.origin,
		linkTo: '/category/',
		getCategories: '/category/getCategories',
	};
	$scope.loadCategories = function(){
		$http.get($scope.main.getCategories).success(function(data){
			$scope.categories = data;
		});
	};
	$scope.loadCategories();
}]);

