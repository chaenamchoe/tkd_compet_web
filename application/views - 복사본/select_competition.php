<script type="text/javascript">
    $(document).ready(function() {
        $('.jongmok').click(function() {
            var id = $(this).attr("id");
            //alert(jongmok_str);
            window.location.replace("<?php echo site_url('welcome/add_athlete/')?>" + id);
        });
    });
</script>    
<div class="container">
  <br/>  
    <div class="row">
        <div class="col text-center">
        <h2>�¶��� ��� ��ȸ����</h2>
        </div>
    </div>
    <hr>
    <div class="row">
		<div class="table-responsive">
		<table class="table table-hover table-sm">
			<thead class="thead-light">
				<tr>
					<th style="text-align:center">No</th>
					<th>��ȸ��</th>
                    <th>��ȸ���</th>
					<!--<th>��������</th>
					<th>��������</th>-->
					<th>��ȸ����</th>
					<th>��ȸ����</th>
					<th>����ǥ</th>
					<th>���ڸ���Ʈ</th>
				</tr>
			</thead>
			<?php
				$no = 0;
				foreach ($compet_list as $row):
					$no++;
					$id = $row['ID'];
					$c_name = $row['C_NAME'];
					$c_place = $row['C_PLACE'];
                    $r_sdate = $row['REG_SDATE'];
                    $r_edate = $row['REG_EDATE'];
                    $s_date = $row['S_DATE'];
                    $e_date = $row['E_DATE'];
				?>
		  	<tr>
			  <td style="text-align:center"><?=$no?></td>
			  <td>
                <a href=<?php echo site_url('compet/save_selected_competition/'.$id)?>><?=$c_name?></a>
              </td>
			  <td><?=$c_place?></td>
			  <td><?=$s_date?></td>
			  <td><?=$e_date?></td>
			  <td><a href="http://ccnplaza.com/tkd_compet/match" class="btn btn-primary btn-sm">����ǥ</a></td>
			  <td><a href="http://ccnplaza.com/tkd_compet/match" class="btn btn-primary btn-sm">���ڸ���Ʈ</a></td>
			</tr>
			<?php endforeach; ?>
		</table>
		<hr>
		</div>
	</div>	
</div>    
