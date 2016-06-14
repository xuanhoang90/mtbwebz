<div class="tpl-block-main-info">
	<h2 class="title">{$pagename}</h2>
	<div class="context">
		{if $show_company == "yes"}
			<p>Copyright {$company} @ 2015 powered by XHFramework</p>
		{/if}
		{if $show_email == "yes"}
			<p>Email: <a href="mailto:{$email}">{$email}</a></p>
		{/if}
		{if $show_phone == "yes"}
			<p>Hotline: {$phone}</p>
		{/if}
		{if $show_blog == "yes"}
			<p>Blog: <a href="{$blog}">{$blog}</a></p>
		{/if}
	</div>
</div>