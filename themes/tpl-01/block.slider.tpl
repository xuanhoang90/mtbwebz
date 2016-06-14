{if "{$slider_data}"}
	<div class="x-slider">
		<div class="slider">
			{foreach $slider_data as $slider}
				<div class="x-item">
					<img src="{$slider.data.bgimg}" />
					{foreach $slider.list_item as $sub_item}
						{if $sub_item.type == "image"}
							{if $sub_item.img_size == "default_size"}
								{$css_add = "width: auto; height: auto;"}
							{/if}
							{if $sub_item.img_size == "fix_width"}
								{$css_add = "width: 100%; height: auto;"}
							{/if}
							{if $sub_item.img_size == "fix_height"}
								{$css_add = "width: auto; height: 100%;"}
							{/if}
							{if $sub_item.img_size == "stretch"}
								{$css_add = "width: 100%; height: 100%;"}
							{/if}
							<div class="x-slider-sub-item" data-top="{$sub_item.top}" data-left="{$sub_item.left}" data-width="{$sub_item.width}" data-height="{$sub_item.height}">
								<div class="context contextimage">
									<img src="{$sub_item.image}" style="{$css_add}">
								</div>
							</div>
						{/if}
						
						{if $sub_item.type == "text"}
							{if $sub_item.style == "normal"}
								{$css_add = "font-weight: normal; text-decoration: none; font-style: normal;"}
							{/if}
							{if $sub_item.style == "bold"}
								{$css_add = "font-weight: bold; text-decoration: none; font-style: normal;"}
							{/if}
							{if $sub_item.style == "underline"}
								{$css_add = "font-weight: normal; text-decoration: underline; font-style: normal;"}
							{/if}
							{if $sub_item.style == "italic"}
								{$css_add = "font-weight: normal; text-decoration: none; font-style: italic;"}
							{/if}
							<div class="x-slider-sub-item" data-top="{$sub_item.top}" data-left="{$sub_item.left}" data-width="{$sub_item.width}" data-height="{$sub_item.height}">
								<div class="context">
									<p style="text-align: {$sub_item.align}; font-size: {$sub_item.size}px; color: {$sub_item.color}; font-family: {$sub_item.font}; line-height: {$sub_item.lheight}px; {$css_add}">{$sub_item.text}</p>
								</div>
							</div>
						{/if}
						
						{if $sub_item.type == "link"}
							{if $sub_item.style == "normal"}
								{$css_add = "font-weight: normal; text-decoration: none; font-style: normal;"}
							{/if}
							{if $sub_item.style == "bold"}
								{$css_add = "font-weight: bold; text-decoration: none; font-style: normal;"}
							{/if}
							{if $sub_item.style == "underline"}
								{$css_add = "font-weight: normal; text-decoration: underline; font-style: normal;"}
							{/if}
							{if $sub_item.style == "italic"}
								{$css_add = "font-weight: normal; text-decoration: none; font-style: italic;"}
							{/if}
							<div class="x-slider-sub-item" data-top="{$sub_item.top}" data-left="{$sub_item.left}" data-width="{$sub_item.width}" data-height="{$sub_item.height}">
								<div class="context">
									<a href="{$sub_item.url}" style="text-align: {$sub_item.align}; font-size: {$sub_item.size}px; color: {$sub_item.color}; font-family: {$sub_item.font}; line-height: {$sub_item.lheight}px; {$css_add}">{$sub_item.text}</a>
								</div>
							</div>
						{/if}
					{/foreach}
				</div>
			{/foreach}
		</div>
		<div class="nav-btn">
			<span class="xbtn active"></span>
			<span class="xbtn"></span>
			<span class="xbtn"></span>
			<span class="xbtn"></span>
			<span class="xbtn"></span>
		</div>
		<div class="x-btn">
			<span class="act next"><i class="fa fa-angle-right"></i></span>
			<span class="act prev"><i class="fa fa-angle-left"></i></span>
		</div>
	</div>
{/if}