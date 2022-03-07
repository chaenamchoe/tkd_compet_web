<script type="text/javascript">
    $(document).ready(function() {
		$("#pic0").click(function () {
			$("#file_name0").trigger('click');
		});
		$("#pic1").click(function () {
			$("#file_name1").trigger('click');
		});
		$("#pic2").click(function () {
			$("#file_name2").trigger('click');
		});
		$("#pic3").click(function () {
			$("#file_name3").trigger('click');
		});
		$("#pic4").click(function () {
			$("#file_name4").trigger('click');
		});

		var uniq_no = Math.floor(+ new Date());
		$("#a_guid").val(uniq_no);
        $('#jongmok').change(function() {
			var jongmok_str = $('#jongmok option:selected').text();
            $("#category > option").remove();
            var jongmok_id = $(this).val();
			if(jongmok_id != ''){
				$.ajax({
					type: "POST",
					dataType: "json",
					url: "<?php echo site_url('compet/get_category/')?>",
					data:{id: jongmok_id},
					success: function(category)
					{
						$.each(category, function(ID, CATEGORY_NAME)
						{
							var opt = $('<option />');
							opt.val(ID);
							opt.text(CATEGORY_NAME[0]);
							$('#category').append(opt);
							$('#att_price').val(CATEGORY_NAME[1]);
							$('#total_price').val(CATEGORY_NAME[1]);
						});
						$("#category").html($('#category option').sort(function(x, y) {        
							return $(x).text().toUpperCase() < $(y).text().toUpperCase() ? -1 : 1;
						}));
						//$('#category').trigger('change');
					},
					error:function(request,status,error){
						alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
					}
				});
			}else{
				$('#category').html('<option value="">�г�θ� �����ϼ���</option>');
			}
        });
       
/*        $('#category').change(function() {
            //$("#weight > option").remove();
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
*/	
    });
