'use strict';
var productsApp = angular.module('productsApp', ['ui.bootstrap']);

console.log(window.location);
productsApp.controller('ProductCtrl', ['$scope', '$http', function($scope, $http) {
	$scope.main = {
		title: 'Web Store Products',
		page: 1,
		limit: 6,
		pages: 1,
		around: 3
	};
	$scope.range = function(){
		var input = [];
		var start = (($scope.main.page - $scope.main.around)>0) ? $scope.main.page - $scope.main.around : 1;
		var end = (($scope.main.page + $scope.main.around) < $scope.main.pages) ?  $scope.main.page + $scope.main.around : $scope.main.pages;
		for (var i = start; i <= end; i += 1) input.push(i);

		return input;
	};
	$scope.loadPage = function() {
		// You could use Restangular here with a route resource.
		$http.get('/product/getData/' + $scope.main.page + '/' + $scope.main.limit).success(function(data){
			// users from your api
			$scope.products = data['products'];
			
			// number of pages of users
			$scope.main.pages = Math.ceil(data['count'] / $scope.main.limit);
		});
	};
	$scope.loadPage();
	$scope.previousPage = function() {
		if ($scope.main.page > 1) {
			$scope.main.page--;
			$scope.loadPage();
		}
	};
	$scope.nextPage = function() {
		if ($scope.main.page < $scope.main.pages) {
			$scope.main.page++;
			$scope.loadPage();
		}
	};
	$scope.setPage = function(n){
		$scope.main.page = n;
		$scope.loadPage();
	};
}]);










var adminApp = angular.module('adminApp', ['ngRoute', 'ngAnimate']);

adminApp.controller('AdminCtrl',['$scope', '$http', '$location', function($scope, $http, $location){
	$scope.master = {};
	$scope.save = function(dataInput){
		$scope.master = angular.copy(dataInput);
		var request = $http({
			method: "post",
			url: window.location.origin+"/admin/addproduct",
			data: $scope.master,
			headers: {'Content-Type': 'application/x-www-from-urlencoded'}
		}).success(function(data){
			if (data['success'] || data['message']) {
				alert(data['message']);
				if (data['success'])
					document.location.reload(true);
			}
		}).error();
	};


	$scope.reset = function(form) {
		if (form) {
			form.$setPristine();
			form.$setUntouched();
		}
		$scope.user = angular.copy($scope.master);
	};

	$scope.reset();

}]);

var productApp = angular.module('productApp', ['ngRoute', 'ngAnimate']);


productApp.config(["$routeProvider", "$locationProvider", function($routeProvide, $locationProvider)
{
/*	$routeProvide.when("/", {
		templateUrl: "/templates/main/newest.php",
		controller: "PhoneListCtrl"
	}).when("/about", {
		templateUrl: "/templates/about.php",
		controller: "AboutCtrl"
	}).when("/contact", {
		templateUrl: "/templates/contact.php",
		controller: "ContactCtrl"
	}).when("/phone/:phoneId", {
		templateUrl: "/templates/phone-detail.php",
		controller: "PhoneDetailCtrl"
	}).otherwise({
		redirectTo: "/"
	});*/
}]);

productApp.filter('checkmark', function() {
	return function(input) {
		return input ? '\u2713' : '\u2718';
	}
});
productApp.directive('onErrorSrc', function() {
	return {
		link: function(scope, element, attrs) {
			element.bind('error', function() {
			if (attrs.src != attrs.onErrorSrc) {
				attrs.$set('src', attrs.onErrorSrc);
			}
		});
		}
	}
});
productApp.controller('PhoneListCtrl',['$scope', '$http', '$location', function($scope, $http, $location){
	
	$http.get('/phones/getphones').success(function(data){
		$scope.phones = data;
	}).error(function(data, status, headers, config){
		console.log("This is error ", data);
	});
}]);
productApp.controller('AboutCtrl', ['$scope', '$http', '$location', function($scope, $http, $location){
}]);
productApp.controller('ContactCtrl', ['$scope', '$http', '$location', function($scope, $http, $location){
}]);
productApp.controller('PhoneDetailCtrl', ['$scope', '$http', '$location', '$routeParams', function($scope, $http, $location, $routeParams){
	$scope.phoneId = $routeParams.phoneId;
	var url = 'phones/get/' + $routeParams.phoneId;
	$http.get(url).success(function(data){
		$scope.mainImageUrl = 'public/img/products/'+ data[0].product_image;
		$scope.phone = data[0];
	});
	$scope.setImage = function(imageUrl){
		$scope.mainImageUrl = imageUrl;
	}
}]);