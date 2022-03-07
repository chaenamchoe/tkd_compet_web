<script type="text/javascript">
    $(document).ready(function() {
		var jongmok_str = $('#jongmok option:selected').text();
        $('#category').trigger('change');
        $('#jongmok').change(function() {
/*
			var jongmok_str = $('#jongmok option:selected').text();
            if (jongmok_str.search("단체") > 0){
                $("#single_group").val(2);
            } else {
                $("#single_group").val(1);
            }
*/
            $("#category > option").remove();
            var jongmok_id = $(this).val();
			if(jongmok_id != ''){
				$.ajax({
					type: "GET",
					dataType: "json",
					url: "<?php echo site_url('compet/get_category/')?>" + jongmok_id,
					success: function(category)
					{
						$.each(category, function(ID, CATEGORY_NAME_E)
						{
							var opt = $('<option />');
							opt.val(ID);
							opt.text(CATEGORY_NAME_E[0]);
							//opt.text(K_NAME);
							$('#category').append(opt);
							$('#att_price').val(CATEGORY_NAME_E[1]);
							$('#total_price').val(CATEGORY_NAME_E[1]);
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
		<font style="color:blue"><b><p><h4>Edit Indivisual</h4></p></b></font>
        <hr>
        </div>
    </div>
    <form id="login-form" action=<?php echo site_url("compet/update_athlete/".$id); ?> method="post" enctype="multipart/form-data">
    <div class="row">
		<div class="col-sm-2"></div>
        <div class="col-sm-4">
  			<div class="form-group row">
				<label for="aname" class="col-sm-3 col-form-label text-right">Type:</label>
				<div class="col-sm-8">
					<select class="form-control" name="jongmok" id="jongmok">
						<?php 
						foreach($jongmok as $row) {
							$j_id=$row['ID'];
							$jongmok_name = $row['JONGMOK_NAME_E'];
							$single_val = $row['SINGLE_GROUP'];
							?>	
						<option <?php if ($jongmok_id == $j_id) echo 'selected' ; ?> value="<?=$j_id?>"><?php echo $jongmok_name; ?></option>
						<?php } ?>
					</select>
				</div>	
			</div>	
				<input type="hidden" id="single_group" name="single_group" value=<?=$single_val?> />
  			<div class="form-group row">
				<label for="aname" class="col-sm-3 col-form-label text-right">Category:</label>
				<div class="col-sm-8">
					<select class="form-control" name="category" id="category">
						<?php foreach($category as $row) { 
							$c_id=$row['ID'];
							$category_name = $row['CATEGORY_NAME_E'];
							$price = $row['ATT_PRICE'];
						?>	
						<option <?php if ($category_id == $c_id) echo 'selected' ; ?> value="<?=$c_id?>"><?php echo $category_name; ?></option>
						<?php } ?>
					</select>
				</div>	
            </div>
  			<!--
			<div class="form-group row">
				<label for="aname" class="col-sm-3 col-form-label text-right">Weight:</label>
				<div class="col-sm-8">
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
				</div>	
            </div>
			-->
			<?php  if($_SESSION['compet_need_picture'] === 1){ ?>
			<p><b>Photo</b>(only if change)<input type="file" id="file_name" name="file_name" accept="image/jpeg"></p>
			<?php } ?>
            <input type="hidden" id="att_price" name="att_price" value=<?=$price ?> />
            <input type="hidden" id="total_price" name="total_price" value=<?=$price ?> />
            <input type="hidden" id="ath_count" name="ath_count" value="1"/>
			<input type="hidden" id="a_guid" name="a_guid" value=""/>
			<!--<p id="attend_total">참가비 : <?=$price ?> 원 * 1명 = <?=$price?>원</p>-->
        </div>
        <div class="col-sm-4">    
			<div class="form-group row">
				<label for="aname" class="col-sm-4 col-form-label text-right">Name:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="a_name" name="a_name" maxlength="50" value="<?=$a_name?>" required></input>
				</div>
			</div>		
			<div class="form-group row">
				<label for="jumin" class="col-sm-4 col-form-label text-right">Birthday:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="a_jumin" name="a_jumin" value="<?=$a_jumin?>"
						onkeydown="return onlyNumber(event)" onkeyup="removeChar(event)" 
						style="ime-mode:disabled;" required></input>
				</div>
			</div>		
			<div class="form-group row">
				<label for="email" class="col-sm-4 col-form-label text-right">E-mail:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="email" name="email" maxlength="50" value="<?=$a_email?>" required></input>
				</div>
			</div>		
			<div class="form-group row">
				<label for="ayear" class="col-sm-4 col-form-label text-right">Level:</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="a_year" name="a_year" value="<?=$a_year?>"
						onkeydown="return onlyNumber(event)" onkeyup="removeChar(event)" 
						style="ime-mode:disabled;"></input>
				</div>
			</div>		
			<?php if($_SESSION['compet_need_picture']===1){ ?>
			<div class="form-group row">
				<label for="a_picture" class="col-sm-4 col-form-label text-right">Photo:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="a_picture" name="a_picture" value="<?=$a_picture?>" placeholder="file name"></input>
				</div>
			<?php } ?>
			</div>		
		</div>	
    </div>    
	<div class="row text-center">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
		<font style="color:red"><b><p>Save after check event, grade.</p></b></font>
			<p>
				<button type="submit" class="btn btn-primary">Save</button>
				<a class="btn btn-primary" href=<?php echo site_url('compet/registed_athlete/')?>>Cancel</a>
			</p>
		</div>	
	</div>
    </form>
