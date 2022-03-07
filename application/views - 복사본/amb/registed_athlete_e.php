</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js" integrity="sha512-Y2IiVZeaBwXG1wSV7f13plqlmFOx8MdjuHyYFVoYzhyRr3nH/NMDjTBSswijzADdNzMyWNetbLMfOpIPl6Cv9g==" crossorigin="anonymous">
</script>

<script>
	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>
<div class="container">
	<div class="row">
		<div class="col text-center">
		<p><h2 class="alert alert-primary">2021 Korean Ambassador¡¯s Cup Taekwondo World Championship</h2></p>
		<p><h3><?php echo $_SESSION['login_user_center']?></h3>
		<!--<p><h3>Name of Diplomatic Mission</h3>-->
		</p>
		<hr>
		</div>
	</div>
	<div class="row">
		<div class="table-responsive">
		<table class="table table-hover table-sm table-striped">
			<thead class="thead-light">
				<tr>
					<th style="text-align:center">No</th>
					<th>Type</th>
					<th>Category</th>
					<th>Name</th>
					<th style="text-align:center">Attendee</th>
					<th style="display:none;">guid</th>
				</tr>
			</thead>
			<?php
                $no = 0;
				$tcnt = 0;
				foreach ($results as $row):
					$no++;
					$id = $row['ID'];
                    $jongmok_name = $row['JONGMOK_NAME_E'];
					$jongmok_id = $row['JONGMOK_ID'];
					$category_name = $row['CATEGORY_NAME_E'];
					$category_id = $row['CATEGORY_ID'];
					$single_val = $row['SINGLE_GROUP'];
					$weight = $row['W_NAME'];
					$a_weight = $row['A_WEIGHT'];
					$aname = $row['A_NAME'];
					$a_cnt = $row['ATHLETE_CNT'];
					$ayear = $row['A_YEAR'];
					$jumin = $row['A_JUMIN'];
					$jumin_hidden = $jumin; // substr($jumin,0,-6)."******";		
					$price = $row['ATT_PRICE'];
					$tcnt = $tcnt + $a_cnt;
					$a_guid = $row['A_GUID'];
					$a_picture = $row['A_PICTURE'];
				?>
		  	<tr>
			  <td style="text-align:center"><?=$no?></td>
			  <td><?=$jongmok_name ?></td>
			  <td><?=$category_name ?></td>
			  <td><?=$aname ?></td>
			  <td style="text-align:center"><?=$a_cnt?></td>
			  <td style="display:none;"><?=$a_guid?></td>
			</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="4" style="text-align:right"><b>Total:</b></td>				
				<td style="text-align:center"><?=number_format($tcnt)?></td>
			</tr>
		</table>
		<hr>
            
		</div>
	</div>	
