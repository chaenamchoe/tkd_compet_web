<div class="container">
  <br/>  
    <div class="row">
        <div class="col text-center">
            <p style="color:red">��Ʈ��ȣ�� �ν���ġ�� �����ϼ���.<br/>
            </p>
        </div>
    </div>
    <form id="login-form" action=<?php echo site_url("Compet/select_game_score")?> method="post">
    <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4">
            <p>
                <label>��Ʈ��ȣ</label>
                <input id="coat_no" name="coat_no" class="form-control" type="text" placeholder="��Ʈ��ȣ" required>
            </p>
            <p>
                <label>�ν���ġ</label>
                <input id="judge_no" name="judge_no" class="form-control" type="text" placeholder="�ν���ġ" required>
            </p>
        </div> 
    </div>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 text-center">
            <p>
                <button id="submit" type="submit" class="btn btn-primary"> Ȯ�� </button>
            </p>
        </div>    
    </div>    
    </form>