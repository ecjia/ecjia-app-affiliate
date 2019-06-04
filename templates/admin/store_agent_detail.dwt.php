<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<!-- {/block} -->

<!-- {block name="main_content"} -->

<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		<!-- {if $action_link} -->
		<a href="{$action_link.href}" class="btn plus_or_reply data-pjax" ><i class="fontello-icon-reply"></i>{$action_link.text}</a>
		<!-- {/if} -->
	</h3>
</div>

<div class="row-fluid">
	<div class="span12">
		<div id="accordion2" class="foldable-list form-inline">
			<div class="accordion-group">
				<div class="accordion-heading">
					<div class="accordion-toggle acc-in" data-toggle="collapse" data-target="#collapseOne">
						<strong>{t domain="affiliate"}基本信息{/t}</strong>
						<a target="_blank" href='{url path="affiliate/admin_store_agent/edit" args="id={$data.id}"}'>{t domain="affiliate"}编辑{/t}</a>
					</div>
				</div>
				<div class="accordion-body in collapse" id="collapseOne">
					<table class="table table-oddtd m_b0">
						<tbody class="first-td-no-leftbd">
							<tr>
								<td><div align="right"><strong>{t domain="affiliate"}代理商名称：{/t}</strong></div></td>
								<td>{$data.agent_name}&nbsp;&nbsp;&nbsp;<a target="_blank" href='{url path="user/admin/info" args="id={$data.user_id}"}'>{t domain="affiliate"}查看会员信息{/t}</a></td>
								<td><div align="right"><strong>{t domain="affiliate"}手机号码：{/t}</strong></div></td>
								<td>{$data.mobile_phone}</td>
							</tr>
							<tr>
								<td><div align="right"><strong>{t domain="affiliate"}直推店铺佣金比：{/t}</strong></div></td>
								<td>{$data.level0}%</td>
								<td><div align="right"><strong>{t domain="affiliate"}团队推荐佣金比：{/t}</strong></div></td>
								<td>{$data.level1}%</td>
							</tr>
							<tr>
								<td><div align="right"><strong>{t domain="affiliate"}直属下级佣金比：{/t}</strong></div></td>
								<td>{$data.level2}%</td>
								<td><div align="right"><strong>{t domain="affiliate"}添加时间：{/t}</strong></div></td>
								<td>{$data.add_time_new}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="accordion-group">
				<div class="accordion-heading accordion-heading-url">
					<div class="accordion-toggle acc-in" data-toggle="collapse"  data-target="#collapseFive">
						<strong>{t domain="affiliate"}推广统计{/t}</strong>
					</div>
				</div>
				<div class="accordion-body in collapse" id="collapseFive">
					<table class="table h70">
						<tr>
							<td>
								<div class="order_number m_t30">
									<span>
									{t domain="affiliate"}团队总数：{/t}<font class="ecjiafc-red">{if $leader_info.sales_money}{$leader_info.sales_money}{else}0{/if}</font>
									<a class="m_l5" target="_blank" href="{RC_Uri::url('finance/admin_account_log/init')}&account_type=user_money&user_id={$leader_info.user_id}">{t domain="affiliate"}查看{/t}</a>
									</span>
									
									<span>
									{t domain="affiliate"}推广店铺：{/t}<font class="ecjiafc-red">{if $leader_info.sales_money}{$leader_info.sales_money}{else}0{/if}</font>
									<a class="m_l5" target="_blank" href="{RC_Uri::url('finance/admin_account_log/init')}&account_type=user_money&user_id={$leader_info.user_id}">{t domain="affiliate"}查看{/t}</a>
									</span>
									
									<span>{t domain="affiliate"}佣金总额：{/t}<font class="ecjiafc-red">¥{if $leader_info.total_commission}{$leader_info.total_commission}{else}0{/if}</font></span>
									<span>{t domain="affiliate"}待分成：{/t}<font class="ecjiafc-red">¥{if $leader_info.frozen_money}{$leader_info.total_commission}{else}0{/if}</font></span>
									<span>{t domain="affiliate"}已分成：{/t}<font class="ecjiafc-red">¥{if $leader_info.user_money}{$leader_info.total_commission}{else}0{/if}</font></span>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle acc-in" data-toggle="collapse" data-target="#collapseSix"><strong>{t domain="affiliate"}团长订单{/t}</strong></a>
				</div>
				<div class="accordion-body in collapse" id="collapseSix">
					<table class="table table-striped m_b0">
						<thead>
							<tr>
								<td class="w150">{t domain="affiliate"}订单号{/t}</td>
								<td class="w150">{t domain="affiliate"}商家名称{/t}</td>
								<td class="w150">{t domain="affiliate"}下单时间{/t}</td>
								<td class="w200">{t domain="affiliate"}购买者信息{/t}</td>
								<td class="w100">{t domain="affiliate"}总金额{/t}</td>
								<td class="w100">{t domain="affiliate"}佣金{/t}</td>
								<td class="w100">{t domain="affiliate"}团购状态{/t}</td>
								<td class="w100">{t domain="affiliate"}订单状态{/t}</td>
							</tr>
						</thead>
						<tbody>
							<!-- {foreach from=$order_list.list item=list} -->
							<tr>
								<td>1</td>
								<td>2</td>
								<td>3</td>
								<td>1</td>
								<td>2</td>
								<td>3</td>
								<td>1</td>
								<td>2</td>
							</tr>
							<!-- {foreachelse} -->
							<tr>
								<td class="no-records" colspan="8">{t domain="affiliate"}该订单暂无操作记录{/t}</td>
							</tr>
							<!-- {/foreach} -->
						</tbody>
					</table>
					 <!-- {$order_list.page} -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- {/block} -->