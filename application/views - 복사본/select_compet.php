<div class="container">
	<br/>  
    <div class="row justify-content-center">
        <div class="col-sm-6 text-center">
        <h2> ��ȸ�� �����ϼ��� </h2>
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
				<p> <?=$c_name?> </p>
				<a href=<?php echo site_url('video/save_competition/'.$id.'/1')?> class="btn btn-primary"> ��Ʈ 1 </a>
				<a href=<?php echo site_url('video/save_competition/'.$id.'/2')?> class="btn btn-primary"> ��Ʈ 2 </a>
				<a href=<?php echo site_url('video/save_competition/'.$id.'/3')?> class="btn btn-primary"> ��Ʈ 3 </a>
				<a href=<?php echo site_url('video/save_competition/'.$id.'/4')?> class="btn btn-primary"> ��Ʈ 4 </a>
		<hr>
			</div>
		</div>	
	<?php endforeach; ?>
</div>