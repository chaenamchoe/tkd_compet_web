<div class="container">
  <br/>  
    <div class="row">
        <div class="col text-center">
        <h2><?=$compet_name?></h2>
        </div>
    </div>
    <div class="row">
	<table id="mytable" class="table table-hover table-md table-striped">
		<thead class="thead-dark">
			<tr>
				<th>No</th>
				<th>���̺� ����</th>
				<th>���</th>
			</tr>
		</thead>
		<?php
		$no = 0;
		foreach ($result as $row):
			$no++;
			$id = $row['ID'];
			$desc = $row['LINK_DESC'];
			$link = $row['LINK1'];
			if(strlen($link) > 0){ ?>
			<tr>
				<td><?=$no?></td>
				<td><?=$desc?></td>
				<td><a href=<?php echo site_url('video/play_youtube_video/'.$id)?>>
						<img src="<?php echo site_url('uploads/youtube-icon.png')?>" width="40px">
					</a>
				</td>
			</tr>	
		<?php } endforeach; ?>
	</table>		
	</div>
	<!--
	<div class="row">
		<div class="col text-center">
		<a href=<?php echo site_url('video/play_youtube_video/'.$id)?> class="btn btn-primary">	�߰�	</a>
		</div>
	</div>	
	-->
</div>    
