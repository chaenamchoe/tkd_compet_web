<script>
	function myFunction() {
		var e = document.getElementById("assoc_id");
		var assoc = e.options[e.selectedIndex].value;
		if (assoc > 0) {
			window.location.href = "<?php echo site_url()?>compet/regist_center/"+assoc;
		}else{
			alert('Please select association.');
			document.getElementById("assoc_id").focus();
		}
	}
</script>
<div class="container">
  <br/>  
    <div class="row justify-content-center text-center">
		<div class="col alert alert-info" role="alert">
		  <h1 class="display-5">Online registration</h1>
		  <p class="lead">Welcome to online registration.</p>
		</div>
	</div>
    <form id="login-form" action=<?php echo site_url("compet/check_login")?> method="post">
    <div class="row justify-content-center">
        <div class="col-sm-4">
			<p style="color:red; font-weight:bold">Please, log in with your ID and password.<br>
				<!--If you are not registered in our system, please register first.</p>-->
			<?php if($_SESSION['assoc_id'] == 0){ ?>
            <p>
                <label>Please select an association.</label>
                <select class="form-control" name="assoc_id" id="assoc_id" required>
				<?php if(count($result) > 1){
					echo "<option value=0>--Select an association--</option>";
					foreach($result as $row) {
						$a_id=$row['ID'];
						$a_name = $row['A_NAME_E'];
						echo "<option value=". $a_id . ">".$a_name."</option>";
					}
				}else{
					$a_id=$result[0]['ID'];
					$a_name = $result[0]['A_NAME_E'];
					echo "<option value=". $a_id . ">".$a_name."</option>";
				}?>	
				</select>
            </p>
			<?php } ?>
            <p>
                <label>Login ID:</label>
                <input id="login_id" name="login_id" class="form-control" type="text" placeholder="Please enter your login ID." required>
            </p>
            <p>
                <label>Password:</label>
                <input id="login_pass" name="login_pass" class="form-control" type="password" placeholder="Please enter your password." required>
            </p>
        </div> 
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-4 text-center">
            <p>
                <button id="submit" type="submit" class="btn btn-primary"> Login </button>
				<?php if($_SESSION['compet_id'] <> 36){ ?>
				<a href="#" onclick="myFunction();" class="btn btn-primary btn-mg">New register</a>
				<?php } ?>
            </p>
        </div>    
    </div>    
    <div class="row justify-content-center">
        <div class="col-sm-4">
			<!--<p style="color:red; font-weight:bold">Please use Chrome browser. If you use IE, it cannot be used normally.</p>-->
		</div>
	</div>	
    </form>
        