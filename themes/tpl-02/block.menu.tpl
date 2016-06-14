{if "{$menu_data}"}
	<!--Mega menu: Ngang-->
	<div class="x-mega-menu x-mega-menu-vertical {$css_class}">
		<div class="main-menu">
			<div class="menu">
			
			{foreach $menu_data as $menu}
				{if $menu.sub_data.data}
				<div class="item item-master has-children">
					<div class="item-content">
						<a href="{$menu.data.link}" class="link"><span class="icon"></span><span class="text">{$menu.data.name}</span><span class="open-sub fa fa-angle-down"></span></a>
					</div>
					<div class="submenu list-item">
						<div class="submenu-act">
							<span class="back"><i class="fa fa-angle-left"></i></span>
						</div>
						<div class="submenu-content">
							<!--Sub item level 2-->
							<!--Has submenu-->
							{foreach $menu.sub_data.data as $submenu}
								{if $submenu.sub_data.data}
									<div class="item item-sub has-children">
										<div class="item-content">
											<a href="{$submenu.data.link}" class="link"><span class="icon"></span><span class="text">{$submenu.data.name}</span></a>
										</div>
										<div class="submenu list-item">
											<div class="submenu-act">
												<span class="back"><i class="fa fa-angle-left"></i></span>
											</div>
											<div class="submenu-content">
												
												{foreach $submenu.sub_data.data as $submenu1}
													{if $submenu1.sub_data.data}
														<div class="item item-sub has-children">
															<div class="item-content">
																<a href="{$submenu1.data.link}" class="link"><span class="icon"></span><span class="text">{$submenu1.data.name}</span></a>
															</div>
															<div class="submenu list-item">
																<div class="submenu-act">
																	<span class="back"><i class="fa fa-angle-left"></i></span>
																</div>
																<div class="submenu-content">
																	
																	{foreach $submenu1.sub_data.data as $submenu2}
																		{if $submenu2.sub_data.data}
																			<div class="item item-sub has-children">
																				<div class="item-content">
																					<a href="{$submenu2.data.link}" class="link"><span class="icon"></span><span class="text">{$submenu2.data.name}</span></a>
																				</div>
																				<div class="submenu list-item">
																					<div class="submenu-act">
																						<span class="back"><i class="fa fa-angle-left"></i></span>
																					</div>
																					<div class="submenu-content">
																						
																						{foreach $submenu2.sub_data.data as $submenu3}
																							{if $submenu3.sub_data.data}
																								<div class="item item-sub has-children">
																									<div class="item-content">
																										<a href="{$submenu3.data.link}" class="link"><span class="icon"></span><span class="text">{$submenu3.data.name}</span></a>
																									</div>
																									<div class="submenu list-item">
																										<div class="submenu-act">
																											<span class="back"><i class="fa fa-angle-left"></i></span>
																										</div>
																										<div class="submenu-content">
																											
																										</div>
																									</div>
																								</div>
																							{else}
																								<!--No submenu-->
																								<div class="item item-sub">
																									<div class="item-content">
																										<a href="{$submenu3.data.link}" class="link"><span class="icon"></span><span class="text">{$submenu3.data.name}</span></a>
																									</div>
																								</div>
																							{/if}
																							
																						{/foreach}
																						
																					</div>
																				</div>
																			</div>
																		{else}
																			<!--No submenu-->
																			<div class="item item-sub">
																				<div class="item-content">
																					<a href="{$submenu2.data.link}" class="link"><span class="icon"></span><span class="text">{$submenu2.data.name}</span></a>
																				</div>
																			</div>
																		{/if}
																		
																	{/foreach}
																	
																</div>
															</div>
														</div>
													{else}
														<!--No submenu-->
														<div class="item item-sub">
															<div class="item-content">
																<a href="{$submenu1.data.link}" class="link"><span class="icon"></span><span class="text">{$submenu1.data.name}</span></a>
															</div>
														</div>
													{/if}
													
												{/foreach}
												
											</div>
										</div>
									</div>
								{else}
									<!--No submenu-->
									<div class="item item-sub">
										<div class="item-content">
											<a href="{$submenu.data.link}" class="link"><span class="icon"></span><span class="text">{$submenu.data.name}</span></a>
										</div>
									</div>
								{/if}
								
							{/foreach}
							
						</div>
					</div>
				</div>
				
				{else}
				
				<!--No sub menu-->
				{if $menu.data.name != ""}
				<div class="item item-master">
					<div class="item-content">
						<a href="{$menu.data.link}" class="link"><span class="icon"></span><span class="text">{$menu.data.name}</span><span class="open-sub fa fa-angle-down"></span></a>
					</div>
				</div>
				{else}
				<div class="item item-master">
					<div class="item-content">
						<img src="{$menu.data.image}" alt="">
					</div>
				</div>
				{/if}
				
				{/if}
				
			{/foreach}
				
				<div class="item item-master dale-search-item">
					<i class="fa fa-times"></i>
					<i class="fa fa-search"></i>
				</div>
				
			</div>
			
			<div class="search-field">
                <div class="container">
                	<form method="get" role="search">
                		<input type="text" name="s" placeholder="Type then press enter..." />
                        <button type="submit" class="hidden btn btn-default">Submit</button>
                  	</form>
                </div>
            </div><!-- search-field -->
		</div>
	</div>
	<!--/Mega menu: Ngang-->
{/if}