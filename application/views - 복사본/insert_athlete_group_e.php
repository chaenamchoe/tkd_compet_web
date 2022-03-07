<script type="text/javascript">
    $(document).ready(function() {
		var uniq_no = Math.floor(+ new Date());
		$("#a_guid").val(uniq_no);
		var jongmok_str = $('#jongmok option:selected').text();
        if (jongmok_str.search("단체") > 0){
            $("#single_group").val(3);
        } else {
            $("#single_group").val(1);
        }
        $('#jongmok').trigger('change');
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
            var category_id = $('#category').val();
			var man_cnt = $("#man_cnt").val();
			$("#athlete > tbody").empty();
			for(var i=0;i<man_cnt;i++){
				$("#athlete").append(
					'<tr>'+
					'<td><input type="button" class="btn btn-warning btn-sm" value="' + (i+1) + '" disabled></input></td>'+
					'<td><input type="text" class="form-control" id="a_name'+ i + '" name="a_name'+i+'" maxlength="50"></input></td>'+
					'<td><input type="number" class="form-control" id="a_jumin' + i + '?>" name="a_jumin'+i+'" ></input></td>'+
					'<td><input type="number" class="form-control" id="a_year' + i + '?>" name="a_year'+i+'" value="0"></input></td>'+
					'</tr>');
			}
				
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
        <h2 class="alert alert-primary"><?php echo $_SESSION['active_competition_name']?></h2>
        <font style="color:blue"><b><p><h4>Team Registration</h4></p></b></font>
        <hr>
        </div>
    </div>
    <form id="login-form" action=<?php echo site_url("compet/save_team");?> method="post" enctype="multipart/form-data">
    <div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-3">
            <p><b>Type</b>
            <select class="form-control" name="jongmok" id="jongmok" required>
                <?php if($_SESSION['compet_id'] <> 36){ ?>
				<option value="">Select Major</option>
				<?php } ?>
				<?php 
                foreach($jongmok as $row) {
                    $j_id=$row['ID'];
                    $jongmok_name = $row['JONGMOK_NAME_E'];
					$single_val = $row['SINGLE_GROUP'];
					$c_methode = $row['C_METHODE'];
                    ?>	
                <option <?php if ($j_id==0) echo 'selected' ; ?> value="<?=$j_id?>"><?php echo $jongmok_name; ?></option>
                <?php } ?>
            </select>
            </p>
            <input type="hidden" id="single_group" name="single_group" value=<?=$single_val?> />
            <input type="hidden" id="c_methode" name="c_methode" value=<?=$c_methode?> />
            <p><b>Category</b>
            <select class="form-control" name="category" id="category" required>
                <option value="">Select Category</option>
				<?php foreach($category as $row) { 
                    $c_id=$row['ID'];
                    $category_name = $row['CATEGORY_NAME_E'];
                    $price = $row['ATT_PRICE'];
					$man_cnt = $row['MAN_CNT'];
                ?>	
                <option <?php if ($c_id==0) echo 'selected' ; ?> value="<?=$c_id?>"><?php echo $category_name; ?></option>
                <?php } ?>
            </select>
            </p>
			<?php if($_SESSION['compet_need_picture']===1){ ?>
			<p><b>Upload your photo</b><input type="file" id="file_name" name="file_name" accept="image/jpeg"></p>
			<p><font style="color:red">Please upload a group photo</font></p>
			<?php } ?>
			
        </div>
        <div class="col-sm-5">    
            <table class="table table-sm table-striped" id="athlete">
			  <thead>
				<tr>
				  <th scope="col" width="50px"></th>
				  <th scope="col" width="400px">Name</th>
				  <th scope="col" width="200px">DOB</th>
				  <!--<th scope="col" width="100px">Grade(age)</th>-->
				</tr>
			  </thead>
			  <tbody>
					<?php 
						for ($i=0;$i<$category_man_cnt;$i++){ ?>
					<tr>
					<td><input type="button" class="btn btn-warning btn-sm" value="<?= $i+1 ?>" disabled></input></td>
					<td><input type="text" class="form-control" id="a_name<?=$i ?>" name="a_name<?=$i ?>" maxlength="50"></input></td>
					<td><input type="number" class="form-control" id="a_jumin<?=$i ?>" name="a_jumin<?=$i ?>" ></input></td>
					<td><input type="hidden" class="form-control" id="a_year<?=$i ?>" name="a_year<?=$i ?>" value="0"></input></td>
					</tr>
					<?php } ?>
			  </tbody>
			</table>
            <!--<p>First name as team name(First name + Team)</p>-->
			<input type="hidden" id="man_cnt" name="man_cnt" value=<?=$category_man_cnt ?>>
            <input type="hidden" id="att_price" name="att_price" value=<?=$price ?> />
            <input type="hidden" id="total_price" name="total_price" value=<?=$price ?> />
            <input type="hidden" id="ath_count" name="ath_count" value="1"/>
			<input type="hidden" id="a_guid" name="a_guid" value=""/>
			<!--<p id="attend_total">참가비 : <?=$price ?> 원 * 1명 = <?=$price?>원</p>-->
			<div class="text-center">
				<font style="color:red"><b><p>Enter the player’s name to save the data.</p></b></font>
				<p>
					<button type="submit" class="btn btn-primary">Save</button>
					<a class="btn btn-primary" href=<?php echo site_url('compet/registed_athlete/')?>>Cancel</a>
				</p>
			</div>
			 
		</div>	
    </div>    
    </form>
