<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
-->
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
		<p><h2 class="alert alert-primary"><?php echo $_SESSION['active_competition_name']?></h2></p>
		<p><h3><?php echo $_SESSION['login_user_center']?> ��û��Ȳ</h3>
		<?php if($_SESSION['compet_mode'] == 2){ ?> 
		<a class="btn btn-primary" href=<?php echo site_url('compet/add_athlete/')?>>������ ���</a>
		<a class="btn btn-primary" href=<?php echo site_url('compet/add_team/')?>>��ü�� ���</a>
		<?php } ?>
		<!--<button class="btn btn-primary" id="csvDownloadButton">CSV �ٿ�ε�</button>-->
		</p>
		<hr>
		</div>
	</div>
	<div class="row">
		<div class="table-responsive">
		<table id="mytable" class="table table-hover table-sm table-striped">
			<thead class="thead-light">
				<tr>
					<th style="text-align:center">��Ϲ�ȣ</th>
					<th>����</th>
					<th>�г��</th>
					<th>ü��</th>
					<th>������</th>
					<!--<th style="text-align:center">�г�</th>-->
					<th>�������</th>
					<th style="text-align:center">�ο�</th>
					<th style="text-align:right">������</th>
					<?php if($_SESSION['compet_need_picture']===1){ ?>
					<th style="text-align:center">����</th>
					<?php } ?>
					<th style="text-align:center">����</th>
					<!--<th style="display:none;">guid</th>-->
					<th style="text-align:center">Video</th>
					<th style="text-align:center">VideoID</th>
				</tr>
			</thead>
			<?php
                $compet_id = $_SESSION['compet_id'];
				$no = 0;
				$tprice = 0;
				foreach ($results as $row):
					$no++;
					$id = $row['ID'];
                    $jongmok_name = $row['JONGMOK_NAME'];
					$jongmok_id = $row['JONGMOK_ID'];
					$category_name = $row['CATEGORY_NAME'];
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
		  	<tbody><tr>
			  <div style="display:none;"><?=$a_guid?></div>
			  <td style="text-align:center"><?=$id?></td>
			  <td><?=$jongmok_name ?></td>
			  <td><?=$category_name ?></td>
			  <td><?=$weight ?></td>
			  <td><?=$aname ?></td>
			  <!--<td style="text-align:center"><?=$ayear?></td>-->
			  <td><?=$jumin_hidden?></td>
			  <td style="text-align:center"><?=$a_cnt?></td>
			  <td style="text-align:right"><?=number_format($price)?>��</td>
			  <?php if($_SESSION['compet_need_picture']===1){ ?>
			  <td style="text-align:center">
				<?php if (strlen($a_picture) > 10){ ?>
					<a href=<?php echo "http://ccnplaza.com/tkd_compet/uploads/$compet_id/$a_picture"; ?> data-toggle="lightbox" data-title="Ȯ����ȸ">
					<img class="fit-picture" height="30px" width="30px" src="http://ccnplaza.com/tkd_compet/uploads/<?=$compet_id?>/<?=$a_picture?>">
					</a>
			  <?php } ?> 
			  </td>
			  <?php } ?>
			  <td style="text-align:center">
			  	<!--���� -->
				<?php if($_SESSION['compet_mode'] == 2){ ?>
				<?php if($single_val == 1){ ?>	
					<a href=<?php echo site_url("compet/edit_athlete/$id")?> class="btn btn-primary btn-sm">����</a>
				<!--��ü -->
				<?php }else{ ?>
					<a href=<?php echo site_url("compet/edit_team/$id")?> class="btn btn-primary btn-sm">����</a>
				<?php } ?>
					<a href=<?php echo site_url("compet/delete_athlete/$id")?> onclick="return confirm('���� �����ұ��?')" class="btn btn-primary btn-sm">����</a>
				<?php } ?>
			  </td>
			  <td style="text-align:center">
				<a href=<?php echo site_url("compet/add_video_file/$id")?> class="btn btn-primary btn-sm">����÷��</a>
			  </td>
			  <?php if($_SESSION['VIDEO_CNT'] == 3){ ?>
			  <td style="text-align:center">
				<a href="https://vimeo.com/<?=$video_id?>" class="btn btn-primary btn-sm" target="_blank">����1 <a href="https://vimeo.com/<?=$video_id2?>" class="btn btn-primary btn-sm" target="_blank">����2 <a href="https://vimeo.com/<?=$video_id3?>" class="btn btn-primary btn-sm" target="_blank">����3
			  </td>
			  <?php }else{ ?>
			  <td style="text-align:center">
				<?php if(isset($video_id)){ ?>
					<a href="https://vimeo.com/<?=$video_id?>" class="btn btn-primary btn-sm" target="_blank"><?=$video_id?>
				<?php } ?>
			  </td>
			  <?php } ?>
			</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="7" style="text-align:right"><b>������ �Ѿ�</b></td>				
				<td style="text-align:right"><?=number_format($tprice).'��'?></td>
				<td colspan="4">
			</tr></tbody>
		</table>
		<hr>
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  </div>
			  <div class="modal-body">
				...
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			  </div>
			</div>
		  </div>
		</div>
		<!-- Modal End -->            
		</div>
	</div>	


