<?php foreach ($subs as $sub): ?>
	
	<option>
		<?php 
			for($i=0; $i<$level; $i++) echo '> '; echo $sub['name']; 
		?>
	</option>

<?php 
if(count($sub['subs']) > 0){
	$this->loadView('search_subcategory', [
		'subs' => $sub['subs'],
	 	'level' => $level+1
	 ]);
}

endforeach; 
?>