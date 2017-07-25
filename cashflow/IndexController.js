var cashflowApp = angular.module('cashflow',[]);

cashflowApp.controller('IndexController', ['$scope','$http','$location', function($scope, $http, $location) {
	$scope.openConta = function(){
		window.location = "conta/conta.html";
	}

	$scope.openFluxo = function(){
		window.location = "fluxo_caixa/fluxo_caixa.html";
	}

}]);