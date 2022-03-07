<div class="container">
	<form action=<?php echo site_url("compet/save_agree")?> method="post">
	<div class="row">
		<div>
		<p><h3>개인정보 수집/이용/제3자 제공 동의서</h3></p>
		<p>본 <?php echo $_SESSION['site_title']; ?>는 개인정보보호법에 의거한 개인정보를 보호하기 위해 개인정보의 수집과 이용에 대한 사항을 아래와 같이 설명합니다. 
			<?php echo $_SESSION['site_title']; ?>가 수집한 모든 개인 정보는 <?php echo $_SESSION['active_competition_name']; ?>의 진행 및 그 외 관리 업무를 위한 목적 이외에는 사용될 수 없으며, 
			개인정보의 사용목적과 용도가 변경될 경우에 귀하에게 동의를 구할 것입니다. 
			개인정보보호법에서 지정하는 범주에 들지 않는 비주요 정보의 변경 및 추가가 있을 경우 귀하에게 공지를 통해 알려드립니다. 
			다음 사항을 읽어보신 후, 동의여부에 따른 체크 및 서명을 해주시기 바랍니다.
		</p>
		</div>
		<div>
			<p><b>□ 개인정보 수집/이용 내역</b></p>
			<table class="table table-bordered">
				<thead class="thead-dark">
				<th>수집구분</th>
				<th>수집·이용하는 개인정보의 항목</th>
				<th>수집목적</th>
				<th>보유기간</th>
				</thead>
				<tr>
					<td>필수</td>
					<td>학교(도장)명, 감독(관장)명, 감독(관장)휴대전화, 학교(도장)주소, 부(초중고),<br>참가자학년, 참가자성별, 참가자겨루기(체급), 참가자시범발차기(종목)</td>
					<td>대회진행 시 본인 식별 절차 및 참가비 입금확인,<br>대회 업무처리, 상해보험가입</td>
					<td>1년</td>
				</tr>
				<tr>
					<td>선택</td>
					<td>종목, 참가자성명, 참가자학교명, 수상명</td>
					<td>수상증명서 발급</td>
					<td>3년</td>
				</tr>
			</table>
			<div>
			<p>※ 위의 개인정보 수집?이용에 대한 동의를 거부할 권리가 있습니다. 그러나 필수항목 동의를 거부할 경우 원활한 대회 참가에 제한을 받을 수 있으며, 
				선택항목 동의를 거부할 경우 수상증명서 발급이 불가함을 알려드립니다.
			</p>
			</div>
			<div>
			<table class="table table-bordered">
				<tr>
					<td><b>☞ 위와 같이 (필수)항목 개인정보를 수집·이용하는데 동의하십니까?</b></td>
					<td>
						  <input type="radio" name="agree1" value="1" checked>
						  <label for="agree1">예</label>
						  <input type="radio" name="agree1" value="0">
						  <label for="agree1">아니오</label>
					</td>
				</tr>
				<tr>
					<td><b>☞ 위와 같이 (선택)항목 개인정보를 수집·이용하는데 동의하십니까?</b></td>
					<td>
						  <input type="radio" name="agree2" value="1" checked>
						  <label for="agree2">예</label>
						  <input type="radio" name="agree2" value="0">
						  <label for="agree2">아니오</label>
					</td>
				</tr>
			</table>			
			</div>
		</div>
		<div>
			<p><b>□ 고유식별정보(주민등록번호) 수집 내역(필수사항)</b></p>
			<table class="table table-bordered">
				<thead class="thead-dark">
				<th>항목</th>
				<th>수집목적</th>
				<th>보유기간</th>
				</thead>
				<tr>
					<td>주민등록번호 (겨루기·품새·시범.태권체조)</td>
					<td>참가자 보험가입</td>
					<td>보험가입 후 즉시 파기</td>
				</tr>
			</table>
			<p>※ 위의 고유식별정보(주민등록번호) 수집에 대한 동의를 거부할 권리가 있습니다. 그러나 동의를 거부할 경우 대회 참가에 제한을 받을 수 있습니다.</p>
			<table class="table table-bordered">
				<tr>
					<td><b>☞ 위와 같이 고유식별정보(주민등록번호)를 처리하는데 동의하십니까?</b></td>
					<td>
						  <input type="radio" name="agree3" value="1" checked>
						  <label for="agree3">예</label>
						  <input type="radio" name="agree3" value="0">
						  <label for="agree3">아니오</label>
					</td>
				</tr>
			</table>
		</div>
		<div>
			<p><b>□ 개인정보 제3자 제공 내역(필수사항)</b></p>
			<table class="table table-bordered">
				<thead class="thead-dark">
				<th>제공받는 기관</th>
				<th>제공목적</th>
				<th>제공하는 항목</th>
				<th>보유기간</th>
				</thead>
				<tr>
					<td>보험회사</td>
					<td>대회 참가자 보험가입</td>
					<td>참가자성명, 참가자주민등록번호</td>
					<td>보험가입 후 보험가입 업무담당자는 즉시 파기, 청구를 위한 DB보존기간 준영구</td>
				</tr>
			</table>
			<p>※ 위의 개인정보 제공에 대한 동의를 거부할 권리가 있습니다. 그러나 동의를 거부할 경우 보험 가입이 불가하여 대회 참가에 제한을 받을 수 있습니다.</p>
			<table class="table table-bordered">
				<tr>
					<td><b>☞ 위와 같이 고유식별정보(주민등록번호)를 제공하는데 동의하십니까?</b></td>
					<td>
						  <input type="radio" name="agree4" value="1" checked>
						  <label for="agree4">예</label>
						  <input type="radio" name="agree4" value="0">
						  <label for="agree4">아니오</label>
					</td>
				</tr>
			</table>
		</div>
		<div>
			<b> - 위와 같이 개인정보를 수집·이용하는데 동의하십니까? </b>
			  <input type="radio" name="agree5" value="1" checked>
			  <label for="agree5">예</label>
			  <input type="radio" name="agree5" value="0">
			  <label for="agree5">아니오</label>
		</div>
	</div>
		<hr>
	<div class="row justify-content-center">
		<button type="submit" class="btn btn-primary">확인 및 저장</button>
	</div>
	</form>
</div>