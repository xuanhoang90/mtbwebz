{if $show_brc == "yes"}
	<div class="breadcrumb">
		<p>Breadcrumb</p>
	</div>
{/if}
{if $show_desc == "yes"}
	<div class="category-description">
		<h1 >{$cat_name}</h1>
		<p>{$cat_desc}</p>
	</div>
{/if}
{if $postlist_data}
	<div class="post-list-contain">
		<h2 class="main-title">Danh sach bai viet thuoc danh muc: {$cat_name}</h2>
		<div class="post-list">
			{foreach $postlist_data.list_post as $post}
				<div class="post-item">
					<div class="thumbnail">
						<img class="thumb" src="{$post.image}" />
					</div>
					<div class="post-details">
						<h3 class="post-title"><a href="{$post.nice_url}">{$post.name}</a></h3>
						<p class="detail post-date"><i class="fa fa-clock-o"></i> Time: {$post.date_created}</p>
						<p class="detail post-viewed"><i class="fa fa-eye"></i> Viewed: {$post.viewed}</p>
						<div>
							{$post.short_description}
						</div>
					</div>
				</div>
			{/foreach}
		</div>
		{$nextPage = $postlist_data.current_page + 1}
		{$prevPage = $postlist_data.current_page - 1}
		{if $postlist_data.current_page >= $postlist_data.total_page}
			{$curPage = $postlist_data.total_page}
			{$nextPage = "#"}
			{$prevPage = $postlist_data.current_page - 1}
		{/if}
		{if $postlist_data.current_page <= 1}
			{$curPage = 1}
			{$nextPage = $postlist_data.current_page + 1}
			{$prevPage = "#"}
		{/if}
		{if $prevPage <= 1}
			{$prevPage = "#"}
		{/if}
		{if $nextPage >= $postlist_data.total_page}
			{$nextPage = "#"}
		{/if}
		{if $prevPage != "#"}
			<div class="col-xs-12 clearfix">
				<ul class="pagination pagination-sm no-margin pull-right">
					<li><a href="{$root_domain}/post_category/{$cat_url}/?postcat_page={$catlist_data.current_page}&post_page={$prevPage}">«</a></li>
		{else}
			<div class="col-xs-12 clearfix">
				<ul class="pagination pagination-sm no-margin pull-right">
					<li><a href="#">«</a></li>
		{/if}
		{for $i = 5 to 1}
			{$page = $curPage - $i}
			{if $page > 0}
				<li><a href="{$root_domain}/post_category/{$cat_url}/?postcat_page={$catlist_data.current_page}&post_page={$page}">{$page}</a></li>
			{/if}
		{/for}
		<li><a href="#">{$curPage}</a></li>
		{for $i = 1 to 5}
			{$page = $curPage + $i}
			{if $page <= $postlist_data.total_page}
				<li><a href="{$root_domain}/post_category/{$cat_url}/?postcat_page={$catlist_data.current_page}&post_page={$page}">{$page}</a></li>
			{/if}
		{/for}
		{if $nextPage != "#"}
				<li><a href="{$root_domain}/post_category/{$cat_url}/?postcat_page={$catlist_data.current_page}&post_page={$nextPage}">»</a></li>
			</ul>
		</div>
		{else}
				<li><a href="#">»</a></li>
			</ul>
		</div>
		{/if}
	</div>
{/if}
{if $catlist_data}
	<div class="postcat-list-contain">
		<h2 class="main-title">Danh sach danh muc con thuoc danh muc: {$cat_name}</h2>
		<div class="postcat-list">
			{foreach $catlist_data.list_postcat as $cat}
				<div class="postcat-item">
					<div class="thumbnail">
						<img class="thumb" src="{$cat.image}" />
					</div>
					<div class="cat-details">
						<h3 class="cat-title"><a href="{$cat.nice_url}">{$cat.name}</a></h3>
						<div>
							{$cat.short_description}
						</div>
					</div>
				</div>
			{/foreach}
		</div>
		{$nextPage = $catlist_data.current_page + 1}
		{$prevPage = $catlist_data.current_page - 1}
		{if $catlist_data.current_page >= $catlist_data.total_page}
			{$curPage = $catlist_data.total_page}
			{$nextPage = "#"}
			{$prevPage = $catlist_data.current_page - 1}
		{/if}
		{if $catlist_data.current_page <= 1}
			{$curPage = 1}
			{$nextPage = $catlist_data.current_page + 1}
			{$prevPage = "#"}
		{/if}
		{if $prevPage <= 1}
			{$prevPage = "#"}
		{/if}
		{if $nextPage >= $catlist_data.total_page}
			{$nextPage = "#"}
		{/if}
		{if $prevPage != "#"}
			<div class="col-xs-12 clearfix">
				<ul class="pagination pagination-sm no-margin pull-right">
					<li><a href="{$root_domain}/post_category/{$cat_url}/?post_page={$postlist_data.current_page}&postcat_page={$prevPage}">«</a></li>
		{else}
			<div class="col-xs-12 clearfix">
				<ul class="pagination pagination-sm no-margin pull-right">
					<li><a href="#">«</a></li>
		{/if}
		{for $i = 5 to 1}
			{$page = $curPage - $i}
			{if $page > 0}
				<li><a href="{$root_domain}/post_category/{$cat_url}/?post_page={$postlist_data.current_page}&postcat_page={$page}">{$page}</a></li>
			{/if}
		{/for}
		<li><a href="#">{$curPage}</a></li>
		{for $i = 1 to 5}
			{$page = $curPage + $i}
			{if $page <= $catlist_data.total_page}
				<li><a href="{$root_domain}/post_category/{$cat_url}/?post_page={$postlist_data.current_page}&postcat_page={$page}">{$page}</a></li>
			{/if}
		{/for}
		{if $nextPage != "#"}
				<li><a href="{$root_domain}/post_category/{$cat_url}/?post_page={$postlist_data.current_page}&postcat_page={$nextPage}">»</a></li>
			</ul>
		</div>
		{else}
				<li><a href="#">»</a></li>
			</ul>
		</div>
		{/if}
	</div>
{/if}