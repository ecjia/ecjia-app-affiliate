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
						<strong>{t domain="groupbuy"}基本信息{/t}</strong>
						{if $leader_info.review_satus eq 1}
						<a target="_blank" href='{url path="groupbuy/admin_leader/edit" args="user_id={$leader_info.user_id}"}'>{t domain="groupbuy"}编辑{/t}</a>
						{/if}
					</div>
				</div>
				<div class="accordion-body in collapse" id="collapseOne">
					<table class="table table-oddtd m_b0">
						<tbody class="first-td-no-leftbd">
							<tr>
								<td><div align="right"><strong>{t domain="groupbuy"}团长名称：{/t}</strong></div></td>
								<td>{$leader_info.user_name}</td>
								<td><div align="right"><strong>{t domain="groupbuy"}邮箱账号：{/t}</strong></div></td>
								<td>{$leader_info.email}</td>
							</tr>
							<tr>
								<td><div align="right"><strong>{t domain="groupbuy"}手机号码：{/t}</strong></div></td>
								<td>{$leader_info.mobile}</td>
								<td><div align="right"><strong>{t domain="groupbuy"}会员等级：{/t}</strong></div></td>
								<td>{$leader_info.user_rank}</td>
							</tr>
							<tr>
								<td><div align="right"><strong>{t domain="groupbuy"}QQ：{/t}</strong></div></td>
								<td>{if $leader_info.qq}{$leader_info.qq}{else}未绑定{/if}</td>
								<td><div align="right"><strong>{t domain="groupbuy"}提现账号：{/t}</strong></div></td>
								<td>{if $withdraw_data}{$withdraw_data.bank_name}({$withdraw_data.cardholder}){else}未绑定{/if}</td>
							</tr>
							<tr>
								<td><div align="right"><strong>{t domain="groupbuy"}注册时间：{/t}</strong></div></td>
								<td>{$leader_info.reg_time}</td>
								<td><div align="right"><strong>{t domain="groupbuy"}团长状态：{/t}</strong></div></td>
								<td>{if $leader_info.review_satus eq 1}{t domain="groupbuy"}审核通过{/t}{elseif $leader_info.review_satus eq 2}{t domain="groupbuy"}审核未通过{/t}{else}{t domain="groupbuy"}待审核{/t}{/if}</td>
							</tr>
							<tr>
								<td><div align="right"><strong>{t domain="groupbuy"}申请时间：{/t}</strong></div></td>
								<td>{$leader_info.add_time}</td>
								<td><div align="right"><strong>{t domain="groupbuy"}申请来源：{/t}</strong></div></td>
								<td>{if $leader_info.apply_source eq 'admin'}平台{else}小程序{/if}</td>
							</tr>
							<tr>
								<td><div align="right"><strong>{t domain="groupbuy"}小区名称：{/t}</strong></div></td>
								<td>{$leader_info.address}</td>
								<td><div align="right"><strong>{t domain="groupbuy"}提货点：{/t}</strong></div></td>
								<td>{$leader_info.pick_up_point}</td>
							</tr>
							<tr>
								<td><div align="right"><strong>{t domain="groupbuy"}所在地区：{/t}</strong></div></td>
								<td colspan="3">{$leader_info.province}&nbsp;{$leader_info.city}&nbsp;{$leader_info.district}&nbsp;{$leader_info.street}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="accordion-group">
				<div class="accordion-heading accordion-heading-url">
					<div class="accordion-toggle acc-in" data-toggle="collapse"  data-target="#collapseFive">
						<strong>{t domain="groupbuy"}团长资金{/t}</strong>
					</div>
				</div>
				<div class="accordion-body in collapse" id="collapseFive">
					<table class="table h70">
						<tr>
							<td>
								<div class="order_number m_t30">
									<span>{t domain="groupbuy"}销售额：{/t}<font class="ecjiafc-red">¥{$leader_info.sales_money}</font></span>
									<span>{t domain="groupbuy"}累计佣金：{/t}<font class="ecjiafc-red">¥{$leader_info.total_commission}</font></span>
									<span>{t domain="groupbuy"}冻结资金：{/t}<font class="ecjiafc-red">¥{$leader_info.frozen_money}</font></span>
									<span>{t domain="groupbuy"}账户余额：{/t}<font class="ecjiafc-red">¥{$leader_info.user_money}</font> 
										<a class="m_l5" target="_blank" href="{RC_Uri::url('finance/admin_account_log/init')}&account_type=user_money&user_id={$leader_info.user_id}">{t domain="groupbuy"}查看{/t}</a>
									</span>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle acc-in" data-toggle="collapse" data-target="#collapseSix"><strong>{t domain="groupbuy"}团长订单{/t}</strong></a>
				</div>
				<div class="accordion-body in collapse" id="collapseSix">
					<table class="table table-striped m_b0">
						<thead>
							<tr>
								<td class="w150">{t domain="groupbuy"}订单号{/t}</td>
								<td class="w150">{t domain="groupbuy"}商家名称{/t}</td>
								<td class="w150">{t domain="groupbuy"}下单时间{/t}</td>
								<td class="w200">{t domain="groupbuy"}购买者信息{/t}</td>
								<td class="w100">{t domain="groupbuy"}总金额{/t}</td>
								<td class="w100">{t domain="groupbuy"}佣金{/t}</td>
								<td class="w100">{t domain="groupbuy"}团购状态{/t}</td>
								<td class="w100">{t domain="groupbuy"}订单状态{/t}</td>
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
								<td class="no-records" colspan="8">{t domain="groupbuy"}该订单暂无操作记录{/t}</td>
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