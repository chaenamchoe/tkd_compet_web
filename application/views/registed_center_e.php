<div class="container">
	<div class="row">
		<div class="col text-center">
		<p><h2><?php echo $_SESSION['login_user_center']?> 등록도장 검색결과</h2>
		<hr>
		</div>
	</div>
	<?php 
		if (!empty($center_info)){
	?>
	<div class="row">
		<div class="table-responsive">
		<table class="table table-hover table-sm">
			<thead class="thead-light">
				<tr>
					<th style="text-align:center">No</th>
					<th>도장명</th>
					<th>관장명</th>
					<th>이메일</th>
					<th>주소</th>
				</tr>
			</thead>
			<?php
                $no = 0;
				foreach ($center_info as $row):
					$no++;
					$id = $row['ID'];
                    $center_name = $row['CENTER_NAME'];
					$c_name = $row['C_NAME'];
					$addr = $row['ADDR1'];
					$email = $row['EMAIL'];
				?>
		  	<tr>
			  <td style="text-align:center"><?=$no?></td>
			  <td><?=$center_name ?></td>
			  <td><?=$c_name ?></td>
			  <td><?=$email ?></td>
			  <td><?=$addr ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
		<hr>
            
		</div>
	</div>	
	<?php }else{ ?>
    <form id="login-form" action=<?php echo site_url("Compet/find_center")?> method="post">
	<div class="row">
		<div class="col text-center">
			<h3><p>등록된 도장이 없습니다.</p></h3>
		    <p>
                <button id="submit" type="submit" class="btn btn-primary"> 재검색 </button>
				<a href=<?php echo site_url("compet/login");?> class="btn btn-primary"> 로그인 </a>
				<a href=<?php echo site_url('compet/regist_center')?> class="btn btn-primary">단체(도장)등록</a>
			</p>
		</div>	
	</div>	
	</form>
	<?php }	?>
		