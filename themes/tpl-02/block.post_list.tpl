<div class="tpl-01-block-post-list">
	<div class="block-header">
		<p class="title">Danh sách bài viết: {$object_name}</p>
	</div>
	<div class="list-post">
		{$i = 1}
		{foreach $postlist as $post}
			<div class="one-post post-{$i}">
				<div class="thumbnail">
					<img class="thumb" src="{$post.image}" />
				</div>
				<div class="context">
					<a class="link" href="{$post.nice_url}"><i class="fa fa-pencil"></i> {$post.name}</a>
					<div class="details">
						<p class="post-date"><i class="fa fa-clock-o"></i> Time: {$post.date_created}</p>
						<p class="post-viewed"><i class="fa fa-eye"></i> Viewed: {$post.viewed}</p>
					</div>
					<div class="preview">
						{$post.short_descripton}
					</div>
				</div>
			</div>
		{$i = $i+1}
		{/foreach}
	</div>
	<a class="view-all" href="{$object_link}">Xem tất cả</a>
</div>