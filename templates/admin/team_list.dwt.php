<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.team_list.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->

<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} --><small>（上级代理：{$distributor_name}）</small>
		<!-- {if $action_link} -->
		<a class="btn plus_or_reply data-pjax" href="{$action_link.href}"><i class="fontello-icon-reply"></i>{$action_link.text}</a>
		<!-- {/if} -->
	</h3>
</div>

<div class="count_box">
	<p>{t domain='affiliate'}团队总人数：{/t}<span class="ecjiafc-red">{$team_count}</span></p>
</div>

<div class="row-fluid">
	<form action="{$search_action}" name="searchForm" method="post">
		<div class="choose_list m_t10">
			<input class="w180" type="text" name="keywords" value="{$list.filter.keywords}" placeholder="{t domain='affiliate'}请输入会员名称/手机号{/t}" />
			<button class="btn select-button" type="button">{t domain='affiliate'}搜索{/t}</button>
		</div>
	</form>
</div>

<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped smpl_tbl table-hide-edit">
			<thead>
				<tr>
				    <th class="w150">{t domain='affiliate'}会员名称{/t}</th>
				    <th class="w150">{t domain='affiliate'}手机号{/t}</th>
				    <th class="w100">{t domain='affiliate'}总订单数{/t}</th>
				    <th class="w150">{t domain='affiliate'}总销售额{/t}</th>
				    <th class="w100">{t domain='affiliate'}加入时间{/t}</th>
			  	</tr>
			</thead>
			
			<!-- {foreach from=$data.list item=list} -->
		    <tr>
		      	<td>{$list.user_name}</td>
		      	<td>{$list.mobile_phone}</td>
		      	<td>{$list.order_number_total}</td>
		      	<td>{$list.formatted_order_amount_total}</td>
		      	<td>{$list.add_time}</td>
		    </tr>
		    <!-- {foreachelse} -->
	        <tr><td class="no-records" colspan="5">{t domain='affiliate'}没有找到任何记录{/t}</td></tr>
			<!-- {/foreach} -->
            </tbody>
         </table>
         <!-- {$data.page} -->
	</div>
</div>
<!-- {/block} -->