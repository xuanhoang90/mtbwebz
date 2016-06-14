<div class="tpl-block-main-register">
	<h1 class="title">Register</h1>
	{if $register_process.register_flag}
		<p class="register-status"><i class="fa fa-exclamation-circle"></i> {$register_process.alert}</p>
	{/if}
	{if $content}
		<div class="policy">
			{$content}
		</div>
		<div class="policy-check">
			<p><input type="checkbox" name="policy_cf" value="yes" /> Tôi đã đọc và đồng ý với điều khoản </p>
		</div>
	{/if}
	<form class="reg-form" action="{$root_domain}/register" method="post">
		<div class="xform-group">
			<p class="label">First name: </p>
			<input class="input-text" name="fname" placeholder="Your first name" type="text" />
		</div>
		<div class="xform-group">
			<p class="label">Last name: </p>
			<input class="input-text" name="lname" placeholder="Your last name" type="text" />
		</div>
		<div class="xform-group">
			<p class="label">Account ID: </p>
			<input class="input-text" name="username" placeholder="Account ID" type="text" />
		</div>
		<div class="xform-group">
			<p class="label">Password: </p>
			<input class="input-text" name="userpass" placeholder="Password" type="password" />
		</div>
		<div class="xform-group">
			<p class="label">Confirm password: </p>
			<input class="input-text" name="userpass_cf" placeholder="Confirm password" type="password" />
		</div>
		<div class="xform-group">
			<p class="label">Email: </p>
			<input class="input-text" name="useremail" placeholder="Email" type="text" />
		</div>
		<div class="xform-group">
			<p class="label">&nbsp;</p>
			<input type="submit" class="input-submit" name="submit" value="Done" />
		</div>
	</form>
</div>