<div class="container">
	<div class="row justify-content-center">
		<div class="col text-center">
		<p><h2> ��ϵ��� ���� </h2>
		<hr>
		</div>
	</div>
	<?php 
		if (!empty($results)){
	?>
	<div class="row justify-content-center">
	<div class="col-sm-6">
		<div class="table-responsive">
		<table class="table table-hover table-sm">
			<thead class="thead-light">
				<tr>
					<th>�����</th>
					<th>�����</th>
					<th>��ȭ��ȣ</th>
					<th>����</th>
				</tr>
			</thead>
			<?php
                $no = 0;
				foreach ($results as $row):
					$no++;
					$id = $row['ID'];
                    $center_name = $row['CENTER_NAME'];
					$c_name = $row['C_NAME'];
					$addr = $row['MOBILE'];
					//$email = $row['EMAIL'];
				?>
		  	<tr>
			  <td><?=$center_name ?></td>
			  <td><?=$c_name ?></td>
              <td><?=$addr ?></td>
              <td><a href=<?php echo site_url('compet/select_login_id/'.$id)?> class="btn btn-primary">����</a></td>
			</tr>
			<?php endforeach; ?>
		</table>
		<hr>
            
		</div>
	</div>	
	<?php } ?>
	</div>
</div>		