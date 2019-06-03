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
	</h3>
</div>

<div class="row-fluid">
	<form action="{$search_action}" name="searchForm" method="post">
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
				    <th class="w150">{t domain='affiliate'}代理商名称{/t}</th>
				    <th class="w150">{t domain='affiliate'}手机号{/t}</th>
				    <th class="w100">{t domain='affiliate'}推广统计{/t}</th>
				    <th class="w150">{t domain='affiliate'}佣金总额{/t}</th>
				     <th class="w100">{t domain='affiliate'}添加时间{/t}</th>
			  	</tr>
			</thead>
			<!-- {foreach from=$data.list item=list} -->
		    <tr>
		      	<td class="hide-edit-area">
					{$list.agent_name}
		     	  	<div class="edit-list">
		     	  		<a class="data-pjax" href='{url path="affiliate/admin_store_agent/edit" args="id={$list.id}"}'>{t domain='affiliate'}编辑{/t}</a>&nbsp;|&nbsp;
		     	  		<a class="data-pjax" href='{url path="affiliate/admin_store_agent/detail" args="id={$list.id}"}'>{t domain='affiliate'}查看详情{/t}</a>&nbsp;|&nbsp;
						<a class="ajaxremove ecjiafc-red" data-toggle="ajaxremove" data-msg='{t domain="affiliate" 1={$list.agent_name}}你确定要删除【%1】吗？{/t}' href='{url path="affiliate/admin_store_agent/remove" args="id={$list.id}"}'>{t domain='affiliate'}删除{/t}</a>
		    	  	</div>
		      	</td>
		      	<td>{$list.mobile}</td>
		      	<td>0</td>
		      	<td>0</td>
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