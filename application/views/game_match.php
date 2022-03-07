<script language="javascript" type="text/javascript">
<!-- Begin
function scoreWinner( personA, personB, next1, next2, next3, personAwin, personBwin ){
	with ( personAwin.form ){
		if ( ! personAwin.checked && ! personBwin.checked ){
			next1.value = "";
			next2.value = "";
			next3.value = "";
		}
		else {
			next1.value = ( personAwin.checked ? personA.value : " " );
			personBwin.checked = false;
			next2.value = "";
			next3.value = "";
		}
	}
}

function advance( winner, loser, place ){
	place.value = winner.value;
}
// End -->
</script>

<div class="container">
	<div class="row">
		<div class="col-sm">
			<p></p>
			<form name=tournament>
			<table width=500 border=1 cellspacing=1 cellpadding=3 bgcolor=999999>
			<tr bgcolor=efefef>
				<td align="center">선수이름</td>
				<td colspan=2 align=center>준준결승</td>
				<td colspan=2 align=center>준결승</td>
				<td colspan=2 align=center>결승</td>
			</tr>

			<tr bgcolor=ffffff> <!-- 1라인 -->
				<td align=center>
				<input type=button name=player1win value=" 1번선수 " onClick="scoreWinner(this.form.player1, this.form.player2, this.form.round1winner1, this.form.round2winner1, this.form.round3winner, this, this.form.player2win);">
				</td>
				<td rowspan=2 align=center>
				<input type=button name=round1winner1 value=" 승자없음 " onClick="advance(this, this.form.round1winner2, this.form.round2winner1);">
				</td>
				<td rowspan=4 align=center>
				<input type=button name=round2winner1 value=" 승자없음 " onClick="advance(this, this.form.round2winner2, this.form.round3winner);">
				</td>
				<td rowspan=8 align=center>
				<input type=button name=round3winner value=" 승자없음 ">
				</td>
			</tr>
			<tr bgcolor=ffffff> <!-- 2라인 -->
				<td align=center>
				<input type=button name=player2win value=" 2번선수 " onClick="scoreWinner(this.form.player2, this.form.player1, this.form.round1winner1, this.form.round2winner1, this.form.round3winner, this, this.form.player1win);">
				</td>
			</tr>
			<tr bgcolor=ffffff>	<!-- 3라인 -->
				<td align=center>
				<input type=button name=player3win value=" 3번선수 " onClick="scoreWinner(this.form.player3, this.form.player4, this.form.round1winner2, this.form.round2winner1, this.form.round3winner, this, this.form.player4win);">
				</td>
				<td rowspan=2 align=center>
				<input type=button name=round1winner2 value=" 승자없음 " onClick="advance(this, this.form.round1winner1, this.form.round2winner1);">
				</td>
			</tr>

			<tr bgcolor=ffffff>	<!-- 4라인 -->
				<td align=center>
				<input type=button name=player4win value=" 4번선수 " onClick="scoreWinner(this.form.player4, this.form.player3, this.form.round1winner2, this.form.round2winner1, this.form.round3winner, this, this.form.player3win);">
				</td>
			</tr>
			<tr bgcolor=ffffff>	<!-- 5라인 -->
				<td align=center>
				<input type=button name=player5win value=" 5번선수 " onClick="scoreWinner(this.form.player5, this.form.player6, this.form.round1winner3, this.form.round2winner2, this.form.round3winner, this, this.form.player6win);">
				</td>
				<td rowspan=2 align=center>
				<input type=button name=round1winner3 value=" 승자없음 " onClick="advance(this, this.form.round1winner4, this.form.round2winner2);">
				</td>
				<td rowspan=4 align=center>
				<input type=button name=round2winner2 value=" 승자없음 " onClick="advance(this, this.form.round2winner1, this.form.round3winner);">
				</td>
			</tr>
			<tr bgcolor=ffffff>	<!-- 6라인 -->
				<td align=center>
				<input type=button name=player6win value=" 6번선수 " onClick="scoreWinner(this.form.player6, this.form.player5, this.form.round1winner3, this.form.round2winner2, this.form.round3winner, this, this.form.player5win);">
				</td>
			</tr>
			<tr bgcolor=ffffff>	<!-- 7라인 -->
				<td align=center>
				<input type=button name=player7win value=" 7번선수 " onClick="scoreWinner(this.form.player7, this.form.player8, this.form.round1winner4, this.form.round2winner2, this.form.round3winner, this, this.form.player8win);">
				</td>
				<td rowspan=2 align=center>
				<input type=button name=round1winner4 value=" 승자없음 " onClick="advance(this, this.form.round1winner3, this.form.round2winner2);">
				</td>
			</tr>
			<tr bgcolor=ffffff>	<!-- 8라인 -->
				<td align=center>
				<input type=button name=player8win value=" 8번선수 " onClick="scoreWinner(this.form.player8, this.form.player7, this.form.round1winner4, this.form.round2winner2, this.form.round3winner, this, this.form.player7win);">
				</td>
			</tr>
			</table>
			</form>
		</div>
	</div>
	<br/>
	