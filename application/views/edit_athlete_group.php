<script type="text/javascript">
    $(document).ready(function() {
		var jongmok_str = $('#jongmok option:selected').text();
        if (jongmok_str.search("단체") > 0){
            $("#single_group").val(2);
        } else {
            $("#single_group").val(1);
        }
        $('#jongmok').change(function() {
            $("#category > option").remove();
            var jongmok_id = $(this).val();
			if(jongmok_id != ''){
				$('#man_cnt').val(jongmok_id);
				$.ajax({
					type: "POST",
					dataType: "json",
					data:{id: jongmok_id},
					url: "<?php echo site_url('compet/get_category/')?>",
					success: function(category)
					{
						$.each(category, function(ID, CATEGORY_NAME)
						{
							var opt = $('<option />');
							opt.val(ID);
							opt.text(CATEGORY_NAME[0]);
							//opt.text(K_NAME);
							$('#category').append(opt);
							$('#att_price').val(CATEGORY_NAME[1]);
							$('#man_cnt').val(CATEGORY_NAME[2]);
						});
						$('#category').trigger('change');
					},
					error:function(request,status,error){
						alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
					}
				});
			}else{
				$('#category').html('<option value="">Select school kind</option>');
			}
        });       
        $('#category').change(function() {
            $("#weight > option").remove();
            var category_id = $('#category').val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "<?php echo site_url('compet/get_weight/')?>" + category_id,
                success: function(weight)
                {
					$.each(weight, function(ID, W_NAME)
					{
						var opt = $('<option />');
						var w_str = '';
						opt.val(ID);
						if(W_NAME[1].length > 0){
							w_str = W_NAME[0] + '(' + W_NAME[1] + ')';
						}else{
							w_str = W_NAME[0];
						}
						opt.text(w_str);
						$('#weight').append(opt);
					});
                },
				error:function(request,status,error){
					alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			    }
            });
        });
		$('#video_id').change(function(){
			var video_url = document.getElementById('video_id').value;
			if(video_url!=""){
				if(video_url.length > 11){
					ytid(video_url);
					document.getElementById("video_id").value = ytid(video_url);
				}
			}
		});
		function ytid(video_url){
			var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
			var match = video_url.match(regExp);
			return (match&&match[7].length==11)? match[7] : false;
		}
    });
