<script>
function myFunction(pass) {
		var password = prompt("패스워드를 입력하세요", "");
		const btn = document.getElementsByClassName('btn-primary');
		if (password != null && password == pass) {
			for (let i = 0; i < btn.length; i++) {
			  btn[i].className = "btn btn-primary btn-lg"; 
			}
		} else {
			alert("비밀번호가 틀렸습니다. \n대회채점의 안전을 위해 비밀번호를 입력하셔야 \n채점을 하실 수 있습니다.\n비밀번호는 스마트에스엠으로 문의하세요.");
		}
	}
</script>	
<div class="container">
	<br/>  
    <div class="row justify-content-center">
        <div class="col-sm-8 text-center">
        <h2> 대회/코트/부심 선택 </h2>
        </div>
    </div>
    <hr>
		<div class="row justify-content-center">
			<div class="col-sm-8 text-center">
				<p><h3 class="alert alert-success"> <?=$compet_name?> </h3></p>
				<p><a onclick="myFunction(<?=$online_password?>);" class="btn btn-info btn-lg">비밀번호 확인</a></p>
				<p><h3 class="alert alert-info"> 1 코트 </h3>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/1/1')?> class="btn btn-primary btn-lg disabled"> 1 심 </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/1/2')?> class="btn btn-primary btn-lg disabled"> 2 심 </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/1/3')?> class="btn btn-primary btn-lg disabled"> 3 심 </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/1/4')?> class="btn btn-primary btn-lg disabled"> 4 심 </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/1/5')?> class="btn btn-primary btn-lg disabled"> 5 심 </a>
				</p><hr>
				<p><h3 class="alert alert-info"> 2 코트 </h3>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/2/1')?> class="btn btn-primary btn-lg disabled"> 1 심 </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/2/2')?> class="btn btn-primary btn-lg disabled"> 2 심 </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/2/3')?> class="btn btn-primary btn-lg disabled"> 3 심 </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/2/4')?> class="btn btn-primary btn-lg disabled"> 4 심 </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/2/5')?> class="btn btn-primary btn-lg disabled"> 5 심 </a>
				</p><hr>
				<p><h3 class="alert alert-info"> 3 코트 </h3>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/3/1')?> class="btn btn-primary btn-lg disabled"> 1 심 </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/3/2')?> class="btn btn-primary btn-lg disabled"> 2 심 </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/3/3')?> class="btn btn-primary btn-lg disabled"> 3 심 </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/3/4')?> class="btn btn-primary btn-lg disabled"> 4 심 </a>
				<a href=<?php echo site_url('point/save_competition/'.$compet_id.'/3/5')?> class="btn btn-primary btn-lg disabled"> 5 심 </a>
				</p><hr>
			</div>
		</div>	
</div>