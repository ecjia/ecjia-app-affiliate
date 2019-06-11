<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.store_agent_list.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->

<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		<!-- {if $action_link} -->
		<a class="btn plus_or_reply data-pjax" href="{$action_link.href}"><i class="fontello-icon-plus"></i>{$action_link.text}</a>
		<!-- {/if} -->
		<a class="btn plus_or_reply" id="sticky_a" href='{RC_Uri::url("affiliate/admin_store_agent/download", "{$url_parames}")}'><i class="fontello-icon-download"></i>{t domain="affiliate"}导出结果{/t}</a>
	</h3>
</div>

<div class="row-fluid">
	<form action="{$search_action}" name="searchForm" method="post">
		<div class="btn-group f_l m_r5">
			<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fontello-icon-cog"></i>{t domain="affiliate"}批量操作{/t}
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li><a class="button_remove" data-toggle="ecjiabatch" data-idClass=".checkbox:checked" data-url="{url path='affiliate/admin_store_agent/batch'}" data-msg='{t domain="affiliate"}您确实要删除选中的店铺代理商吗？{/t}' data-noSelectMsg='{t domain="affiliate"}请先选中要删除的店铺代理商{/t}' data-name="id" href="javascript:;"><i class="fontello-icon-trash"></i>{t domain="affiliate"}删除店铺代理商{/t}</a></li>
			</ul>
		</div>
		
		<div class="choose_list f_r m_t10">
			<input class="date f_l w150" name="start_date" type="text" value="{$smarty.get.start_date}" placeholder="{t domain='affiliate'}开始日期{/t}"> <span class="f_l">{t domain='affiliate'}至{/t}</span>
			<input class="date f_l w150" name="end_date" type="text" value="{$smarty.get.end_date}" placeholder="{t domain='affiliate'}结束日期{/t}"> <input class="w180" type="text" name="keywords" value="{$list.filter.keywords}" placeholder="{t domain='affiliate'}请输入会员名称/手机号{/t}" />
			<button class="btn select-button" type="button">{t domain='affiliate'}搜索{/t}</button>
		</div>
	</form>
</div>

<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped smpl_tbl table-hide-edit">
			<thead>
				<tr>
				 	<th class="table_checkbox"><input type="checkbox" name="select_rows" data-toggle="selectall" data-children=".checkbox"/></th>
				    <th class="w150">{t domain='affiliate'}代理商名称{/t}</th>
				    <th class="w150">{t domain='affiliate'}会员信息{/t}</th>
				    <th class="w100">{t domain='affiliate'}推广统计{/t}</th>
				    <th class="w150">{t domain='affiliate'}佣金总额{/t}</th>
				     <th class="w100">{t domain='affiliate'}添加时间{/t}</th>
			  	</tr>
			</thead>
			<!-- {foreach from=$data.list item=list} -->
		    <tr>
		    	<td>
					<span><input type="checkbox" name="checkboxes[]" class="checkbox" value="{$list.id}"/></span>
				</td>
		      	<td class="hide-edit-area">
					{$list.agent_name}
		     	  	<div class="edit-list">
		     	  		<a class="data-pjax" href='{url path="affiliate/admin_store_agent/edit" args="id={$list.id}"}'>{t domain='affiliate'}编辑{/t}</a>&nbsp;|&nbsp;
		     	  		<a class="data-pjax" href='{url path="affiliate/admin_store_agent/detail" args="id={$list.id}"}'>{t domain='affiliate'}查看详情{/t}</a>&nbsp;|&nbsp;
						<a class="ajaxremove ecjiafc-red" data-toggle="ajaxremove" data-msg='{t domain="affiliate" 1={$list.agent_name}}你确定要删除【%1】吗？{/t}' href='{url path="affiliate/admin_store_agent/remove" args="id={$list.id}"}'>{t domain='affiliate'}删除{/t}</a>
		    	  	</div>
		      	</td>
		      	<td>{$list.user_name}<br>{$list.mobile_phone}</td>
		      	<td>{t domain='affiliate'}团队：{$list.team_count}{/t}
		      	<br>
		      	{t domain='affiliate'}店铺：{$list.store_num}{/t}
		      	</td>
		      	<td>{if $list.agent_amount_total}￥{$list.agent_amount_total}{else}0{/if}</td>
		      	<td>{$list.add_time}</td>
		    </tr>
		    <!-- {foreachelse} -->
	        <tr><td class="no-records" colspan="6">{t domain='affiliate'}没有找到任何记录{/t}</td></tr>
			<!-- {/foreach} -->
            </tbody>
         </table>
         <!-- {$data.page} -->
	</div>
</div>
<!-- {/block} -->