</script>
<div class="container">
  <br/>  
    <div class="row">
        <div class="col text-center">
        <h2><?php echo $_SESSION['active_competition_name']?></h2>
        <font style="color:blue"><b><p><h4>단체전 출전선수 등록</h4></p></b></font>
        <hr>
        </div>
    </div>
    <form id="login-form" action=<?php echo site_url("compet/update_team/".$a_id);?> method="post" enctype="multipart/form-data">
    <div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-3">
            <p><b>종목선택</b>
            <select class="form-control" name="jongmok" id="jongmok">
                <?php 
                foreach($jongmok as $row) {
                    $j_id=$row['ID'];
                    $jongmok_name = $row['JONGMOK_NAME'];
					$single_val = $row['SINGLE_GROUP'];
                    ?>	
                <option <?php if ($jongmok_id == $j_id) echo 'selected' ; ?> value="<?=$j_id?>"><?php echo $jongmok_name; ?></option>
                <?php } ?>
            </select>
            </p>
            <input type="hidden" id="single_group" name="single_group" value=<?=$single_val?> />
            <p><b>학년부선택</b>
            <select class="form-control" name="category" id="category">
                <?php foreach($category as $row) { 
                    $c_id=$row['ID'];
                    $category_name = $row['CATEGORY_NAME'];
                    $price = $row['ATT_PRICE'];
					$man_cnt = $row['MAN_CNT'];
                ?>	
                <option <?php if ($category_id == $c_id) echo 'selected' ; ?> value="<?=$c_id?>"><?php echo $category_name; ?></option>
                <?php } ?>
            </select>
            </p>
			<!--
            <p><b>3. 체급선택</b>
            <select class="form-control" name="weight" id="weight">
                <?php foreach($weight as $row) { 
                    $w_id=$row['ID'];
                    $weight_name = $row['W_NAME'];
                    $weight_desc = $row['W_DESC'];
                    $weight_str = $weight_name . '(' . $weight_desc . ')';
                    ?>	
                <option <?php if ($weight_id == $w_id) echo 'selected' ; ?> value="<?=$w_id?>"><?php echo $weight_str; ?></option>
                <?php } ?>
            </select>
            </p>
			-->
            <p><b>팀명(자동생성)</b>
				<input type="text" class="form-control" id="team_name" name="team_name" value=<?=$team_name ?> />
			</p>
			<input type="hidden" id="man_cnt" name="man_cnt" value=<?=$man_cnt ?>>
            <input type="hidden" id="att_price" name="att_price" value=<?=$price ?> />
            <input type="hidden" id="ath_count" name="ath_count" value="1"/>
			<input type="hidden" id="a_guid" name="a_guid" value=<?=$a_guid ?>/>
			<!--<p id="attend_total">참가비 : <?=$price ?> 원 * 1명 = <?=$price?>원</p>-->
        </div>
        <div class="col-sm-5">    
            <table class="table table-sm table-striped" id="athlete">
			  <thead>
				<tr>
				  <th scope="col" width="50px"></th>
				  <th scope="col" width="200px">선수명</th>
				  <th scope="col" width="200px">주민번호</th>
				  <th scope="col" width="100px">학년</th>
				</tr>
			  </thead>
			  <tbody>
					<?php 
					$i = 0;
					foreach($team_list as $row) {
						$w_id=$row['ID'];
						$a_name = $row['A_NAME'];
						$a_jumin = $row['A_JUMIN'];
						$a_year = $row['A_YEAR'];
					?>	
					<tr>
					<td><input type="button" class="btn btn-warning btn-sm" value="<?= $i+1 ?>" disabled></input></td>
					<td><input type="text" class="form-control" id="a_name<?=$i ?>" name="a_name<?=$i ?>" value=<?=$a_name ?> maxlength="50"></input></td>
					<td><input type="number" class="form-control" id="a_jumin<?=$i ?>" name="a_jumin<?=$i ?>" value=<?=$a_jumin ?>></input></td>
					<td><input type="number" class="form-control" id="a_year<?=$i ?>" name="a_year<?=$i ?>" value=<?=$a_year ?>></input></td>
					</tr>
					<?php 
						$i++; } 
						if ($i < $category_man_cnt){ 
							for ($t=$i; $t < $category_man_cnt; $t++){
						?>
							<tr>
							<td><input type="button" class="btn btn-warning btn-sm" value="<?= $t+1 ?>" disabled></input></td>
							<td><input type="text" class="form-control" id="a_name<?=$t ?>" name="a_name<?=$t ?>" maxlength="50"></input></td>
							<td><input type="number" class="form-control" id="a_jumin<?=$t ?>" name="a_jumin<?=$t ?>" ></input></td>
							<td><input type="number" class="form-control" id="a_year<?=$t ?>" name="a_year<?=$t ?>" value="0"></input></td>
							</tr>
						<?php }
						}
					?>
			  </tbody>
			</table>
			<div class="text-center">
			<?php if($_SESSION['compet_need_picture']===1){ ?>
				<p><b>사진파일첨부</b>
				<?php if(!empty($a_picture)){
					echo '('.$a_picture.')';
				}else{	echo ""; } ?>
				<input type="hidden" id="a_picture2" name="a_picture2" value=<?=$a_picture ?>>
				<br><input type="file" id="file_name" name="file_name" accept="image/jpeg"></p>
			<?php } ?>
				<font style="color:red"><b><p>선수명이 입력된 자료만 저장됩니다.</p></b></font>
				<p>
					<button type="submit" class="btn btn-primary">자료저장</button>
					<a class="btn btn-primary" href=<?php echo site_url('compet/registed_athlete/')?>>취소</a>
				</p>
			</div>
		</div>	
    </div>    
    </form>
