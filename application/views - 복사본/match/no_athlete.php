<script src="http://ccnplaza.com/tkd_compet/jquery.rowspanizer.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".rwspan").each(function () {
            $('table').rowspanizer({
			  columns: [0],
			  vertical_align:'middle'
			});
        });
		$('#jongmok').change(function() {
            $("#category > option").remove();
            var jongmok_id = $(this).val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "<?php echo site_url('match/get_category/')?>" + jongmok_id,
                success: function(category)
                {
					$.each(category, function(ID, CATEGORY_NAME)
                    {
                        var opt = $('<option />');
                        opt.val(ID);
                        opt.text(CATEGORY_NAME[0] + '/' + ID);
                        $('#category').append(opt);
                    });
                    //$('#category').trigger('change');
                },
				error:function(request,status,error){
					alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			    }
            });
			window.location.href = "<?php echo site_url('match/match_list/')?>" + jongmok_id;
        });
        $('#category').change(function() {
			var jongmok_id = $('#jongmok').val();
            var category_id = $('#category').val();
			window.location.href = "<?php echo site_url('match/match_list/')?>" + jongmok_id + '/' + category_id;
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
						$applied_cnt = $row['APPLIED_CNT'];
						?>	
					<option <?php if ($jongmok_id == $j_id) echo 'selected' ; ?> value="<?=$j_id?>"><?php echo $jongmok_name . " - " . $applied_cnt."명" ?></option>
					<?php } ?>
				</select>
			</div>	
  			<div class="form-group row">
				<select class="form-control" name="category" id="category">
					<?php foreach($category as $row) { 
						$c_id=$row['ID'];
						$category_name = $row['CATEGORY_NAME'];
						$applied_cnt2 = $row['APPLIED_CNT'];
					?>	
					<option <?php if ($category_id == $c_id) echo 'selected' ; ?> value="<?=$c_id?>"><?php echo $category_name . " - " . $applied_cnt2."명" ?></option>
					<?php } ?>
				</select>
            </div>
			<form id="find-form" action=<?php echo site_url("match/find_athlete/");?> method="post">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="선수명입력" name="a_name" id="a_name">
				<div class="input-group-append">
				  <button type="submit" class="btn btn-primary">검색</button>
				</div>
			</div>
			</form>
        </div>
        <div class="col-sm-9">    
			<div class="text-center">
				<p>등록된 선수가 없습니다.</P>
			</div>
		</div>
	</div>	
	
