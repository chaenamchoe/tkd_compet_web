<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.top-container {
  background-color: #f1f1f1;
  padding: 30px;
  text-align: center;
}
.container {
	margin-top: 50px;
}
.header {
  padding: 10px 16px;
  background: black;
  color: #ffbf00;
  text-align: center;
  z-index: 1;
}

.content {
  padding: 16px;
}

.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

.sticky + .content {
  padding-top: 102px;
}
</style>
<script src="http://ccnplaza.com/tkd_compet/socket.io.js"></script>
<script src="http://ccnplaza.com/tkd_compet/jquery.rowspanizer.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
		var location = document.querySelector(".current_sel").offsetTop-90;
		window.scrollTo({top:location, behavior:'smooth'});
		$(".rwspan").each(function () {
            $('table').rowspanizer({
			  columns: [0],
			  vertical_align:'middle'
			});
        });
        $(".table-bordered").each(function () {
            $('table').rowspanizer({
			  columns: [0],
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
<div class="header sticky" id="myHeader">
  <h2><p><?=$jongmok?>&nbsp;<?=$category?> Coat: <?php echo $_SESSION['coat_no']?></p></h2>
</div>
<div class="container">
  <br/>  
    <div class="row justify-content-center">
        <div class="col-sm-12">    
            <table class="table table-bordered table-sm" id="athlete">
				<thead class="thead-dark">
				<tr>
				  <th scope="col" width="50px" style="text-align: center">조No</th>
				  <!--<th scope="col" width="50px" style="text-align: center">번호</th>-->
				  <th scope="col" width="200px">선수명</th>
				  <th scope="col" width="200px">도장명</th>
				  <th scope="col" width="50px" style="text-align: center">순위</th>
				</tr>
				</thead>
				<tbody>
					<?php 
						foreach($match_list as $match){ ?>
						<tr>
						<?php if($jo == $match['GAME_SET']){ ?>
							<td class="current_sel" style="text-align: center; vertical-align: middle; background-color:#ffbf00"><h1 style="color:blue"><b><?=$match['GAME_SET']?></b></h1></td>
							<!--<td style="text-align: center;  background-color:#54e3eb"><b><?=$match['GAME_ID']?></b></td>-->
							<td style="background-color:#ffbf00"><b><?=$match['BLUE_NAME']?></b></td>
							<td style="background-color:#ffbf00"><b><?=$match['BLUE_CENTER']?></b></td>
							<td style="text-align: center; background-color:#ffbf00"><b><?=$match['BLUE_WIN']?></b></td>
						<?php }else{ ?>	
							<td style="text-align: center; vertical-align: middle; background-color:#e1ffff"><h1 style="color:blue"><b><?=$match['GAME_SET']?></b></h1></td>
							<!--<td style="text-align: center"><b><?=$match['GAME_ID']?></b></td>-->
							<td style="background-color:#e1ffff"><?=$match['BLUE_NAME']?></td>
							<td style="background-color:#e1ffff"><?=$match['BLUE_CENTER']?></td>
							<td style="text-align: center; background-color:#e1ffff"><b><?=$match['BLUE_WIN']?></b></td>
						<?php } ?>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>	
</div>	
