<div class="container">
  <br/>  
    <div class="row justify-content-center text-center">
		<div class="col alert alert-info" role="alert">
		  <h1 class="display-5"><?php echo $_SESSION['assoc_name'] ?></h1>
		  <p class="lead">Welcome to online register.</p>
		</div>
	</div>
    <div class="row justify-content-center">
        <div class="col-sm-8 text-center">
			<?php 
				$compet_id = $_SESSION['compet_id'];
				$coat_no = $_SESSION['coat_no'];
				$country = $_SESSION['country'];
				$judge_no = $_SESSION['judge_no']; 
			?>
			<table class="table table-bordered">
	        <tr>
				<td style="vertical-align: middle;"><a href="<?php echo base_url()?>compet/login" class="btn btn-primary btn-lg btn-block">Regist athletes</a></td>
				<td style="vertical-align: middle;">Regist athletes.</td>
			</tr>
			<tr>
				<td style="vertical-align: middle;"><a href="<?php echo base_url()?>match/matches/<?=$compet_id?>/<?=$coat_no?>" class="btn btn-primary btn-lg btn-block">Match</a></td>
				<td style="vertical-align: middle;">View game match.</td>
			</tr>
			<tr>
				<td style="vertical-align: middle;"><a href="<?php echo base_url()?>point/points/<?=$compet_id?>/<?=$coat_no?>/<?=$judge_no?>" class="btn btn-primary btn-lg btn-block">Points</a></td>
				<td style="vertical-align: middle;">Input game point(judge).</td>
			</tr>
			<tr>
				<td style="vertical-align: middle;"><a href="<?php echo base_url()?>process/save_competition/<?=$compet_id?>/<?$coat_no?>" class="btn btn-primary btn-lg btn-block">Process</a></div>
				<td style="vertical-align: middle;">View game process and status.</td>
			</tr>
			<tr>
				<td style="vertical-align: middle;"><a href="<?php echo base_url()?>video/videos/<?=$compet_id?>/<?=$coat_no?>" class="btn btn-primary btn-lg btn-block">Video</a></div>
				<td style="vertical-align: middle;">View game video.</td>
			</tr>	
			</table>
	    </div>    
    </div>    
        