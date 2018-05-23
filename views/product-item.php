<div class="product-item">
	<a href="<?php echo BASE_URL; ?>product/open/<?php echo $id; ?>">
		<div class="product-tags">
			<?php if($sale == '1'):?>
				<div class="product-tag product-tag-red"><?php echo $this->lang->get('SALE'); ?></div>
			<?php endif; ?>

			<?php if($bestseller == '1'): ?>
				<div class="product-tag product-tag-green"><?php echo $this->lang->get('BESTSELLER'); ?></div>
			<?php endif; ?>

			<?php if($new_product == '1'):?>
				<div class="product-tag product-tag-blue"><?php echo $this->lang->get('NEW'); ?></div>
			<?php endif; ?>
		</div>

		<div class="procuct-image">
			<img src="<?php echo BASE_URL; ?>media/products/<?php echo $images[0]['url']; ?>" width="100%" />
		</div>

		<div class="product-name"><?php echo utf8_encode($name); ?></div>

		<div class="product-brand"><?php echo $brand_name; ?></div>

		<div class="product-price-from">
			<?php 
				if($price_from != '0'){
					echo 'R$ '.number_format($price_from, 2, ',', '.');
				}
			?>
		</div>

		<div class="product-price"><?php echo 'R$ '.number_format($price, 2, ',', '.'); ?></div>

		<div style="clear: both;"></div>
	</a>
</div>