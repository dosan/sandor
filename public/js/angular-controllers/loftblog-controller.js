
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