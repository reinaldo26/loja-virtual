<h1>Procurando por: "<?php echo $searchTerm; ?>"</h1>

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

<div class="paginationArea">
	<?php for($i=1; $i<=$numberPages; $i++): ?>
		<div class="paginationItem page <?php echo ($currentPage==$i)?'pag_active':''; ?>"><a href="<?php echo BASE_URL; ?>?<?php 
			$page_array = $_GET;
			$page_array['page'] = $i;
			echo http_build_query($page_array);
		 ?>"><?php echo $i; ?></a></div>
	<?php endfor; ?>
</div>