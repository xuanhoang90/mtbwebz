﻿{if $post_show_sub_object == "yes"}
	<div class="tpl-01-block-post-list">
		<div class="block-header">
			<p class="title">Danh sách bài viết: {$object_name}</p>
		</div>
		<div class="list-post">
			{$i = 1}
			{foreach $listdata as $post}
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
{else}
	<div class="tpl-01-block-category-list">
		<div class="block-header">
			<p class="title">Danh sách danh mục: {$object_name}</p>
		</div>
		<div class="list-category">
			{$i = 1}
			{foreach $listdata as $cat}
				<div class="one-cat" data="$cat.id" data-click-href="$cat.nice_url">
					<img class="thumb" src="{$cat.image}" />
					<a class="link" href="{$cat.nice_url}">{$cat.name}</a>
				</div>
			{$i = $i+1}
			{/foreach}
		</div>
		<a class="view-all" href="{$object_link}">Xem tất cả</a>
	</div>
{/if}