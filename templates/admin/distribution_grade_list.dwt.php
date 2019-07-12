<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="ecjia.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
// 	ecjia.admin.affiliate.init();
</script>
<!-- {/block} -->

<!-- {block name="main_content"} -->
<div>
	<h3 class="heading">
		<!-- {if $ur_here}{$ur_here}{/if} -->
		<!-- {if $action_link} -->
		<a class="btn plus_or_reply data-pjax" href="{$action_link.href}"  id="sticky_a"><i class="fontello-icon-plus"></i>{$action_link.text}</a>
		<!-- {/if} -->
	</h3>
</div>

<div class="row-fluid edit-page">
	<div class="span12">
		<table class="table table-striped" id="smpl_tbl">
			<thead>
				<tr>
					<th>{t domain="affiliate"}权益名称{/t}</th>
					<th>{t domain="affiliate"}会员等级{/t}</th>
					<th>{t domain="affiliate"}分销商数量{/t}</th>
					<th>{t domain="affiliate"}有效日期{/t}</th>
					<th>{t domain="affiliate"}操作{/t}</th>
				</tr>
			</thead>
			<tbody>
				<!-- {foreach from=$data.list item=list} -->
				<tr>
					<td>{$list.name}</td>
					<td>{$list.user_rank}</td>
					<td>{$list.count_distributor}</td>
					<td>{$list.date}</td>
					<td>
						<a class="data-pjax" href='{url path="affiliate/admin_interest/edit" args="id={$list.id}"}' title='{t domain="affiliate"}编辑{/t}'><i class="fontello-icon-edit"></i></a>
						<a class="ajaxremove ecjiafc-red" data-toggle="ajaxremove" data-msg='{t domain="affiliate"}您确定要删除吗？{/t}' href='{url path="affiliate/admin_interest/remove" args="id={$list.id}"}' title='{t domain="affiliate"}删除{/t}'><i class="fontello-icon-trash"></i></a>
					</td>
				</tr>
			   	<!-- {foreachelse} -->
				<tr>
					<td class="dataTables_empty" colspan="5">{t domain="affiliate"}没有找到任何记录{/t}</td>
				</tr>
	        	<!-- {/foreach} -->
			</tbody>
		</table>
	</div>
</div>

<!-- {/block} -->