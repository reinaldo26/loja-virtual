<h1>Checkout PayPal</h1>

<?php if(!empty($error)): ?>
<div class="warn">
	<?php echo $error; ?>
</div>
<?php endif; ?>

<h3>Dados Pessoais</h3>

<form method="POST" action="<?php echo BASE_URL; ?>paypal">
	<strong>Nome:</strong><br/>
	<input type="text" name="name"/><br/><br/>

	<strong>CPF:</strong><br/>
	<input type="text" name="cpf"/><br/><br/>

	<strong>Telefone:</strong><br/>
	<input type="text" name="telefone"/><br/><br/>

	<strong>E-mail:</strong><br/>
	<input type="email" name="email"/><br/><br/>

	<strong>Senha:</strong><br/>
	<input type="password" name="pass"/><br/><br/>

	<h3>Informações de Endereço</h3>

	<strong>CEP:</strong><br/>
	<input type="text" name="cep"/><br/><br/>

	<strong>Rua:</strong><br/>
	<input type="text" name="rua"/><br/><br/>

	<strong>Número:</strong><br/>
	<input type="text" name="numero"/><br/><br/>

	<strong>Complemento:</strong><br/>
	<input type="text" name="complemento"/><br/><br/>

	<strong>Bairro:</strong><br/>
	<input type="text" name="bairro"/><br/><br/>

	<strong>Cidade:</strong><br/>
	<input type="text" name="cidade"/><br/><br/>

	<strong>Estado:</strong><br/>
	<input type="text" name="estado"/><br/><br/>

	<input type="submit" value="Efetuar Compra" class="button efetuarCompra btn-payment"/>
</form>