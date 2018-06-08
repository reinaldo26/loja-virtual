<h2><?php $this->lang->get('CART'); ?></h2>
<table border="0" width="100%">
	<tr>
		<th width="100">Imagem</th>
		<th>Nome</th>
		<th width="160">Qtd.</th>
		<th width="150">Preço</th>
		<th width="20">Remover</th>
	</tr>
	<?php $subtotal = 0; ?>
	<?php foreach($list as $item): ?>
	<?php $subtotal += (floatval($item['price']) * intval($item['qt'])); ?> 
		<tr>
			<td>
				<img src="<?php echo BASE_URL; ?>media/products/<?php echo $item['image']; ?>" width="80">
			</td>
			<td><?php echo $item['name']; ?></td>
			<td>
				<a href="<?php echo BASE_URL; ?>cart/sub/<?php echo $item['id']; ?>">
					<button class="decrease">-</button>
				</a>

				<?php echo $item['qt']; ?>
				
				<a href="<?php echo BASE_URL; ?>cart/inc/<?php echo $item['id']; ?>">
					<button class="increase">+</button>
				</a>
			</td>
			<td><?php echo number_format($item['price'], 2, ',', '.'); ?></td>
			<td>
			<a href="<?php echo BASE_URL; ?>cart/del/<?php echo $item['id']; ?>">
				<img src="<?php echo BASE_URL; ?>assets/images/delete.png" width="15"/>
			</a>
		</td>
	  	</tr>
	<?php endforeach; ?>
	<tr>
		<td colspan="3" align="right">Sub-total: </td>
		<td><strong><?php echo number_format($subtotal, 2, ',', '.'); ?></strong></td>
	</tr>
	<tr>
		<td colspan="3" align="right">Frete</td>
		<td>
			<?php if(isset($shipping['price'])): ?>
				<strong><?php echo $shipping['price']; ?></strong> (Prazo: <?php echo $shipping['date']; ?> dia<?php echo ($shipping['date'] == '1')?'':'s'; ?>)
			<?php else: ?>
			<form method="POST">
				<label for="cep"><?php $this->lang->get('USERCEP'); ?></label><br/>
				<input type="number" id="cep" name="cep"/>
				<input type="submit" value="Calcular"/>
			</form>
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="right">Total</td>
		<td><strong><?php 
		if(isset($shipping['price'])){
			$frete = floatval(str_replace(',', '.', $shipping['price']));
		} else {
			$frete = 0;
		}
		
		$total = $subtotal + $frete;
		echo number_format($total, 2, ',', '.'); 

		?></strong></td>
	</tr>
</table>
<hr/>

<?php if($frete > 0): ?>
<!--<form method="POST" style="float: right;" action="<?php //echo BASE_URL; ?>cart/payment_redirect"> -->
	<?php if(!empty($_SESSION['user'])): ?>
	<form method="POST" style="float: right;" action="<?php echo BASE_URL; ?>cart/payment_redirect">
		<select name="payment_type">
			<option value="paypal">Paypal</option>
			<!-- <option value="boleto">Boleto</option> -->
		</select>
		<input type="submit" value="Finalizar Compra" class="btn-payment" />
	</form>
	<?php else: ?>
		<button class="btn-login btn-payment" style="float: right;" data-toggle="modal" data-target=".modal-login">
			<?php $this->lang->get('LOGIN-CART'); ?>
		</button>
	<?php endif; ?>
<?php endif; ?>


