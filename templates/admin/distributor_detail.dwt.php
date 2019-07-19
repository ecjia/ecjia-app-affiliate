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
					</div>
				</div>
				<div class="accordion-body in collapse" id="collapseOne">
					<table class="table table-oddtd m_b0">
						<tbody class="first-td-no-leftbd">
							<tr>
								<td><div align="right"><strong>{t domain="affiliate"}分销商名称：{/t}</strong></div></td>
								<td>{$data.user_name}&nbsp;&nbsp;&nbsp;<a target="_blank" href='{url path="user/admin/info" args="id={$data.user_id}"}'>{t domain="affiliate"}[查看会员详情]{/t}</a></td>
								<td><div align="right"><strong>{t domain="affiliate"}手机号码：{/t}</strong></div></td>
								<td>{$data.mobile_phone}</td>
							</tr>
							
							<tr>
								<td><div align="right"><strong>{t domain="affiliate"}分销等级：{/t}</strong></div></td>
								<td>{$data.grade_name}</td>
								<td><div align="right"><strong>{t domain="affiliate"}会员等级：{/t}</strong></div></td>
								<td>{$data.rank_name}</td>
							</tr>
							
							<tr>
								<td><div align="right"><strong>{t domain="affiliate"}推荐人：{/t}</strong></div></td>
								<td>{if $data.parent_id}{$data.parent_name}{else}无{/if}</td>
								<td><div align="right"><strong>{t domain="affiliate"}成为分销商时间：{/t}</strong></div></td>
								<td>{$data.add_time}</td>
							</tr>
							
							<tr>
								<td><div align="right"><strong>{t domain="affiliate"}有效期限：{/t}</strong></div></td>
								<td colspan="3">{$data.expiry_time}</td>
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
									{t domain="affiliate"}团队总数：{/t}
									<font class="ecjiafc-red">
									{if $data.team_count}{$data.team_count}{else}0{/if}
									</font>
									{if $data.team_count}
									<a class="m_l5" target="_blank" href="{RC_Uri::url('affiliate/admin_distributor/team_list')}&user_id={$data.user_id}">{t domain="affiliate"}查看{/t}</a>
									{/if}
									</span>
									<span>{t domain="affiliate"}订单总数：{/t}<font class="ecjiafc-red">{$data.order_number_total}</font></span>
									<span>{t domain="affiliate"}总销售额：{/t}<font class="ecjiafc-red">{$data.order_amount_total}</font></span>
									<span>{t domain="affiliate"}未分佣：{/t}<font class="ecjiafc-red">暂无</font></span>
									<span>{t domain="affiliate"}已分佣：{/t}<font class="ecjiafc-red">暂无</font></span>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			<div>
				<h3 class="heading">{t domain="affiliate"}分成订单{/t}</h3>
			</div>
			<table class="table table-striped smpl_tbl dataTable table-hide-edit">
				<thead>
					<tr>
					    <th class="w150">{t domain="commission"}订单编号{/t}</th>
					    <th class="w150">{t domain="commission"}商家名称{/t}</th>
					    <th class="w150">{t domain="commission"}购买者信息{/t}</th>
					    <th class="w150">{t domain="commission"}推荐人{/t}</th>
					    <th class="w150">{t domain="commission"}订单金额{/t}</th>
					    <th class="w150">{t domain="commission"}需分佣{/t}</th>
					    <th class="w150">{t domain="commission"}分成状态{/t}</th>
					 </tr>
				</thead>

   				<!-- {foreach from=$order_commission_list.list item=list} -->
				<tr>
					<td>
						{assign var=order_url value=RC_Uri::url('quickpay/admin_order/order_info',"order_id={$list.order_id}")}
					    <a href="{$order_url}" target="_blank">{$list.order_sn}</a>
					</td>
				    <td>{$list.merchants_name}</td>
				    <td>{$list.order_amount}</td>
				    <td>{$list.platform_commission}</td>
				    <td>{$list.percent_value}%</td>
					<td>{$list.agent_amount}</td>
					<td>{$list.add_time}</td>
				</tr>
				<!-- {foreachelse} -->
			   	<tr><td class="no-records" colspan="7">{t domain="commission"}没有找到任何记录{/t}</td></tr>
				<!-- {/foreach} -->
			</table>
			<!-- {$order_commission_list.page} -->						
		</div>
	</div>
</div>
<!-- {/block} -->