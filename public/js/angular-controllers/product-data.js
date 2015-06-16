/*webstoreApp.controller('product-data', ['$scope', '$http', function($scope, $http) {
	$scope.main = {
		title: 'Web Store Products',
		page: 1,
		limit: 6,
		pages: 1,
		around: 3
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
};*/