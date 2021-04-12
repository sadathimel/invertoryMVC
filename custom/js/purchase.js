var managePurchaseTable;

$(document).ready(function(){

	$("#navOrder").addClass('active');

	managePurchaseTable = $("#managePurchaseTable").DataTable({
		"ajax" : 'php_action/fetchPurchase.php',
		"order" : [[0, "desc"]],
		"paging":   false,
        "info":     false
	});
});