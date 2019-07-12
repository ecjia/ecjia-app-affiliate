<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->
<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.distribution_grade_info.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div>
	<h3 class="heading">
	<!-- {if $ur_here}{$ur_here}{/if} -->
		{if $action_link}
	<a class="btn plus_or_reply data-pjax" href="{$action_link.href}" id="sticky_a"><i class="fontello-icon-reply"></i>{$action_link.text}</a>
		{/if}
	</h3>
</div>

<div class="row-fluid edit-page">
	<div class="span12">
		<form class="form-horizontal" method="post" action="{$form_action}" name="theForm" enctype="multipart/form-data" data-edit-url="{RC_Uri::url('goods/admin_brand/edit')}">
			<fieldset>
				<div class="control-group formSep">
					<label class="control-label">{t domain="affiliate"}权益名称：{/t}</label>
					<div class="controls">
						<input class="w350" type="text" name="name" value="{$data.name}"/>
						<span class="input-must">*</span>
					</div>
				</div>
				
				<div class="control-group formSep">
					<label class="control-label">{t domain="affiliate"}会员等级：{/t}</label>
					<div class="controls">
						<select class="w350" name="user_rank">
							<option value="0">{t domain="affiliate"}非特殊等级{/t}</option>
										<option value="0">{t domain="affiliate"}非特殊等级{/t}</option>
							<!-- {html_options options=$special_ranks selected=$user.user_rank} -->
						</select>
					</div>
				</div>
				
				
				<div class="control-group formSep">
					<label class="control-label">{t domain="affiliate"}有效期限：{/t}</label>
					<div class="controls">
						<input class="w350" type="text" name="validity_period" value="{$data.validity_period}"/>&nbsp;年
					</div>
				</div>
				
				 <div class="control-group formSep">
                        <label class="control-label">{t domain="affiliate"}指定商品：{/t}</label>
                        <div class="controls">
                            <a data-toggle="modal" data-backdrop="static" href="#addModal" class="choose_goods {if $goods.goods_id}hide{/if}">
                                <div class="choose-btn">
                                    <span>+</span>
                                    {t domain="affiliate"}去选择{/t}
                                </div>
                            </a>
                            <a data-toggle="modal" data-backdrop="static" href="#addModal" class="change_goods {if !$goods.goods_id}hide{/if}">
                                <div class="btn btn-primary">{t domain="affiliate"}更换商品{/t}</div>
                            </a>

                            <div class="goods-temp-content">
                                {if $goods}
                                <!-- #BeginLibraryItem "/library/goods.lbi" --><!-- #EndLibraryItem -->
                                {/if}
                            </div>
                        </div>
                    </div>
				
				<div class="control-group formSep">
					<label class="control-label">{t domain="affiliate"}会员卡介绍：{/t}</label>
					<div class="controls">
						<div class="span8">
							{ecjia:editor content=$data.content textarea_name='card_intro' mode='base'}
						</div>
					</div>
				</div>
				
				<div class="control-group formSep">
					<label class="control-label">{t domain="affiliate"}权益介绍：{/t}</label>
					<div class="controls">
						<div class="span8">
							{ecjia:editor content=$data.content textarea_name='interest_intro' mode='base'}
						</div>
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						<!-- {if $data.id} -->
						<input type="hidden" name="id" value="{$data.id}"/>
						<button class="btn btn-gebo" type="submit">{t domain="affiliate"}更新{/t}</button>
						<!-- {else} -->
						<button class="btn btn-gebo" type="submit">{t domain="affiliate"}确定{/t}</button>
						<!-- {/if} -->
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">×</button>
                <h3>{t domain="affiliate"}选择活动商品{/t}</h3>
            </div>

            <div class="modal-body">
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        <i class="fa fa-times" data-original-title="" title=""></i></button>
                    <strong>{t domain="affiliate"}温馨提示：{/t}</strong>{t domain="affiliate"}1、先搜索指定的商品；2、在左侧选中商品；3、预览商品基本信息后“确定”；{/t}
                </div>
                
				<div class="row-fluid searchForm" data-href="{url path='affiliate/admin_distribution_grade/search_goods'}">
					<div class="control-group choose_list span12" >
						<select name="cat_id">
							<option value="0">{t domain="affiliate"}所有分类{/t}{$cat_list}</option>
						</select>
						<input type="text" name="goods_keywords" value="{$smarty.get.goods_keywords}"  placeholder='{t domain="promotion"}请输入商品名称{/t}' />
						<input type="text" name="goods_sn"  value="{$smarty.get.goods_sn}" placeholder='{t domain="promotion"}请输入商品货号{/t}' />
						
						<a class="btn searchGoods" type="button">{t domain="affiliate"}搜索{/t}</a>
					</div>
					<div class="control-group draggable">
						<div class="ms-container" id="ms-custom-navigation">
							<div class="ms-selectable">
								<div class="search-header">
									<input class="span12" id="ms-search" type="text" placeholder='{t domain="affiliate"}筛选搜索到的商品信息{/t}' autocomplete="off">
								</div>
								<ul class="ms-list nav-list-ready" data-url="{RC_Uri::url('affiliate/admin_distribution_grade/get_goods_info')}">
									<li class="ms-elem-selectable disabled"><span>{t domain="affiliate"}暂无内容{/t}</span></li>
								</ul>
							</div>
							
							<div class="ms-selection">
								<div class="custom-header custom-header-align">{t domain="affiliate"}预览基本信息{/t}</div>
								<ul class="ms-list nav-list-content">
								
								</ul>
							</div>
						</div>
					</div>
					
					<p class="ecjiaf-tac">
						<input type="button" value='{t domain="affiliate"}确定{/t}' class="btn btn-gebo select-goods-btn"/>
					</p>
				</div>
            </div>
        </div>
    </div>
</div>
<!-- {/block} -->