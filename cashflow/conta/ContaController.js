var cashflowApp = angular.module('cashflow',[]);
cashflowApp.controller('ContaController', ['$scope','$http', function($scope, $http) {
	var pesquisa = function(){
		$http.get("../rest.php?table=conta").then(function(response){
			$scope.contas = response.data;
		});
	}
	
	$scope.addConta = function(){
		var conta = {
			id_conta: 1,
			nm_conta: "NET",
			id_carteira_default: 1				
		}
		var data = {
			"table": "conta",
			"data": conta
		}
		$http.put("../rest.php",data).then(function(response){
			pesquisa();
		});
	}
	
	pesquisa();
}]);