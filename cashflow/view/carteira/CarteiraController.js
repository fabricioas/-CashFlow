var cashflowApp = angular.module('cashflow',[]);
cashflowApp.controller('CarteiraController', ['$scope','$http', function($scope, $http) {
	$scope.detalheOpened = false;
	$scope.pesquisar = function(){
		var data = {"pesquisa": $scope.txtPesquisa};
		$http.post("../../rest.php/carteira/pesquisa",data).then(function(response){
			$scope.carteiras = response.data;
		});
	}
	
	$scope.openDetalhe = function(item){
		if( item ){
			$scope.dataDetalhe = item;
		}else{
			$scope.dataDetalhe = null;
		}
	
		$scope.detalheOpened = true;
	}

	$scope.closeDetalhe = function(){
		$scope.detalheOpened = false;
	}

	$scope.salvar = function(){
		if( $scope.dataDetalhe.id_carteira ){
			$http.post("../../rest.php/carteira/salvar",$scope.dataDetalhe).then(function(response){
				$scope.closeDetalhe();
				$scope.pesquisar();
			});
		}else{
			$http.put("../../rest.php/carteira/salvar",$scope.dataDetalhe).then(function(response){
				$scope.closeDetalhe();
				$scope.pesquisar();
			});
		}
	}
	
	$scope.deletar = function(item){
		if( item.id_carteira ){
			$http.delete("../../rest.php/carteira/salvar/" + item.id_carteira).then(function(response){
				$scope.closeDetalhe();
				$scope.pesquisar();
			});
		}
	}

	$scope.pesquisar();
}]);