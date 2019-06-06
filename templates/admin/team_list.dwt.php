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
		<!-- {if $ur_here}{$ur_here}{/if} --><small>（上级代理：{$agent_name}）</small>
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
				    <th class="w150">{t domain='affiliate'}代理商名称{/t}</th>
				    <th class="w150">{t domain='affiliate'}会员信息{/t}</th>
				    <th class="w100">{t domain='affiliate'}推荐店铺数量{/t}</th>
				    <th class="w150">{t domain='affiliate'}佣金总额{/t}</th>
				    <th class="w100">{t domain='affiliate'}加入时间{/t}</th>
			  	</tr>
			</thead>
			
			<!-- {foreach from=$data.list item=list} -->
		    <tr>
		      	<td>{$list.agent_name}</td>
		      	<td>{$list.user_name}<br>{$list.mobile_phone}</td>
		      	<td>{$list.store_num}</td>
		      	<td>￥{if $list.money.agent_amount_total}{$list.money.agent_amount_total}{else}0{/if}</td>
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