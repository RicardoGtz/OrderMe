function addProduct(code){
	var amount = document.getElementById(code).value;
	//window.location.href = 'index.php?action=add&code='+code+'&amount='+amount+'&id='+id;
	window.location.href = 'ordenPedidos.php?action=add&code='+code+'&amount='+amount;

}
function deleteProduct(code){
	window.location.href = 'ordenPedidos.php?action=remove&code='+code;
}
