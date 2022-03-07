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
		<!--<a class="btn btn-primary" href=<?php echo site_url('compet/recalc_attend_price/')?>>����������</a>-->
		<!--<button class="btn btn-primary" id="csvDownloadButton">CSV �ٿ�ε�</button>-->
		</p>
		<hr>
		</div>
	</div>
	<div class="row">
		<div class="">
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
			  <div style="display:none;"><?=$a_guid?></div>
		  	<tbody><tr>
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
					<a href=<?php echo site_url("compet/edit_athlete/$id")?> class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="�ڷ����"><i class="bi bi-pencil-square"></i></a>
				<!--��ü -->
				<?php }else{ ?>
					<a href=<?php echo site_url("compet/edit_team/$id")?> class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="�ڷ����"><i class="bi bi-pencil-square"></i></a>
				<?php } ?>
					<a href=<?php echo site_url("compet/delete_athlete/$id")?> onclick="return confirm('���� �����ұ��?')" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="�ڷ����"><i class="bi bi-x-circle"></i></a>
				<?php } ?>
			  </td>
			  <td style="text-align:center">
				<a href=<?php echo site_url("compet/add_video_file/$id")?> class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="�������� ÷��"><i class="bi bi-play-btn"></i></a>
			  </td>
			  <?php if($_SESSION['VIDEO_CNT'] == 3){ ?>
			  <td style="text-align:center">
				<a href="https://vimeo.com/<?=$video_id?>" class="btn btn-primary btn-sm" target="_blank"><i class="bi bi-play-btn"></i>1 <a href="https://vimeo.com/<?=$video_id2?>" class="btn btn-primary btn-sm" target="_blank"><i class="bi bi-play-btn"></i>2 <a href="https://vimeo.com/<?=$video_id3?>" class="btn btn-primary btn-sm" target="_blank"><i class="bi bi-play-btn"></i>3
			  </td>
			  <?php }else{ ?>
			  <td style="text-align:center">
				<?php if(isset($video_id)){ ?>
					<a href="http://player.vimeo.com/video/<?=$video_id?>" data-toggle="lightbox" data-width="1080" class="btn btn-primary btn-sm"><?=$video_id?></a>
					<!-- <a href="https://vimeo.com/<?=$video_id?>" class="btn btn-primary btn-sm" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="�������� Ȯ��"><?=$video_id?> -->
				<?php } ?>
			  </td>
			  <?php } ?>
			</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="7" style="text-align:right"><b>������ �Ѿ�</b></td>				
				<td style="text-align:right"><b><?=number_format($tprice).'��'?></b></td>
				<td colspan="4"></td>
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