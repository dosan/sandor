'use strict';
console.log(window.location);


webstoreApp.controller('CategoriesProducts', ['$scope', '$http','$route', '$routeParams', '$location', 'mainFactory', '$window', function($scope, $http, $route, $routeParams, $location, mainFactory, $window) {
	$scope.main = {
		title: 'Web Store Categories',
		urlExploded: (window.location.href).split('/'),
		url: window.location.origin,
		linkTo: '/product/category/',
		getCategories: '/product/getCategories',
		get: '',
		categoryIsEmtpy: 'No have products', 
		categories: window.location.pathname.replace("/product/category/", '').replace(/\//g, ' ').trim().split(' '),
		mainCategory: null,
		childCategory: null,
	};
	$scope.loadProducts = function(){
		if (window.location.pathname.search("product/category") == 1/* && ("/product/category/".length < window.location.pathname.length)*/) {
			$http.get(window.location.href.replace("product/category", "product/getProducts")).success(function(data){
				mainFactory.setProducts(data);
				$scope.Products = mainFactory.getProducts();
			});
		};
	}
	$scope.loadPage = function(){
		console.log($scope.main.categories);
		$scope.loadProducts();
	};
	$scope.loadProducts();
}]);

