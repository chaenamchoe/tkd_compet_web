<style type="text/css">

</style>
<script>
	function myFunction() {
		var e = document.getElementById("assoc_id");
		var assoc = e.options[e.selectedIndex].value;
		if (assoc > 0) {
			window.location.href = "<?php echo site_url()?>compet/regist_center/"+assoc;
		}else{
			alert('소속협회를 먼저 선택하세요.');
			document.getElementById("assoc_id").focus();
		}
	}
</script>
<div class="container">
  <br/>  
    <div class="row justify-content-center text-center">
		<div class="col alert alert-info" role="alert">
		  <h1 class="display-5"><?php echo $_SESSION['assoc_name'] ?></h1>
		  <p class="lead">온라인 대회등록 사이트에 오신것을 환영합니다.</p>
		</div>
	</div>
    <div class="row justify-content-center">
        <div class="col-sm-8 text-center">
			<table class="table table-bordered">
			<?php 
				$compet_id = $_SESSION['compet_id'];
				$coat_no = $_SESSION['coat_no'];
				$country = $_SESSION['country'];
				$judge_no = $_SESSION['judge_no']; 
			?>
	        <tr>
				<td style="vertical-align: middle;"><a href="<?php echo base_url()?>compet/login" class="btn btn-primary btn-lg btn-block">대회선수등록</a></td>
				<td style="vertical-align: middle;">대회 출전선수를 등록합니다.</td>
			</tr>
			<tr>
				<td style="vertical-align: middle;"><a href="<?php echo base_url()?>match/matches/<?=$compet_id?>/<?=$coat_no?>" class="btn btn-primary btn-lg btn-block">대진표조회</a></td>
				<td style="vertical-align: middle;">대회 대진표를 조회합니다.<br>종목별로 선택이 가능합니다.</td>
			</tr>
			<tr>
				<td style="vertical-align: middle;"><a href="<?php echo base_url()?>point/points/<?=$compet_id?>/<?=$coat_no?>/<?=$judge_no?>" class="btn btn-primary btn-lg btn-block">경기채점(심판)</a></td>
				<td style="vertical-align: middle;">선수별 점수를 입력합니다.<br>심판만 가능합니다(비밀번호 입력)</td>
			</tr>
			<tr>
				<td style="vertical-align: middle;"><a href="<?php echo base_url()?>process/save_competition/<?=$compet_id?>/<?=$coat_no?>" class="btn btn-primary btn-lg btn-block">경기진행상황</a></div>
				<td style="vertical-align: middle;">종목별 경기 진행상황을 조회합니다.<br>자동으로 화면스크롤이 됩니다.</td>
			</tr>
			<tr>
				<td style="vertical-align: middle;"><a href="<?php echo base_url()?>video/assoc/<?=$compet_id?>" class="btn btn-primary btn-lg btn-block">경기영상보기</a></div>
				<td style="vertical-align: middle;">경기영상을 봅니다.</td>
			</tr>	
			</table>
	    </div>    
    </div>    
        