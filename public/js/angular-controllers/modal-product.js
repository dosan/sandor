
webstoreApp.controller('ModalInstanceCtrl', function ($scope, $modalInstance, $http, mainFactory, product) {
	$scope.product = product;
	$scope.Factory = mainFactory;
	$scope.inBasket = false;
	$scope.productsInBasket = mainFactory.getInBasket();
	$scope.isInBasket = function(){
		for(var key in $scope.productsInBasket) {
			if($scope.productsInBasket[key] == $scope.product.product_id) {
				return true;
			}
		}
		return false;
	}
	$scope.inBasket = $scope.isInBasket();
	$scope.addToBasket = function () {
		$http.get("/basket/addtobasket/" + $scope.product.product_id + '/').success(function(data){
			if (data.success){
				mainFactory.setInBasket(data);
				$scope.inBasket = true;
			}
		});
	};
	$scope.removeFromBasket = function(){
		$http.get("/basket/removeFromBasket/" + $scope.product.product_id + '/').success(function(data){
			if (data.success){
				mainFactory.setInBasket(data);
				$scope.inBasket = false;
			}
		});
	}
});