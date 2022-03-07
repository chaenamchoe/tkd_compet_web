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
		<p><h3><?php echo $_SESSION['login_user_center']?> 신청현황</h3>
		<?php if($_SESSION['compet_mode'] == 2){ ?> 
		<a class="btn btn-primary" href=<?php echo site_url('compet/add_athlete/')?>>개인전 등록</a>
		<a class="btn btn-primary" href=<?php echo site_url('compet/add_team/')?>>단체전 등록</a>
		<?php } ?>
		<!--<button class="btn btn-primary" id="csvDownloadButton">CSV 다운로드</button>-->
		</p>
		<hr>
		</div>
	</div>
	<div class="row">
		<div class="table-responsive">
		<table id="mytable" class="table table-hover table-sm table-striped">
			<thead class="thead-light">
				<tr>
					<th style="text-align:center">등록번호</th>
					<th>종목</th>
					<th>학년부</th>
					<th>체급</th>
					<th>선수명</th>
					<!--<th style="text-align:center">학년</th>-->
					<th>생년월일</th>
					<th style="text-align:center">인원</th>
					<th style="text-align:right">참가비</th>
					<?php if($_SESSION['compet_need_picture']===1){ ?>
					<th style="text-align:center">사진</th>
					<?php } ?>
					<th style="text-align:center">수정</th>
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
			  <td style="text-align:right"><?=number_format($price)?>원</td>
			  <?php if($_SESSION['compet_need_picture']===1){ ?>
			  <td style="text-align:center">
				<?php if (strlen($a_picture) > 10){ ?>
					<a href=<?php echo "http://ccnplaza.com/tkd_compet/uploads/$compet_id/$a_picture"; ?> data-toggle="lightbox" data-title="확대조회">
					<img class="fit-picture" height="30px" width="30px" src="http://ccnplaza.com/tkd_compet/uploads/<?=$compet_id?>/<?=$a_picture?>">
					</a>
			  <?php } ?> 
			  </td>
			  <?php } ?>
			  <td style="text-align:center">
			  	<!--개인 -->
				<?php if($_SESSION['compet_mode'] == 2){ ?>
				<?php if($single_val == 1){ ?>	
					<a href=<?php echo site_url("compet/edit_athlete/$id")?> class="btn btn-primary btn-sm">수정</a>
				<!--단체 -->
				<?php }else{ ?>
					<a href=<?php echo site_url("compet/edit_team/$id")?> class="btn btn-primary btn-sm">수정</a>
				<?php } ?>
					<a href=<?php echo site_url("compet/delete_athlete/$id")?> onclick="return confirm('정말 삭제할까요?')" class="btn btn-primary btn-sm">삭제</a>
				<?php } ?>
			  </td>
			  <td style="text-align:center">
				<a href=<?php echo site_url("compet/add_video_file/$id")?> class="btn btn-primary btn-sm">비디오첨부</a>
			  </td>
			  <?php if($_SESSION['VIDEO_CNT'] == 3){ ?>
			  <td style="text-align:center">
				<a href="https://vimeo.com/<?=$video_id?>" class="btn btn-primary btn-sm" target="_blank">비디오1 <a href="https://vimeo.com/<?=$video_id2?>" class="btn btn-primary btn-sm" target="_blank">비디오2 <a href="https://vimeo.com/<?=$video_id3?>" class="btn btn-primary btn-sm" target="_blank">비디오3
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
				<td colspan="7" style="text-align:right"><b>참가비 총액</b></td>				
				<td style="text-align:right"><?=number_format($tprice).'원'?></td>
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


