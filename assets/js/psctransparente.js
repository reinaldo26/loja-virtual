$(function(){

	$('.btn-payment').on('click', function(){
		var id = PagSeguroDirectPayment.getSenderHash();
		var name = $('input[name=name]').val();
		var cpf = $('input[name=cpf]').val();
		var telefone = $('input[name=telefone]').val();
		var email = $('input[name=email]').val();
		var pass = $('input[name=password]').val();

		var cep = $('input[name=cep]').val();
		var rua = $('input[name=rua]').val();
		var numero = $('input[name=numero]').val();
		var complemento = $('input[name=complemento]').val();
		var bairro = $('input[name=bairro]').val();
		var cidade = $('input[name=cidade]').val();
		var estado = $('input[name=estado]').val();

		var cartao_titular = $('input[name=titular]').val();
		var cartao_cpf = $('input[name=cartao_cpf]').val();
		var cartao_numero = $('input[name=cartao_numero]').val();
		var cvv = $('input[name=cvv]').val();
		var v_mes = $('select[name=v_mes]').val();
		var v_ano = $('select[name=v_ano]').val();

		var parc = $('select[name=parc]').val();

		if(cartao_numero != '' && cvv != '' && v_mes != '' && v_ano != '') {

			PagSeguroDirectPayment.createCardToken({
				cardNumber:cartao_numero,
				brand:window.cardBrand,
				cvv:cvv,
				expirationMonth:v_mes,
				expirationYear:v_ano,
				success:function(r) {
					window.cardToken = r.card.token;
					
					window.location.href = BASE_URL+'psctransparente/checkout?'+
					'1='+window.cardToken+'&?2='+id+'&3='+name+'&4='+cpf+'&5='+telefone+'&6='+email+
					'&7='+pass+'&8='+cep+'&9='+rua+'&10='+numero+'&11='+complemento+'&12='+bairro+
					'&13='+cidade+'&14='+estado+'&15='+cartao_titular+'&16='+cartao_cpf+'&17='+cartao_numero
					+'&18='+cvv+'&19='+v_mes+'&20='+v_ano+'&21='+parc

					$.ajax({
						url:BASE_URL+'psctransparente/checkout',
						type:'POST',
						data:{
							id_compra:id,
							nome:name,
							cpf:cpf,
							telefone:telefone,
							email:email,
							pass:pass,
							cep:cep,
							rua:rua,
							numero:numero,
							complemento:complemento,
							bairro:bairro,
							cidade:cidade,
							estado:estado,
							titular:cartao_titular,
							cartao_cpf:cartao_cpf,
							cartao_numero:cartao_numero,
							cvv:cvv,
							v_mes:v_mes,
							v_ano:v_ano,
							cartao_token:window.cardToken,
							parc:parc
						},
						dataType:"json",
						success:function(json) {
							if(json.error == true) {
								alert(json.msg);
							} else {
								window.location.href = BASE_URL
							}
						},
						error:function(e) {}
					});
				},
				error:function(r) {
					console.log(r);
				},
				complete:function(r) {}
			});

		} else {
			alert("Falta preencher dados do cartão.");
		}

	});

	$('input[name=cartao_numero]').on('keyup', function(e){
		if($(this).val().length == 6) {

			PagSeguroDirectPayment.getBrand({
				cardBin: $(this).val(),
				success:function(r){
					window.cardBrand = r.brand.name;
					var cvvLimit = r.brand.cvvSize;
					$('input[name=cvv]').attr('maxlength', cvvLimit);

					PagSeguroDirectPayment.getInstallments({
						amount:100,//$('input[name=total]').val(),
						brand:window.cardBrand,
						success:function(r) {
							if(r.error == false) {
								var parc = r.installments[window.cardBrand];
								var html = '';

								for(var i in parc) {
									var optionValue = parc[i].quantity+';'+parc[i].installmentAmount+';';
									if(parc[i].interestFree == true) {
										optionValue += 'true';
									} else {
										optionValue += 'false';
									}

									html += '<option value="'+optionValue+'">'+parc[i].quantity+'x de R$ '+parc[i].installmentAmount+'</option>';
								}

								$('select[name=parc]').html(html);
							}

						},
						error:function(r) {},
						complete:function(r) {}

					});

				},
				error:function(r){},
				complete:function(r) {}
			});

		}
	});
});