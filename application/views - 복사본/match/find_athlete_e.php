<style>
.modal.modal-fullscreen .modal-dialog {
  width:100vw;
  height:100vh;
  margin:0;
  padding:0;
  max-width:none;
}
.modal.modal-fullscreen .modal-content {
  height:auto;
  height:100vh;
  border-radius:0;
  border:none;
}
.modal.modal-fullscreen .modal-body {
  overflow-y:auto;
}

h1 {font-size:3rem;} /*1rem = 16px*/
img.fit-picture{width:30px; height:20px;}
div.logo {width:30px; height:20px;}
/* Small devices (landscape phones, 544px and up) */
@media (max-width: 1024px) {  
	div.logo {
		display:none;
	}
	h1 {font-size:2rem;}	
}
</style>

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
			window.location.href = "<?php echo site_url('match/match_list_e/')?>" + jongmok_id;
        });
        $('#category').change(function() {
			var jongmok_id = $('#jongmok').val();
            var category_id = $('#category').val();
			window.location.href = "<?php echo site_url('match/match_list_e/')?>" + jongmok_id + '/' + category_id;
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
						$jongmok_name = $row['JONGMOK_NAME_E'];
						$applied_cnt = $row['APPLIED_CNT'];
						?>	
					<option <?php if ($jongmok_id == $j_id) echo 'selected' ; ?> value="<?=$j_id?>"><?php echo $jongmok_name . " - " . $applied_cnt ?></option>
					<?php } ?>
				</select>
			</div>	
  			<div class="form-group row">
				<select class="form-control" name="category" id="category">
					<?php foreach($category as $row) { 
						$c_id=$row['ID'];
						$category_name = $row['CATEGORY_NAME_E'];
						$applied_cnt2 = $row['APPLIED_CNT'];
					?>	
					<option <?php if ($category_id == $c_id) echo 'selected' ; ?> value="<?=$c_id?>"><?php echo $category_name . " - " . $applied_cnt2 ?></option>
					<?php } ?>
				</select>
            </div>
			<form id="find-form" action=<?php echo site_url("match/find_athlete/");?> method="post">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Type athlete name" name="a_name" id="a_name">
				<div class="input-group-append">
				  <button type="submit" class="btn btn-primary">Search</button>
				</div>
			</div>
			<div class="logo">
				<a href="https://smartsm.co.kr/"><img src="http://ccnplaza.com/img/sm_logo_s.jpg" width="250px"></img></a>
			</div>
			</form>
        </div>
        <div class="col-sm-9">    
            <table class="table table-bordered table-hover table-response table-sm" id="athlete">
				<thead class="thead-dark">
				<tr>
				  <th scope="col" width="100px">Athlete</th>
				  <th scope="col" width="300px">Center Name</th>
				  <th scope="col" width="300px">Category</th>
				  <th scope="col" width="300px">Kind</th>
				  <th scope="col" width="100px">Match</th>
				</tr>
				</thead>
				<tbody>
					<?php 
						foreach($result as $row){ ?>
							<tr>
							<td><b><?=$row['A_NAME']?></b></td>
							<td><?=$row['CENTER_NAME']?></td>
							<td><?=$row['JONGMOK_NAME']?></td>
							<td><?=$row['CATEGORY_NAME']?></td>
							<td><a href='<?php echo site_url("match/match_list_e/".$row['JONGMOK_ID'].'/'.$row['CATEGORY_ID']);?>' class="btn btn-primary btn-sm">Move to Match</a></td>
							</tr>
						<?php }
					?>
				</tbody>
			</table>
		</div>
	</div>	
	
