<div class="container">
  <br/>  
    <div class="row">
        <div class="col text-center">
        <h4>등록도장 검색</h4>
        <hr>
        </div>
	</div>	
    <div class="row">
		<div class="col-sm-4">
		</div>
		<div class="col-sm-4">
			<form class="form-inline" id="login-form" action=<?php echo site_url("Compet/find_center")?> method="post">
				<div class="form-group">
					<div class="input-group">
						  <input type="text" id="center_name" name="center_name" class="form-control" placeholder="도장명을 입력하세요." required>
					</div>
					<div class="input-group">
						<button class="btn btn-primary" type="submit"> 도장명검색 </button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="table-responsive">
		<hr>
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
                if (!empty($center_info)){
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
				<?php endforeach; } ?>
		</table>
		<hr>
            
		</div>
	</div>	

        