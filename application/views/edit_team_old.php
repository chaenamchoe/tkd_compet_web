<script type="text/javascript">
	function deleteRow(tableID,currentRow) {
		try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;
			for (var i = 0; i < rowCount; i++) {
				var row = table.rows[i];
				if (row==currentRow.parentNode.parentNode) {
					if (rowCount <= 1) {
						alert("Cannot delete all the rows.");
						break;
					}
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
			$('#ath_count').val(rowCount - 1);
		} catch (e) {
			alert(e);
		}
	}
    $(document).ready(function() {
		var rowCount = $('#athlete tr').length;
		$('#ath_count').val(rowCount - 1);

		$('#jongmok').trigger('change');
		var jongmok_str = $('#jongmok option:selected').text();
        if (jongmok_str.search("��ü") > 0){
            $("#single_group").val(2);
        } else {
            $("#single_group").val(1);
        }
        $('#category').trigger('change');
        $('#jongmok').change(function() {
			var jongmok_str = $('#jongmok option:selected').text();
            if (jongmok_str.search("��ü") > 0){
                $("#single_group").val(2);
            } else {
                $("#single_group").val(1);
            }
            $("#category > option").remove();
            var jongmok_id = $(this).val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "<?php echo site_url('compet/get_category/')?>" + jongmok_id,
                success: function(category)
                {
					$.each(category, function(ID, CATEGORY_NAME)
                    {
                        var opt = $('<option />');
                        opt.val(ID);
                        opt.text(CATEGORY_NAME[0]);
						//opt.text(K_NAME);
                        $('#category').append(opt);
                        $('#att_price').val(CATEGORY_NAME[1]);
                        $('#total_price').val(CATEGORY_NAME[1]);
                    });
                    $('#category').trigger('change');
                },
				error:function(request,status,error){
					alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			    }
            });
        });
       
        $('#category').change(function() {
            $("#weight > option").remove();
            var category_id = $('#category').val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "<?php echo site_url('compet/get_weight/')?>" + category_id,
                success: function(weight)
                {
					$.each(weight, function(ID, W_NAME)
					{
						var opt = $('<option />');
						var w_str = '';
						opt.val(ID);
						if(W_NAME[1].length > 0){
							w_str = W_NAME[0] + '(' + W_NAME[1] + ')';
						}else{
							w_str = W_NAME[0];
						}
						opt.text(w_str);
						$('#weight').append(opt);
					});
                },
				error:function(request,status,error){
					alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			    }
            });
        });
		$('#add_ath').click(function(){
			var rowCount = $('#athlete tr').length;
			var uniq_no = Math.floor(+ new Date());
			$('#ath_count').val(rowCount);
			$("#athlete").append('<tr><th scope="row">'+rowCount+'</th>' + 
				'<td><input type="text" class="form-control" name="a_name'+ rowCount + '" maxlength="50" required></input></td>' + 
				'<td><input type="text" class="form-control" name="a_jumin'+ rowCount + '" maxlength="13" required></input></td>' + 
				'<td><input type="text" class="form-control" name="a_year'+ rowCount + '"></input></td>' +
				'<td><input type="button" class="btn btn-primary" value="����" onclick="deleteRow(\'athlete\',this)" /></td></tr>'
				);
		});
    });
