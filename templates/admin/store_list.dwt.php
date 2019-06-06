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
		<!-- {if $ur_here}{$ur_here}{/if} --><small>（当前代理：{$agent_name}）</small>
		<!-- {if $action_link} -->
		<a class="btn plus_or_reply data-pjax" href="{$action_link.href}"><i class="fontello-icon-reply"></i>{$action_link.text}</a>
		<!-- {/if} -->
	</h3>
</div>

<div class="count_box">
	<p>{t domain='affiliate'}推广店铺总数：{/t}<span class="ecjiafc-red">{$store_count}</span></p>
</div>


<ul class="nav nav-pills">
    <li class="{if $type eq ''}active{/if}">
        <a class="data-pjax" href='{url path="affiliate/admin_store_agent/store_list" args="&id={$id}{if $filter.keywords}&keywords={$filter.keywords}{/if}"}'>
            {t domain="affiliate"}直推店铺{/t}<span class="badge badge-info">{if $type_count.parent}{$type_count.parent}{else}0{/if}</span>
        </a>
    </li>
    
    <li class="{if $type eq 'next'}active{/if}">
        <a class="data-pjax" href='{url path="affiliate/admin_store_agent/store_list" args="type=next&id={$id}{if $filter.keywords}&keywords={$filter.keywords}{/if}"}'>
            {t domain="affiliate"}下级推广店铺{/t}<span class="badge badge-info">{if $type_count.next}{$type_count.next}{else}0{/if}</span>
        </a>
    </li>

    <li class="ecjiaf-fn">
        <form name="searchForm" method="post" action="{$search_action}{if $smarty.get.type}&type={$smarty.get.type}{/if}">
            <div class="f_r form-inline">
                <input class="w180" type="text" name="keywords" value="{$list.filter.keywords}" placeholder="{t domain='affiliate'}请输入商家名称{/t}" />
				<button class="btn select-button" type="button">{t domain='affiliate'}搜索{/t}</button>
            </div>
        </form>
    </li>
</ul>

<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped smpl_tbl table-hide-edit">
			<thead>
				<tr>
				    <th class="w150">{t domain='affiliate'}商家名称{/t}</th>
				    <th class="w150">{t domain='affiliate'}店铺分类{/t}</th>
				    {if $type neq ''}
				    <th class="w100">{t domain='affiliate'}推荐人{/t}</th>
				    {/if}
				    <th class="w150">{t domain='affiliate'}成交订单数{/t}</th>
				    <th class="w100">{t domain='affiliate'}成交总金额{/t}</th>
				    <th class="w100">{t domain='affiliate'}加入时间{/t}</th>
			  	</tr>
			</thead>
			
			<!-- {foreach from=$data.list item=list} -->
		    <tr>
		      	<td>{$list.merchants_name}</td>
		      	<td>{$list.cat_name}</td>
		      	{if $type neq ''}
		      	<td>{$agent_name}</td>
		      	{/if}
		      	<td>0</td>
		      	<td>0</td>
		      	<td>{$list.apply_time}</td>
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