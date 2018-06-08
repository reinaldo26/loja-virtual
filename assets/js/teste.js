
$(function(){
	$.ajax({
		type: 'POST',
		url: 'teste.php',
		data: {nome: nome},
		success: function(retorno){
				alert('Foi');		
		}
	});
});  
                                          