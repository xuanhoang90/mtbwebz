<div class="tpl-01-block-comment">
	<p class="title">Bình luận</p>
	<div class="list-comment">
	{if $list_comment}
		{foreach $list_comment as $comment}
			<div class="one-comment">
				<div class="image">
					<img src="{$comment.user_data.avatar}" />
				</div>
				<div class="main">
					<div class="name">
						<p class="cmt-by">{$comment.user_data.display_name}</p>
					</div>
					<div class="content">
						{$comment.content}
					</div>
				</div>
			</div>
		{/foreach}
		<a>Hiển thị bình luận cũ hơn</a>
	{else}
		<p class="no-comment">Hãy là người bình luận đầu tiên!</p>
	{/if}
	</div>
	{if $is_logined}
	<div class="object-comment">
		<div class="my-comment">
			<div class="image">
				<img src="{$user_data.avatar}" />
			</div>
			<div class="main">
				<div class="name">
					<p class="cmt-by">{$user_data.user_name}</p>
				</div>
				<div class="content"><form action="#" method="post">
					<textarea placeholder="Your comment" name="cmt_content"></textarea>
					<input type="submit" name="cmt_submit" value="Gửi bình luận" />
				</form></div>
			</div>
		</div>
	</div>
	{else}
	<div class="object-comment">
		<p class="alert"><i class="fa fa-exclamation-triangle"></i> Vui long dang nhap de gui binh luan</p>
		<div class="link">
			<a href="{$root_domain}/login">Dang nhap</a>
			<a href="{$root_domain}/register">Dang ky</a>
		</div>
	</div>
	{/if}
</div>