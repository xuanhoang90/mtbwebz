<div class="tpl-block-user-area">
	<h2 class="title">Thành viên</h2>
	<div class="main">
		{if $login_process.login_flag}
			<p class="login-status"><i class="fa fa-exclamation-circle"></i> {$login_process.alert}</p>
		{/if}
		<form method="post" action="{$root_domain}/login" class="loginform">
			<div class="xform-group">
				<p class="label">Account ID: </p>
				<input class="input-text" name="username" placeholder="Account ID" type="text" />
			</div>
			<div class="xform-group">
				<p class="label">Password: </p>
				<input class="input-text" name="userpass" placeholder="Password" type="password" />
			</div>
			<div class="xform-group">
				<input type="submit" class="input-submit" name="submit" value="Let's go!!" />
			</div>
		</form>
		<a class="link" href="{$root_domain}/register">Đăng ký tài khoản</a>
		<a class="link" href="#">Quên mật khẩu</a>
	</div>
</div>