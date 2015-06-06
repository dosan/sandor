'use strict';
console.log(window.location);


webstoreApp.controller('CategoriesProducts', ['$scope', '$http','$route', '$routeParams', '$location', function($scope, $http, $route, $routeParams, $location) {
	$scope.main = {
		title: 'Web Store Categories',
		categoryId: (window.location.href).split('/').pop(),
		urlExploded: (window.location.href).split('/'),
		url: window.location.origin,
		linkTo: '/category/',
		getCategories: '/category/getCategories',
		httpGet: '/category/getCategoriesWithProducts/',
		get: '',
		categoryIsEmtpy: 'No have products'
	};
	if (!isNaN($scope.main.categoryId)) {
		$scope.main.get = $scope.main.httpGet + $scope.main.categoryId;
	};

	$scope.setCategory = function(category_id = ''){
		console.log($scope.main.urlExploded);
		$scope.main.get = $scope.main.httpGet + category_id;
		$scope.loadPage();
	}
	$scope.loadCategories = function(){
		$http.get($scope.main.getCategories).success(function(data){
			$scope.categories = data;
		});
	};
	$scope.loadPage = function() {
		$http.get($scope.main.get).success(function(data){
			$scope.categoriesWithProducts = data;
		});
	};
	if ($scope.main.urlExploded[3] == 'category') {
		$scope.loadPage();
	};
	$scope.loadCategories();
}]);

