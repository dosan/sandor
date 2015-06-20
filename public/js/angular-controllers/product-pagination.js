'use strict';

console.log(window.location);
webstoreApp.controller('ProductPagination', ['$scope', '$http', 'productModal', function($scope, $http, productModal) {
	
	$scope.Modal = productModal;
	$scope.main = {
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