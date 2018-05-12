<div class="row">
	
	<?php $i = 0; ?>

	<?php foreach ($list as $product_item): ?>
		
		<div class="col-sm-4">
			<?php $this->loadView('product-item', $product_item); ?>
		</div>
		<?php 
			if($i >= 2){
				$i = 0;
				echo "</div><div class='row'>";
			} else {
				$i++;
			}?>

	<?php endforeach; ?>
</div>




<!--
<div class="row">
	<div class="col-sm-4">
		<div class="product-item">
			<?php //$this->loadView('product-item', []); ?>
		</div>
	</div>

	<div class="col-sm-4">
		<?php //$this->loadView('product-item', []); ?>
	</div>	

	<div class="col-sm-4">
		<?php //$this->loadView('product-item', []); ?>
	</div>		
</div>
-->