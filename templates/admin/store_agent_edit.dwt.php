<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.store_agent_info.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		<!-- {if $action_link} -->
		<a class="btn data-pjax" href="{$action_link.href}" id="sticky_a" style="float:right;margin-top:-3px;"><i class="fontello-icon-reply"></i>{$action_link.text}</a>
		<!-- {/if} -->
	</h3>
</div>

<div class="row-fluid">
	<div class="span12">
		<form method="post" class="form-horizontal" action="{$form_action}" name="theForm">
			<fieldset>
				{if $data.id eq ''}
					<div class="control-group formSep">
						<label class="control-label">{t domain="affiliate"}会员手机号：{/t}</label>
						<div class="controls">
							<input class="w350 user-mobile" name="user_mobile" action='{url path="affiliate/admin_store_agent/validate_acount"}' type="text" value="" />
							<span class="input-must">*</span>
							<div class="help-block">{t domain="affiliate"}输入正确手机号，查询会员基本信息。{/t}</div>
						</div>
					</div> 
					
					<div class="control-group formSep agent_name_css" style="display: none;">
						<label class="control-label">{t domain="affiliate"}会员名称：{/t}</label>
						<div class="controls l_h30 result_agent_name">
						</div>
					</div>
				{else}
					<div class="control-group formSep">
						<label class="control-label">{t domain="affiliate"}会员名称：{/t}</label>
						<div class="controls l_h30">
							{$data.agent_name}[{$data.mobile_phone}]
						</div>
					</div>
				{/if}

				<div class="control-group formSep">
					<label class="control-label">{t domain="affiliate"}直推店铺佣金比：{/t}</label>
					<div class="controls">
						<input class="w350" name="level0" type="text" value="{$data.level0}" />&nbsp;%
						<div class="help-block">
						{t domain="affiliate"}设置直推店铺产生订单交易后，代理商可获得的佣金比，，此佣金全部从平台佣金中计算。{/t}<br>
						{t domain="affiliate"}例：设置直推50%，平台原本抽佣10%，最终代理商可获得分成比例为10% x 50% = 5%{/t}</div>
					</div>
				</div> 
				
				<div class="control-group formSep">
					<label class="control-label">{t domain="affiliate"}团队推荐佣金比：{/t}</label>
					<div class="controls">
						<input class="w350" name="level1"  type="text" value="{$data.level1}" />&nbsp;%
						<div class="help-block">{t domain="affiliate"}设置当前代理商招募的下级代理，在推广店铺入驻后，当前代理商可获得的佣金比，此佣金全部从平台佣金中计算。{/t}</div>
					</div>
				</div> 
				
				<div class="control-group formSep">
					<label class="control-label">{t domain="affiliate"}直属下级佣金比：{/t}</label>
					<div class="controls">
						<input class="w350" name="level2" type="text" value="{$data.level2}" />&nbsp;%
						<div class="help-block">{t domain="affiliate"}设置代理商下级推广店铺入驻后，下级可获得的佣金比，此佣金全部从平台佣金中计算。{/t}</div>
					</div>
				</div> 
				
				<div class="control-group">
					<div class="controls">
						<button class="btn btn-gebo" type="submit">{t domain="affiliate"}确认{/t}</button>
						<input type="hidden" name="id" value="{$data.id}" />
						<input type="hidden" name="agent_name" value="" />
						<input type="hidden" name="user_id" value="" />
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
<!-- {/block} -->