</script>
<div class="container">
  <br/>  
    <div class="row">
        <div class="col text-center">
        <h2><?php echo $_SESSION['active_competition_name']?></h2>
        <h4>�������� ����</h4>
        <hr>
        </div>
    </div>
    <form id="login-form" action=<?php echo site_url("compet/update_team");?> method="post">
    <div class="row">
        <div class="col-sm-4">
            <p><b>1. ������</b>
            <select class="form-control" name="jongmok" id="jongmok">
                <?php 
                    $arr_shoolkind = array('', '', '�ʵ��-', '�ߵ��-', '����-', '���к�-', '�Ϲݺ�-');
                    $arr_jokind = array('', '-A��', '-B��', '-C��');
                    $arr_pumdan = array('', '-����', '-��ǰ');
                    $arr_sex = array('ȥ��-','����-', '����-');
                    
                foreach($jongmok_result as $row) {
                    $j_id=$row['ID'];
                    $jongmok_name = $row['JONGMOK_NAME'];
                    $single_val = $row['SINGLE_GROUP'];
                    $single_str = ($row['SINGLE_GROUP'] == 1) ? '����' : '��ü';
                    ?>	
                <option <?php if ($jongmok_id == $j_id) echo 'selected' ; ?> value="<?=$j_id?>"><?php echo $jongmok_name; ?></option>
                <?php } ?>
            </select>
            </p>
            <input type="hidden" id="athlete_id" name="athlete_id" value=<?=$athlete_id?> />
            <input type="hidden" id="single_group" name="single_group" value=<?=$single_val?> />
            <p><b>2. �г�μ���</b>
            <select class="form-control" name="category" id="category">
                <?php foreach($category_result as $row) { 
                    $c_id=$row['ID'];
                    $category_name = $row['CATEGORY_NAME'];
                    $price = $row['ATT_PRICE'];
                ?>	
                <option <?php if ($category_id == $c_id) echo 'selected' ; ?> value="<?=$c_id?>"><?php echo $category_name; ?></option>
                <?php } ?>
            </select>
            </p>
            <p><b>3. ü�޼���</b>
            <select class="form-control" name="weight" id="weight">
                <?php foreach($weight_result as $row) { 
                    $w_id=$row['ID'];
                    $weight_name = $row['W_NAME'];
                    $weight_desc = $row['W_DESC'];
                    $weight_str = $weight_name . '(' . $weight_desc . ')';
                    ?>	
                <option <?php if ($_SESSION['last_weight_id'] == $w_id) echo 'selected' ; ?> value="<?=$w_id?>"><?php echo $weight_str; ?></option>
                <?php } ?>
            </select>
            </p>
			<!--
            <input type="hidden" id="att_price" name="att_price" value=<?=$price ?> />
            <input type="hidden" id="total_price" name="total_price" value=<?=$price ?> />
			-->
            <input type="hidden" id="ath_count" name="ath_count" value="1"/>
			<input type="hidden" id="a_guid" name="a_guid" value="<?=$a_guid ?>"/>
			<!--<p id="attend_total">������ : <?=$price ?> �� * 1�� = <?=$price?>��</p>-->
        </div>
        <div class="col-sm-8">    
            <table class="table table-sm" id="athlete">
			  <thead>
				<tr>
				  <th scope="col" width="30px">#</th>
				  <th scope="col" width="300px">������</th>
				  <th scope="col" width="200px">�ֹι�ȣ</th>
				  <th scope="col" width="100px">�г�</th>
				  <th scope="col" width="100px">����</th>
				  <th scope="col" width="100px"></th>
				</tr>
			  </thead>
			  <tbody>
			  <?php
                $no = 0;
				foreach ($team_list as $row):
					$no++;
					$id = $row['ID'];
					$aname = $row['A_NAME'];
					$ayear = ($row['A_YEAR']==0) ? '' : $row['A_YEAR'];
					$jumin = $row['A_JUMIN'];
				?>
					<tr>
					<th scope="row"><?=$no?></th>
					<td><input type="text" class="form-control" name="a_name<?=$no?>" maxlength="50" required value=<?=$aname?>></input></td>
					<td><input type="text" class="form-control" name="a_jumin<?=$no?>" maxlength="13" required value=<?=$jumin?>></input></td>
					<td><input type="text" class="form-control" name="a_year<?=$no?>" maxlength="1" value=<?=$ayear?>></input></td>
					<td><input type="button" class="btn btn-primary" value="����" onclick="deleteRow('athlete',this)" /></td>
					<td style="display:none;"><input type="text" name="id<?=$no?>" value=<?=$id?>></input></td>
					</tr>
				<?php endforeach; ?>	
			  </tbody>
			</table>
			<p>
				<input type="button" id="add_ath" class="btn btn-primary" value="�����߰�"></input>
                <button type="submit" class="btn btn-primary">�ڷ�����</button>
				<a href=<?php echo site_url('compet/registed_athlete')?> class="btn btn-primary">���</a>
            </p>
        </div> 
    </div>    
    </form>
