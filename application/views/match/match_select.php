<script type="text/javascript">
    $(document).ready(function() {
        $('#category').trigger('change');
        $('#jongmok').change(function() {
            $("#category > option").remove();
            var jongmok_id = $(this).val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "<?php echo site_url('compet/get_category/')?>" + jongmok_id,
                success: function(category)
                {
					$.each(category, function(ID, CATEGORY_NAME)
                    {
                        var opt = $('<option />');
                        opt.val(ID);
                        opt.text(CATEGORY_NAME[0] + '/' + ID);
                        $('#category').append(opt);
                    });
                    $('#category').trigger('change');
                },
				error:function(request,status,error){
					alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			    }
            });
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
	
    });
</script>
<div class="container">
  <br/>  
    <div class="row justify-content-center">
        <div class="col col-sm-12 text-center">
        <h2><?php echo $_SESSION['competition_name']?></h2>
        <hr>
        </div>
    </div>
    <div class="row justify-content-center">
		<div class="col-sm-3">
  			<div class="form-group row">
				<select class="form-control" name="jongmok" id="jongmok">
					<?php 
					foreach($jongmok as $row) {
						$j_id=$row['ID'];
						$jongmok_name = $row['JONGMOK_NAME'];
						$single_val = $row['SINGLE_GROUP'];
						?>	
					<option <?php if (get_cookie('last_jongmok_id') == $j_id) echo 'selected' ; ?> value="<?=$j_id?>"><?php echo $jongmok_name; ?></option>
					<?php } ?>
				</select>
			</div>	
  			<div class="form-group row">
				<select class="form-control" name="category" id="category">
					<?php foreach($category as $row) { 
						$c_id=$row['ID'];
						$category_name = $row['CATEGORY_NAME'];
					?>	
					<option <?php if ($_SESSION['last_category_id'] == $c_id) echo 'selected' ; ?> value="<?=$c_id?>"><?php echo $category_name . "/" . $c_id ?></option>
					<?php } ?>
				</select>
            </div>
			<div class="text-center">
				<a class="btn btn-primary" href=<?php echo site_url('match/match_list/').$c_id?>>확인</a>
			</div>
			<input type="hidden" id="a_guid" name="a_guid" value=""/>
        </div>
        <div class="col-sm-9">    
            <table class="table table-sm" id="athlete">
				<thead>
				<tr>
				  <th scope="col" width="30px">조No</th>
				  <th scope="col" width="30px">번호</th>
				  <th scope="col" width="100px">선수명</th>
				  <th scope="col" width="300px">도장명</th>
				</tr>
				</thead>
				<tbody>
					<?php foreach($match_list as $match){ ?>
					<tr>
					<td><?=$match['GAME_SET']?></td>
					<td><?=$match['GAME_ID']?></td>
					<td><?=$match['BLUE_ID']?></td>
					
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>	
