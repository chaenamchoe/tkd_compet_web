<div class="container">
	<br/>  
    <div class="row justify-content-center">
        <h2> 코트를 선택하세요 </h2>
    </div>
    <hr>
	<?php
		foreach ($compet_list as $row):
			$id = $row['ID'];
			$c_name = $row['C_NAME'];
			$c_place = $row['C_PLACE'];
		?>
		<div class="row justify-content-center">
			<p><h3> <?=$c_name?> </h3></p>
		</div>	
		<div class="row justify-content-center">
			<div class="col-sm-6 text-center">
				<a href=<?php echo site_url('process/save_competition/'.$id.'/1')?> class="btn btn-primary"> 코트 1 </a>
				<a href=<?php echo site_url('process/save_competition/'.$id.'/2')?> class="btn btn-primary"> 코트 2 </a>
				<a href=<?php echo site_url('process/save_competition/'.$id.'/3')?> class="btn btn-primary"> 코트 3 </a>
				<a href=<?php echo site_url('process/save_competition/'.$id.'/4')?> class="btn btn-primary"> 코트 4 </a>
			</div>
		</div>	
		<hr>
	<?php endforeach; ?>
</div>