<div class="container">
	<br/>  
    <div class="row justify-content-center">
        <div class="col text-center">
        <h2 class="alert alert-success"> 대회/코트/부심 선택 </h2>
        </div>
    </div>
    <hr>
		<?php
		foreach ($compet_list as $row):
			$id = $row['ID'];
			$c_name = $row['C_NAME'];
			$c_place = $row['C_PLACE'];
			$pass_txt = $row['ONLINE_PASSWORD'];
		?>
		<div class="row justify-content-center">
			<div class="col-sm-8 text-center">
				<p><a href=<?php echo site_url('point/selected_competition/'.$id)?> class="btn btn-primary btn-lg">  <?=$c_name?>  </a>
				</p><hr>
			</div>
		</div>	
	<?php endforeach; ?>
</div>