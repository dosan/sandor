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

