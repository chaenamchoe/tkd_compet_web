<style>
img {
   max-width:100%;
   height:auto;
   max-height:100%;
}
</style>
<div class="container">
	<div class="row justify-content-center text-center">
		<div class="col">
			<br>
            <h3 class="alert alert-success"><?=$_SESSION['competition_name']?></h3>
        </div>
	</div>	
	<hr>
	<div class="row justify-content-center text-center">
        <div  class="col">
        <p><h4>잘못된 비밀번호입니다. </br>
			비밀번호를 다시 입력하세요.</br></br>
			비밀번호를 잃어버렸다면</br>
			스마트에스엠에 문의하세요.
		</h4></p>
		<p>
			<img src="http://ccnplaza.com/img/sm_logo_s.jpg" width="250px"></img>
		</p>
	   </div>
	<br/>
    </div>  
	<div class="row justify-content-center text-center">
		<div class="col-sm-4">
			<a href="<?php echo site_url('point/points/'.$compet_id.'/'.$coat_no.'/'.$judge_no)?>" 
				class="btn btn-primary btn-lg btn-block"><h2>다시 로그인</h2></a>
		</div>
	</div>	
  