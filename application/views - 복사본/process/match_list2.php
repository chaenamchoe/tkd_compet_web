<script src="http://ccnplaza.com/tkd_compet/socket.io.js"></script>
<script src="http://ccnplaza.com/tkd_compet/jquery.rowspanizer.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".rwspan").each(function () {
            $('table').rowspanizer({
			  columns: [0],
			  vertical_align:'middle'
			});
        });
        $(".rwspan2").each(function () {
            $('table').rowspanizer({
			  columns: [4],
			  vertical_align:'middle'
			});
        });
		var socket = io.connect('http://ccnplaza.com:8888');
		socket.emit("login", {
		  name: "app_user1",
		  userid: "ccnplaza@gmail.com"
		});
		socket.on("chat", function(data) {
			var compet_id1 = "<?php echo $_SESSION['competition_id'] ?>";
			var coat_no1 = "<?php echo $_SESSION['coat_no'] ?>";
			var data_str = data.msg;
			var json_obj = data_str.split("|");
			console.log(json_obj);
			if(compet_id1 == json_obj[0] && coat_no1 == json_obj[1]){
				window.location.href = "<?php echo site_url('process/show_list/" + json_obj[4] + "/" + json_obj[6] + "')?>";
			}
		});
    });

</script>
<div class="container">
  <br/>  
    <div class="row justify-content-center">
        <div class="col text-center">
        <h2><?=$jongmok?></h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col text-center">
        <h2><?=$category?></h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col text-center">
        <h2>Coat: <?php echo $_SESSION['coat_no']?></h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-12">    
            <table class="table table-bordered table-hover table-response table-sm" id="athlete">
				<thead class="thead-dark">
				<tr>
				  <th scope="col" width="50px" style="text-align: center">��No</th>
				  <th scope="col" width="50px" style="text-align: center">��ȣ</th>
				  <th scope="col" width="50px" style="text-align: center">û/ȫ</th>
				  <th scope="col" width="200px">������</th>
				  <th scope="col" width="200px">�����</th>
				  <th scope="col" width="50px">����</th>
				</tr>
				</thead>
				<tbody>
					<?php 
						foreach($match_list as $match){ 
							if($match['RED_ID'] > 0){ 
								switch($match['GAME_STEP']){
								  case 2: $step = '���'; break;
								  case 3: $step = '4��';	break;
								  case 4: $step = '8��';	break;
								  case 5: $step = '16��';	break;
								  case 6: $step = '32��';	break;
								  case 7: $step = '64��';	break;
								  case 8: $step = '����';	break;
								}
							?>
								<tr>
								<td class="rwspan" style="text-align: center; vertical-align: middle;"><h1 style="color:blue"><b><?=$match['GAME_SET']?></b></h1></td>
								<td rowspan="2" style="text-align: center; vertical-align: middle;"><h3 style="color:blue"><b><?=$step?></b></h3></td>
								<td style="text-align: center; background-color: blue; color : white"><b>û</b></td>
								<td><?=$match['BLUE_NAME']?></td>
								<td><?=$match['BLUE_CENTER']?></td>
								<td rowspan="2" style="text-align: center; vertical-align: middle;"><?= $match_id == $match['ID'] ? "�����" : "" ?></td>
								</tr>
								<tr>
								<td class="rwspan" style="text-align: center; vertical-align: middle;"><h1 style="color:blue"><b><?=$match['GAME_SET']?></b></h1></td>
								<td style="text-align: center; background-color: red; color : white"><b>ȫ</b></td>
								<td><?=$match['RED_NAME']?></td>
								<td><?=$match['RED_CENTER']?></td>
								</tr>
						<?php }?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>	
</div>	
