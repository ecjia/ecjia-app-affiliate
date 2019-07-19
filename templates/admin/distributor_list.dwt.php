<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.admin.distributor_list.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div class="row-fluid">
	<ul class="nav nav-pills">
		<li class="{if $filter.distributor_type eq ''}active{/if}">
			<a class="data-pjax" href='{url path="affiliate/admin_distributor/init" args="{if $filter.keywords}&keywords={$filter.keywords}{/if}"}'>
				{t domain="affiliate"}使用中{/t}
				<span class="badge badge-info">
					{if $data.distributor_count.can_use}{$data.distributor_count.can_use}{else}0{/if}
				</span> 
			</a>
		</li>
		<li class="{if $filter.distributor_type eq 'expiry'}active{/if}">
			<a class="data-pjax" href='{url path="affiliate/admin_distributor/init" args="distributor_type=expiry{if $filter.keywords}&keywords={$filter.keywords}{/if}"}'>
				{t domain="affiliate"}已过期{/t}
				<span class="badge badge-info">{if $data.distributor_count.expiry}{$data.distributor_count.expiry}{else}0{/if}</span>
			</a>
		</li>
	</ul>
	
	<div class="choose_list f_r">
		<form class="f_r" action="{$search_action}{if $filter.distributor_type}&distributor_type={$filter.distributor_type}{/if}"  method="post" name="searchForm">
			<input type="text" name="keywords" value="{$filter.keywords}" placeholder='{t domain="affiliate"}请输入会员名或手机号{/t}' />
			<input class="btn screen-btn" type="submit" value='{t domain="affiliate"}搜索{/t}'>
		</form>
	</div>
</div>
	
<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped smpl_tbl table-hide-edit">
			<thead>
				<tr>
				    <th class="w150">{t domain="affiliate"}会员信息{/t}</th>
				    <th class="w150">{t domain="affiliate"}所属等级{/t}</th>
				    <th class="w100">{t domain="affiliate"}推荐人{/t}</th>
				    <th class="w150">{t domain="affiliate"}总订单数{/t}</th>
				    <th class="w100">{t domain="affiliate"}总销售额{/t}</th>
				    <th class="w100">{t domain="affiliate"}佣金总额{/t}</th>
				    <th class="w150">{t domain="affiliate"}成为分销商时间{/t}</th>
				    <th class="w150">{t domain="affiliate"}有效期限{/t}</th>
			  	</tr>
			</thead>
			<!-- {foreach from=$data.list item=list} -->
		    <tr>
		      	<td class="hide-edit-area">
					{$list.user_name}<br>{$list.mobile_phone}
		     	  	<div class="edit-list">
						<a class="data-pjax" href='{url path="affiliate/admin_distributor/detail" args="user_id={$list.user_id}"}' title='{t domain="affiliate"}查看详情{/t}' >{t domain="affiliate"}查看详情{/t}</a>
		    	  	</div>
		      	</td>
		      	
		      	<td>分销：{$list.grade_name}<br>会员：{$list.rank_name}</td>
		      	<td>{if $list.parent_name}{$list.parent_name}{else}无{/if}</td>
		      	<td>{$list.order_number_total}</td>
		      	<td>{$list.formatted_order_amount_total}</td>
		      	<td>{$list.formatted_brokerage_amount_total}</td>
		      	<td>{$list.add_time}</td>
				<td>{$list.expiry_time}</td>
		    </tr>
		    <!-- {foreachelse} -->
	        <tr><td class="no-records" colspan="8">{t domain="affiliate"}没有找到任何记录{/t}</td></tr>
			<!-- {/foreach} -->
            </tbody>
         </table>
         <!-- {$data.page} -->
	</div>
</div>
<!-- {/block} -->