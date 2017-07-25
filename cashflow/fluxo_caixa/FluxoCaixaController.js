var cashflowApp = angular.module('cashflow',['ngDialog']);

cashflowApp.controller('FluxoCaixaController', ['$scope','$http','$location','ngDialog', function($scope, $http, $location,ngDialog) {
	$scope.busca = function(){
		$http.get("./fluxo_caixa.php").then(function(response){
			$scope.fluxos = response.data;
		});
	}
	
	$scope.selectedItem = null;
	
	$scope.salvarLancamento = function(){
		var insert = {
			table:"entrada_saida",
			data: $scope.lancamento
		}
		$http.put("../rest.php",insert).then(function(response){
			$scope.busca();
		});
	}
	
	$scope.openEditOrPay = function(obj){
		$scope.selectedItem = obj;
		ngDialog.open({
			scope: $scope, 
			template: 'editOrPay',
			className: 'ngdialog-theme-default',
			showClose: false,
			 width: 190				
		});
	}

	$scope.openPay = function(col, obj){
		ngDialog.open({
			scope: $scope, 
			template: 'dlgPay',
			className: 'ngdialog-theme-default',
			showClose: false		
		});
	}

	$scope.openEdit = function(col, obj){
		ngDialog.open({
			scope: $scope, 
			template: 'dlgEdit',
			className: 'ngdialog-theme-default',
			showClose: false		
		});
	}

	$scope.busca();
	
}]);