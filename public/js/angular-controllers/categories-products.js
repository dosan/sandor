'use strict';
console.log(window.location);

webstoreApp.controller('CategoriesProducts', ['$scope', '$rootScope', '$http','$route', '$routeParams', '$location', '$window', 'mainFactory', 'productModal', function($scope, $rootScope, $http, $route, $routeParams, $location, $window, mainFactory, productModal) {

	$scope.animationsEnabled = true;
	$scope.Factory = mainFactory;
	$scope.Modal = productModal;

	/*********** To back button(history)************/
	$rootScope.$on('$locationChangeSuccess', function() {
		$rootScope.actualLocation = $location.path();
	});
	$rootScope.$watch(function () {return $location.path()}, function (newLocation, oldLocation) {
		if($rootScope.actualLocation === newLocation) {
			$scope.main.get = $scope.main.httpGet + ($window.location.href).split('/').pop();
			$scope.loadPage();
		}
	});

	/********* Webstore categories with products**********/
	$scope.main = {
		categoryId: ($window.location.href).split('/').pop(),
		urlExploded: ($window.location.href).split('/'),
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
	$scope.setCategory = function(category_id){
		$scope.main.get = $scope.main.httpGet + category_id;
		$scope.loadPage();
	}
	$scope.loadPage = function() {
		$http.get($scope.main.get).success(function(data){
			$scope.categoriesWithProducts = data;
		});
	};
	if ($scope.main.urlExploded[3] == 'category') {
		$scope.loadPage();
	};
}]);
