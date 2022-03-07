<div class="container">
  <br/>  
    <div class="row">
        <div class="col text-center">
            <p style="color:red">코트번호와 부심위치를 선택하세요.<br/>
            </p>
        </div>
    </div>
    <form id="login-form" action=<?php echo site_url("Compet/select_game_score")?> method="post">
    <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4">
            <p>
                <label>코트번호</label>
                <input id="coat_no" name="coat_no" class="form-control" type="text" placeholder="코트번호" required>
            </p>
            <p>
                <label>부심위치</label>
                <input id="judge_no" name="judge_no" class="form-control" type="text" placeholder="부심위치" required>
            </p>
        </div> 
    </div>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 text-center">
            <p>
                <button id="submit" type="submit" class="btn btn-primary"> 확인 </button>
            </p>
        </div>    
    </div>    
    </form>