</script>
<script>
	function displayJumin(idx) {
		var a_name = document.getElementById("a_name"+idx).value;
		var a_jumin = document.getElementById("a_jumin"+idx).value;
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "<?php echo site_url('compet/get_athlete_name')?>",
			data:{a_name : a_name},
			success: function(athlete)
			{
				alert(athlete);
			},
			error:function(request,status,error){
				alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
	}
	function myFunction(val){
		var video_url = val.value;
		if(video_url!=""){
			if(video_url.length > 11){
				val.value = ytid(video_url);
			}
		}
	}
	function ytid(video_url){
		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
		var match = video_url.match(regExp);
		return (match&&match[7].length==11)? match[7] : false;
	}
</script>
<div class="container">
  <br/>  
    <div class="row justify-content-center">
        <div class="col col-sm-10 text-center">
        <h2 class="alert alert-primary"><?php echo $_SESSION['active_competition_name']?></h2>
		<font style="color:blue"><b><p><h4>������ �������� ���</h4></p></b></font>
        <hr>
        </div>
    </div>
    <form id="login-form" action=<?php echo site_url("compet/save_athlete");?> method="post" enctype="multipart/form-data">
    <div class="row justify-content-center">
		<div class="col-sm-4">
  			<div class="form-group row">
				<label for="aname" class="col-sm-3 col-form-label text-right">����:</label>
				<div class="col-sm-8">
					<select class="form-control" name="jongmok" id="jongmok" required>
						<option value="">������ �����ϼ���</option>
						<?php 
						foreach($jongmok as $row) {
							$j_id=$row['ID'];
							$jongmok_name = $row['JONGMOK_NAME'];
							$single_val = $row['SINGLE_GROUP'];
							?>	
						<option value="<?=$j_id?>"><?php echo $jongmok_name; ?></option>
						<?php } ?>
					</select>
				</div>	
			</div>	
				<input type="hidden" id="single_group" name="single_group" value=<?=$single_val?> />
  			<div class="form-group row">
				<label for="aname" class="col-sm-3 col-form-label text-right">�г��:</label>
				<div class="col-sm-8">
					<select class="form-control" name="category" id="category" required>
						<option value="">�г�θ� �����ϼ���</option>
						<?php foreach($category as $row) { 
							$c_id=$row['ID'];
							$category_name = $row['CATEGORY_NAME'];
							$price = $row['ATT_PRICE'];
						?>	
						<option <?php if ($c_id == 0) echo 'selected' ; ?> value="<?=$c_id?>"><?php echo $category_name; ?></option>
						<?php } ?>
					</select>
				</div>	
            </div>
  			<!--
			<div id="weight_row" class="form-group row">
				<label for="aname" class="col-sm-3 col-form-label text-right">ü��:</label>
				<div class="col-sm-8">
					<select class="form-control" name="weight" id="weight">
						<?php foreach($weight as $row) { 
							$w_id=$row['ID'];
							$weight_name = $row['W_NAME'];
							$weight_desc = $row['W_DESC'];
							$weight_str = $weight_name . '(' . $weight_desc . ')';
							?>	
						<option <?php if ($_SESSION['last_weight_id'] == $w_id) echo 'selected' ; ?> value="<?=$w_id?>"><?php echo $weight_str; ?></option>
						<?php } ?>
					</select>
				</div>	
            </div>
			-->
            <input type="hidden" id="att_price" name="att_price" value=<?=$price ?> />
            <input type="hidden" id="total_price" name="total_price" value=<?=$price ?> />
            <input type="hidden" id="ath_count" name="ath_count" value="1"/>
			<input type="hidden" id="a_guid" name="a_guid" value=""/>
			<!--<p id="attend_total">������ : <?=$price ?> �� * 1�� = <?=$price?>��</p>-->
			<div class="text-center">
				<font style="color:red">
				<b>
				<p>���� ����, ���� �г���� ��������</br>
					�ѹ��� 5�����	�Է��� �� �ֽ��ϴ�.</br></br>
					�������� �ִ� �ڷ�鸸</br>
					����˴ϴ�. �ֹι�ȣ�� ���ڸ� �Է�.
					</p>
				</b>
				</font>
			</div>	
        </div>
        <div class="col-sm-6">    
            <table class="table table-sm" id="athlete">
				<thead>
				<tr>
				  <th scope="col" width="30px">#</th>
				  <th scope="col" width="200px">������</th>
				  <th scope="col" width="200px">�������</th>
				  <!--<th scope="col" width="100px">�г�</th>-->
				  <!-- <?php if($_SESSION['compet_need_picture']===1){ ?>
				  <th>����</th>
				  <?php } ?> -->
				</tr>
				</thead>
				<tbody>
					<?php for ($i=0;$i<5;$i++){ ?>
					<tr>
					<td><input type="button" class="btn btn-warning btn-sm" value="<?= $i+1 ?>" disabled></input></td>
					<!--<td><input type="text" class="form-control" id="a_name<?=$i?>" name="a_name<?=$i?>" maxlength="50" onfocusout="displayJumin(<?=$i?>)"></input></td>-->
					<td><input type="text" class="form-control" id="a_name<?=$i?>" name="a_name<?=$i?>" maxlength="50"></input></td>
					<td><input type="number" class="form-control" id="a_jumin<?=$i?>" name="a_jumin<?=$i?>" maxlength="13"></input></td>
					<!--<td><input type="hidden" class="form-control" id="a_year<?=$i?>" name="a_year<?=$i?>" maxlength="1" value="0"></input></td>-->
					<!-- <?php if($_SESSION['compet_need_picture']===1){ ?>
					<td>
						<input type="file" id="file_name<?=$i?>" name="file_name<?=$i?>" accept="image/jpeg" ></p>
					</td>
					<?php } ?> -->
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<div class="text-center">
				<p>
				<button type="submit" class="btn btn-primary">�ڷ�����</button>
				<a class="btn btn-primary" href=<?php echo site_url('compet/registed_athlete/')?>>���</a>
				</p>
			</div>
		</div>
	</div>	
    </form>
