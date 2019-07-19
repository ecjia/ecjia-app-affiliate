<div class="goods-temp-info">
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="w250">{t domain="affiliate"}店铺+商品信息{/t}</th>
                <th class="w100">{t domain="affiliate"}编号{/t}</th>
                <th class="w100">{t domain="affiliate"}成本价{/t}</th>
                <th class="w200">{t domain="affiliate"}等级佣金{/t}</th>
                <th class="w130">{t domain="affiliate"}门店佣金{/t}</th>
            </tr>
        </thead>
        <tr>
            <td>
                <img class="ecjiaf-fl" src="{$goods.goods_thumb}" width="60" height="60">
                <div class="product-info">
                    <div class="name">{$goods.goods_name}</div>
                    <div class="other-info">
                        <span class="price">{$goods.formated_shop_price}</span>
                        <span class="number">{t domain="affiliate"}库存：{/t}{$goods.goods_number}</span>
                    </div>
                </div>
            </td>
            <td>
                <div class="m_b5">
                {t domain="affiliate"}货号：{/t}{$goods.goods_sn}
                {if $goods.goods_barcode}
	                <br>
	                {t domain="affiliate"}条形码：{$goods.goods_barcode}{/t}
                {/if}
                </div>
            </td>
            <td>{$goods.formated_cost_price}</td>
            <td>
	            {if $data_grade}
	            <!-- {foreach from=$data_grade item=val} -->
					{$val.grade_name}：{$val.formated_grade_price}<br>
			    <!-- {/foreach} -->
			    {else}
			    	未设置
			    {/if}
		    </td>
            <td>{if $brokerage}{$brokerage}{else}未设置{/if}</td>
        </tr>
    </table>
</div>