<div class="row">
	<div class="col-sm-5">
		<div class="mainphoto">
			<img src="<?php echo BASE_URL; ?>media/products/<?php echo $product_images[0]['url']; ?>"/>
		</div>

		<div class="gallery">
			<?php foreach($product_images as $img): ?>
				<div class="photo_item">
					<img src="<?php echo BASE_URL; ?>media/products/<?php echo $img['url']; ?>"/>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="col-sm-7 data-product">
		<h2><?php echo utf8_encode($product_info['name']); ?></h2>
		<small><?php echo utf8_encode($product_info['brand_name']); ?></small><br/>
		<?php if($product_info['rating'] != '0'): ?>
			<?php for($i=0; $i<intval($product_info['rating']); $i++): ?>
				<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="15"/>
			<?php endfor; ?>
		<?php endif; ?>
		<hr/>
		<p><?php echo utf8_encode($product_info['description']); ?></p>
		<hr/>
		<span class="price_from">R$<?php echo number_format($product_info['price_from'], 2); ?></span>
		<br/>
		<span class="price">R$<?php echo number_format($product_info['price'], 2); ?></span>

		<form method="POST" class="addtocartform">
			<button data-action="decrease">-</button><input type="text" name="qt" value="1" class="addtocartqt" disabled="disabled"/><button data-action="increase">+</button>
			<input type="submit" class="addtocart_submit" value="<?php $this->lang->get('ADD_TO_CART'); ?>"/>
		</form>
	</div>
</div>
<hr/>
<div class="row">
	<?php if($product_options): ?>
		<div class="col-sm-6">
			<h3><?php $this->lang->get('PRODUCT_SPECIFICATIONS'); ?></h3>
			<?php foreach($product_options as $po): ?>
				<strong><?php echo $po['name']; ?></strong>: <?php echo $po['value']; ?><br/>
			<?php endforeach; ?>
		</div>
		<div class="col-sm-6 p-reviews">
			<h3><?php $this->lang->get('PRODUCT_REVIEWS'); ?></h3>
			<?php foreach($product_rates as $rate): ?>
				<strong><?php echo $rate['user_name']; ?></strong><br/>
				<?php for($i=0; $i<intval($rate['points']); $i++): ?>
					<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="15"/>
				<?php endfor; ?>
				<p><?php echo $rate['comment']; ?></p>
				<hr/>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php if(!isset($product_options)): ?>
		<div class="col-sm-10 p-reviews">
			<?php if(!empty($product_rates)): ?>
			<center><h3><?php $this->lang->get('PRODUCT_REVIEWS'); ?></h3></center>	
			<?php foreach($product_rates as $rate): ?>
				<strong><?php echo $rate['user_name']; ?></strong><br/>
				<?php for($i=0; $i<intval($rate['points']); $i++): ?>
					<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="15"/>
				<?php endfor; ?>
				<p><?php echo $rate['comment']; ?></p>
				<hr/>
			<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<div class="col-sm-2"></div>
	<?php endif; ?>
</div>