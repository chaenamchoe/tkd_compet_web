<script>
	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>
<div class="container">
	<div class="row">
		<div class="col text-center">
		<p><h2 class="alert alert-primary"><?php echo $_SESSION['active_competition_name_e']?></h2></p>
		<p><h3><?php echo $_SESSION['login_user_center']?> Register</h3>
		<a class="btn btn-primary" href=<?php echo site_url('compet/add_athlete/')?>>Individual</a>
		<a class="btn btn-primary" href=<?php echo site_url('compet/add_team/')?>>Team</a>
		</p>
		<hr>
		</div>
	</div>
	<div class="row">
		<div class="table-responsive">
		<table id="mytable" class="table table-hover table-sm table-striped">
			<thead class="thead-light">
				<tr>
					<th style="text-align:center">No</th>
					<th>Type</th>
					<th>Category</th>
					<!--<th>Weight</th>-->
					<th>Name</th>
					<!--<th style="text-align:center">Level</th>-->
					<th>DOB</th>
					<th style="text-align:center">Cnt</th>
					<th style="text-align:right">Fee</th>
					<?php if($_SESSION['compet_need_picture']===1){ ?>
					<th style="text-align:center">Photo</th>
					<?php } ?>
					<th style="text-align:center">Edit</th>
					<th style="display:none;">guid</th>
					<th style="text-align:center">Video</th>
					<th style="text-align:center">Video ID</th>
				</tr>
			</thead>
			<?php
                $compet_id = $_SESSION['compet_id'];
				$no = 0;
				$tprice = 0;
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
					$tprice = $tprice + $price;
					$a_guid = $row['A_GUID'];
					$a_picture = $row['A_PICTURE'];
					$video_id = $row['VIDEO_ID'];
					$video_id2 = $row['VIDEO_ID2'];
					$video_id3 = $row['VIDEO_ID3'];
				?>
		  	<tr>
			  <td style="text-align:center"><?=$no?></td>
			  <td><?=$jongmok_name ?></td>
			  <td><?=$category_name ?></td>
			  <!--<td><?=$weight ?></td>-->
			  <td><?=$aname ?></td>
			  <!--<td style="text-align:center"><?=$ayear?></td>-->
			  <td><?=$jumin_hidden?></td>
			  <td style="text-align:center"><?=$a_cnt?></td>
			  <td style="text-align:right"><?=number_format($price)?></td>
			  <?php if($_SESSION['compet_need_picture']===1){ ?>
			  <td style="text-align:center">
			  <?php if (strlen($a_picture) > 10){ ?>
					<a href="http://ccnplaza.com/tkd_compet/uploads/<?=$compet_id?>/<?=$a_picture?>" data-toggle="lightbox" data-title="확대조회">
					<img class="fit-picture" height="30px" width="30px" src="http://ccnplaza.com/tkd_compet/uploads/<?=$compet_id?>/<?=$a_picture?>">
					</a>
			  <?php } ?>
			  </td>
			  <?php } ?>
			  <td style="text-align:center">
			  	<!--개인 -->
				<?php if($single_val == 1){ ?>	
					<a href=<?php echo site_url('compet/edit_athlete/'.$id)?> class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data"><i class="bi bi-pencil-square"></i></a>
				<!--단체 -->
				<?php }else{ ?>
					<a href=<?php echo site_url('compet/edit_team/'.$id)?> class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data"><i class="bi bi-pencil-square"></i></a>
				<?php } ?>
			  	<a href=<?php echo site_url('compet/delete_athlete/'.$id)?> onclick="return confirm('Are you sure to delete?')" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Data"><i class="bi bi-x-circle"></i></a>
			  </td>
			  <td style="text-align:center">
				<a href=<?php echo site_url("compet/add_video_file/$id")?> class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Attach video file"><i class="bi bi-play-btn"></i></a>
			  </td>
			  <td style="display:none;"><?=$a_guid?></td>
			  <?php if($_SESSION['VIDEO_CNT'] == 3){ ?>
			  <td style="text-align:center">
				<a href="https://vimeo.com/<?=$video_id?>" class="btn btn-primary btn-sm" target="_blank">VIDEO1 <a href="https://vimeo.com/<?=$video_id2?>" class="btn btn-primary btn-sm" target="_blank">VIDEO2 <a href="https://vimeo.com/<?=$video_id3?>" class="btn btn-primary btn-sm" target="_blank">VIDEO3
			  </td>
			  <?php }else{ ?>
			  <td style="text-align:center">
			  <?php if(isset($video_id)){ ?>
			  <a href="https://vimeo.com/<?=$video_id?>" class="btn btn-primary btn-sm" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="View video file"><?=$video_id?>
			  <?php } ?>
			  </td>
			  <?php } ?>
			</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="7" style="text-align:right"><b>Total Fee : </b></td>				
				<td style="text-align:right"><?=number_format($tprice)?></td>
				<td colspan="4"></td>
			</tr>
		</table>
		<hr>
            
		</div>
	</div>	
