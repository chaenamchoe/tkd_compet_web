<script>
	function myFunction() {
		var e = document.getElementById("assoc_id");
		var assoc = e.options[e.selectedIndex].value;
		if (assoc > 0) {
			window.location.href = "<?php echo site_url()?>compet/regist_center/"+assoc;
		}else{
			alert('�Ҽ���ȸ�� ���� �����ϼ���.');
			document.getElementById("assoc_id").focus();
		}
	}
</script>
<div class="container">
  <br/>  
    <div class="row justify-content-center text-center">
		<div class="col alert alert-info" role="alert">
		  <p class="lead"><h2>��Ʃ�� �ǽð���� ��ũ ������</h2></p>
		  <p>������ �Ǵ� OBS���� �ǽð� ��� URL�� �����Ͽ� �Ʒ� �Է¶��� �Է��� �� �����ϼ���.
		  </p>
		</div>
	</div>
    <form id="login-form" action=<?php echo site_url("video/update_youtube_link")?> method="post">
    <div class="row justify-content-center">
        <div class="col-sm-6">
			<input id="compet_id" name="compet_id" class="form-control" type="hidden" value="<?php echo $result->COMPET_ID?>">
            <p>
                <label>1��Ʈ ��ũ</label>
                <input id="coat1" name="coat1" class="form-control" type="text" value="<?php echo $result->LINK1?>">
            </p>
            <p>
                <label>2��Ʈ ��ũ</label>
                <input id="coat2" name="coat2" class="form-control" type="text" value="<?php echo $result->LINK2?>">
            </p>
        </div> 
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-6 text-center">
            <p>
                <button id="submit" type="submit" class="btn btn-primary"> ���� </button>
            </p>
        </div>    
    </div>    
    </form>
        