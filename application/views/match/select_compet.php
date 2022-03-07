<div class="container">
	<br/>  
    <div class="row justify-content-center">
        <div class="col-sm-6 text-center">
        <h2> 대회를 선택하세요 </h2>
        </div>
    </div>
    <hr>
	<?php
		foreach ($compet_list as $row):
			$id = $row['ID'];
			$c_name = $row['C_NAME'];
			$c_place = $row['C_PLACE'];
		?>
		<div class="row justify-content-center">
			<div class="col-sm-6 text-center">
				<a href=<?php echo site_url('match/save_competition/'.$id)?> class="btn btn-primary"> <?=$c_name?> </a>
		<hr>
			</div>
		</div>	
	<?php endforeach; ?>
</div>