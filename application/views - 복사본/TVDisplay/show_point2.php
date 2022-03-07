<style>
table td {
    text-align: center;
    vertical-align: middle;
    width: 50%;
}
td.a_name{
    height:100px;
    vertical-align: middle;
}
td.total{
    height:100px;
    vertical-align: middle;
}
td.point{
    height:100px;
    vertical-align: middle;
}
</style>

<div class="container">
    <div class="row justify-content-center">
        <h2><?=$step?></h2></br>
    </div>
    <div class="row justify-content-center">
        <h1><?=$jongmok?></h1></br>
    </div>
    <div class="row justify-content-center">
        <h2><?=$pumsae?></h2></br>
    </div>	
	<div class="row justify-content-center">
        <?php 
            foreach ($result as $row){
                $id = $row['ID'];
                $game_id = $row['GAME_NO'];
                $win_kind = $row['WIN_KIND'];
                $a_name = $row['A_NAME'];
                $a_center = $row['A_CENTER'];
                $b_name = $row['B_NAME'];
                $b_center = $row['B_CENTER'];
                $jongmok = $row['C_JONGMOK'];
                $step = $row['C_STEP'];
                $pumsae = $row['C_PUMSAE'];
                $total_point1 = $row['TOTAL_POINT'];
                $total_point2 = $row['TOTAL_POINT2'];
                $a_point1 = $row['POINT1'];
                $a_point2 = $row['POINT2'];
                $a_point3 = $row['POINT3'];
                $a_point4 = $row['POINT4'];
                $a_point5 = $row['POINT5'];
                $b_point1 = $row['POINT1_2'];
                $b_point2 = $row['POINT2_2'];
                $b_point3 = $row['POINT3_2'];
                $b_point4 = $row['POINT4_2'];
                $b_point5 = $row['POINT5_2'];
            } ?>
            <table class="table">
                <tr>
                    <td class="a_name"><h1><?=$a_name?></h1></td>
                    <td class="a_name"><h1><?=$b_name?></h1></td>
                </tr>
                <tr>
                    <td class="a_name"><h1><?=$a_center?></h1></td>
                    <td class="a_name"><h1><?=$b_center?></h1></td>
                </tr>
                <tr>
                    <td class="total"><h1><?=$total_point1?></h1></td>
                    <td class="total"><h1><?=$total_point2?></h1></td>
                </tr>
                <tr>
                    <td class="point"><h3><span><?=$a_point1?>/</span><span><?=$a_point2?>/</span><span><?=$a_point3?></span></h3></td>
                    <td class="point"><h3><span><?=$b_point1?>/</span><span><?=$b_point2?>/</span><span><?=$b_point3?></span></h3></td>
                </tr>
            </table>
           </div>
            </br>
            </br>
            
	</div>	
