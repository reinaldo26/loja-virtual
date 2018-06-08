<h1><strong>PagSeguro Checkout Transparente</strong></h1>
 <!-- Campos obrigatorios -->
 <input type="hidden" name="receiverEmail" value=""/>
 <input type="hidden" name="currency" value="BRL"/>

<?php for(): ?>
<input type="hidden" name="item <?php ?>"/>
<input type="hidden" name="itemDescription <?php ?>"/>
<input type="hidden" name="itemAmount <?php ?>">
<input type="hidden" name="itemQuantity <?php ?>"/>
<input type="hidden" name="itemWeight <?php ?>"/>
<?php endfor; ?>

<input type="hidden" name="reference" value="<?php ?>"/>

<!-- Frete -->
<input type="hidden" name="shippingType" value="1"/>








<!-- Informações do usuário

	<input type="hidden" name="name" value="<?php echo $dataUser['name']; ?>"/>
	<input type="hidden" name="email" value="<?php echo $dataUser['email']; ?>"/>
	<input type="hidden" name="password" value="<?php echo $dataUser['password']; ?>"/>
	<input type="hidden" name="cep" value="<?php echo $dataUser['cep']; ?>"/>
	<input type="hidden" name="cpf" value="<?php echo $dataUser['cpf']; ?>"/>
	<input type="hidden" name="rua" value="<?php echo $dataUser['rua']; ?>"/>
	<input type="hidden" name="bairro" value="<?php echo $dataUser['bairro']; ?>"/>
	<input type="hidden" name="cidade" value="<?php echo $dataUser['cidade']; ?>"/>
	<input type="hidden" name="estado" value="<?php echo $dataUser['estado']; ?>"/>
	<input type="hidden" name="numero" value="<?php echo $dataUser['numero']; ?>"/>
	<input type="hidden" name="complemento" value="<?php echo $dataUser['complemento']; ?>"/>
	<input type="hidden" name="telefone" value="<?php echo $dataUser['tel']; ?>"/>
	<input type="hidden" name="idCompra"/>
	<input type="hidden" name="cartao_token"/> -->

<h3>Informações de pagamento</h3>

	<strong>Número do cartão</strong><br/>
	<input type="text" name="cartao_numero"/><br/><br/>

	<strong>Titular</strong><br/>
	<input type="text" name="titular"/><br/><br/>

	<strong>CPF do titular</strong><br/>
	<input type="text" name="cartao_cpf"/><br/><br/>

	<strong>Código de segurança</strong><br/>
	<input type="text" name="cvv"/><br/><br/>

	<strong>Validade</strong><br/>
	<select name="v_mes">
		<?php for($i=1; $i<=12; $i++): ?>
			<option><?php echo ($i<10)?'0'.$i:$i; ?></option>
		<?php endfor; ?>
	</select>
	<select name="v_ano">
		<?php $ano = intval(date('Y')); ?>
		<?php for($i=$ano; $i<=($ano+20); $i++): ?>
			<option><?php echo $i; ?></option>
		<?php endfor; ?>
	</select><br/><br/>

	<strong>Parcelas</strong><br/>
	<select name="parc"></select><br/><br/>

	<button type="button" class="btn-payment">Finalizar Pagamento</button>


<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/psctransparente.js"></script>

<script type="text/javascript">
	PagSeguroDirectPayment.setSessionId("<?php echo $sessionCode; ?>");
</script>

