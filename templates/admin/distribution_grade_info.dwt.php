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
		<form class="form-horizontal" method="post" action="{$form_action}" name="theForm" enctype="multipart/form-data">
			<fieldset>
				<div class="control-group formSep">
					<label class="control-label">{t domain="affiliate"}权益名称：{/t}</label>
					<div class="controls">
						<input class="w350" type="text" name="grade_name" value="{$data.grade_name}"/>
						<span class="input-must">*</span>
					</div>
				</div>
				
				<div class="control-group formSep">
					<label class="control-label">{t domain="affiliate"}会员等级：{/t}</label>
					<div class="controls">
						<select class="w350" name="user_rank">
							<!-- {html_options options=$special_ranks selected=$data.user_rank} -->
						</select>
						<div class="help-block">{t domain="affiliate"}升级到此等级的分销商，能够同时成为设置的会员等级{/t}</div>
					</div>
				</div>
				
				<div class="control-group formSep">
					<label class="control-label">{t domain="affiliate"}有效期限：{/t}</label>
					<div class="controls">
						<input class="w350" type="text" name="limit_days" value="{$data.limit_days}"/>&nbsp;年
						<div class="help-block">{t domain="affiliate"}设置领取后，X年后到期，以年为单位{/t}</div>
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
						    <div class="btn">{t domain="affiliate"}更换商品{/t}</div>
						</a>
						<div class="help-block">{t domain="affiliate"}指定商品后，只有购买指定商品才能升级到当前等级{/t}</div>
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
							{ecjia:editor content=$data.user_card_intro textarea_name='user_card_intro' mode='base'}
						</div>
					</div>
				</div>
				
				<div class="control-group formSep">
					<label class="control-label">{t domain="affiliate"}权益介绍：{/t}</label>
					<div class="controls">
						<div class="span8">
							{ecjia:editor content=$data.grade_intro textarea_name='grade_intro' mode='base'}
						</div>
					</div>
				</div>
				
				<div class="control-group formSep">
					<label class="control-label">{t domain="affiliate"}排序：{/t}</label>
					<div class="controls">
						<input class="w350" type="text" name="sort_order" value="{$data.sort_order}"/>
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls">
						<input type="hidden" name="goods_id" value="{$goods.goods_id}"/>
						<input type="hidden" name="grade_id" value="{$data.grade_id}"/>
                        <!-- {if $grade_id} -->
                        <input type="submit" value='{t domain="affiliate"}更新{/t}' class="btn btn-info"/>
                        <!-- {else} -->
                        <input type="submit" value='{t domain="affiliate"}确定{/t}' class="btn btn-info"/>
                        <!-- {/if} -->
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

<div class="modal hide fade" id="addModal">
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