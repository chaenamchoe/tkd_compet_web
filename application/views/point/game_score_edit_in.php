<div class="container">
  <br/>  
    <div class="row">
        <div class="col text-center">
            <p><h4>������ȣ: <?=$a_no ?></h4><br/>
            </p>
        </div>
    </div>
    <form id="login-form" action=<?php echo site_url("Compet/update_score/".$match_id)?> method="post">
    <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4">
            <p><h5>
                <label>����</label>
                <input id="point" name="point" class="form-control" type="number" min="0" max="10" step="0.1" placeholder="�����Է�" required>
				<input type="hidden" id="match_id" name="match_id" value=<?=$match_id ?>>
            </h5></p>
        </div> 
    </div>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 text-center">
            <p>
                <button id="submit" type="submit" class="btn btn-primary"> �� �� </button>
            </p>
        </div>    
    </div>    
    </form>