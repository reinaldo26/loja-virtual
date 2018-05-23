<aside>
	<h1><?php $this->lang->get('FILTER'); ?></h1>
	<div class="filterarea">

		<form method="GET">
			<input type="hidden" name="s" value="<?php echo $viewData['searchTerm']; ?>" />
			<div class="filterbox">
				<div class="filtertitle"><?php $this->lang->get('BRANDS'); ?></div>
				<div class="filtercontent">
					<?php foreach($viewData['filters']['brands'] as $bitem): ?>
						<div class="filteritem">
							<input type="checkbox" <?php echo (isset($viewData['filters_selected']['brand']) && in_array($bitem['id'], $viewData['filters_selected']['brand']))?'checked="checked"':''; ?> name="filter[brand][]" value="<?php echo $bitem['id']; ?>" id="filter_brand<?php echo $bitem['id']; ?>" /> 
							<label for="filter_brand<?php echo $bitem['id']; ?>"><?php echo $bitem['name']; ?></label><span> (<?php echo $bitem['count']; ?>)</span>
						</div>
					<?php endforeach; ?>	
				</div>
			</div>

			<div class="filterbox">
				<div class="filtertitle"><?php $this->lang->get('PRICE'); ?></div>
				<div class="filtercontent">
					<input type="hidden" id="slider0" name="filter[slider0]" value="<?php echo $viewData['filters']['slider0']; ?>" />
					<input type="hidden" id="slider1" name="filter[slider1]" value="<?php echo $viewData['filters']['slider1']; ?>" />
					<input type="text" id="amount" readonly style="border:0;"/>				
					<div id="slider-range"></div>
				</div>
			</div>

			<div class="filterbox">
				<div class="filtertitle"><?php $this->lang->get('RATING'); ?></div>
				<div class="filtercontent">

					<div class="filteritem">
						<input type="checkbox" id="filter_star0" name="filter[star][]" value="0" <?php echo (isset($viewData['filters_selected']['star']) && in_array('0', $viewData['filters_selected']['star']))?'checked="checked"':''; ?> />
						<label for="filter_star0">
							<span><?php $this->lang->get('NO_STAR'); ?></span>
							<span>(<?php echo $viewData['filters']['stars']['0']; ?>)</span>
						</label>
					</div>

					<div class="filteritem">
						<input type="checkbox" id="filter_star1" name="filter[star][]" value="1" <?php echo (isset($viewData['filters_selected']['star']) && in_array('1', $viewData['filters_selected']['star']))?'checked="checked"':''; ?> />
						<label for="filter_star1">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="14">
							<span>(<?php echo $viewData['filters']['stars']['1']; ?>)</span>
						</label>
					</div>
					<div class="filteritem">
						<input type="checkbox" id="filter_star2" name="filter[star][]" value="2" <?php echo (isset($viewData['filters_selected']['star']) && in_array('2', $viewData['filters_selected']['star']))?'checked="checked"':''; ?> />
						<label for="filter_star2">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="14">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="14">
							<span>(<?php echo $viewData['filters']['stars']['2']; ?>)</span>
						</label>
					</div>
					<div class="filteritem">
						<input type="checkbox" id="filter_star3" name="filter[star][]" value="3" <?php echo (isset($viewData['filters_selected']['star']) && in_array('3', $viewData['filters_selected']['star']))?'checked="checked"':''; ?> />
						<label for="filter_star3">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="14">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="14">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="14">
							<span>(<?php echo $viewData['filters']['stars']['3']; ?>)</span>
						</label>
					</div>
					<div class="filteritem">
						<input type="checkbox" id="filter_star4" name="filter[star][]" value="4" <?php echo (isset($viewData['filters_selected']['star']) && in_array('4', $viewData['filters_selected']['star']))?'checked="checked"':''; ?> />
						<label for="filter_star4">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="14">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="14">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="14">
							<span>(<?php echo $viewData['filters']['stars']['4']; ?>)</span>
						</label>
					</div>
					<div class="filteritem">
						<input type="checkbox" id="filter_star5" name="filter[star][]" value="5" <?php echo (isset($viewData['filters_selected']['star']) && in_array('5', $viewData['filters_selected']['star']))?'checked="checked"':''; ?> />
						<label for="filter_star5">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="14">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="14">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="14">
							<img src="<?php echo BASE_URL; ?>assets/images/star.png" border="0" height="14">
							<span>(<?php echo $viewData['filters']['stars']['5']; ?>)</span>
						</label>
					</div>
				</div>
			</div>

			<div class="filterbox">
				<div class="filtertitle"><?php $this->lang->get('SALE'); ?></div>
				<div class="filtercontent">
					<div class="filteritem">
						<input type="checkbox" id="filter_sale" name="filter[sale]" value="1" <?php echo (isset($viewData['filters_selected']['sale']) && $viewData['filters_selected']['sale'] == '1')?'checked="checked"':''; ?> />
						<label for="filter_sale">Em Promoção</label>
						<span>(<?php echo $viewData['filters']['sale']; ?>)</span>			
					</div>
				</div>
			</div>

			<div class="filterbox">
				<div class="filtertitle"><?php $this->lang->get('OPTIONS'); ?></div>
				<div class="filtercontent">
					<?php foreach($viewData['filters']['options'] as $option): ?>
						<strong><?php echo $option['name']; ?></strong><br/><br/>
						<?php foreach($option['options'] as $op): ?>
							<div class="filteritem">
								<input type="checkbox" id="filter_options" value="<?php echo $op['value']; ?>" name="filter[options][]" <?php echo (isset($viewData['filters_selected']['options']) && in_array($op['value'], $viewData['filters_selected']['options']))?'checked="checked"':''; ?> />
								<label for="filter_options<?php echo $op['id']; ?>"><?php echo $op['value']; ?></label>
								<span>(<?php echo $op['count']; ?>)</span>			
							</div>
						<?php endforeach; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</form>
	</div>

	<div class="widget">
		<h1><?php $this->lang->get('FEATUREDPRODUCTS'); ?></h1>
		<div class="widget_body">
			<?php 
			$this->loadView('widget_view', ['list' =>$viewData['widget_featured1']]); 
			?>
		</div>
	</div>
</aside>