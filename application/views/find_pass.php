<div class="container text-center">
		<div class="col-sm-12 text-center">
			<h3>비밀번호 찾기</h3>
			<hr>
			<div class="row">
				<div class="col-sm-4 text-left"></div>
				<div class="col-sm-4 text-center">
					<form id="login-form" action="<?=site_url()?>/compet/send_password_email" method="post">
		                <div>
							<div id="div-login-msg">
                                <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-login-msg">이메일 주소를 입력하세요.</span>
                            </div>
				    		<input name="email" class="form-control" type="text" placeholder="이메일주소" required>
        		    	</div>
		                <div>
							</br>
                            <p>입력한 이메일로 비밀번호를 전송합니다.</p>
							<p>이메일을 확인하여 다시 로그인 하세요.</p>
                            <button type="submit" class="btn btn-primary btn-mg">비밀번호 이메일전송</button>
							</br>
				        </div>
                    </form>					
				</div>
			</div>
			<hr>
		</div>
	</div>
</div>
