<div class="goods-content">
    <div class="goods-info">
        <div class="left">
            <img src="{$goods.goods_thumb}" alt="">
        </div>
        <div class="right">
            <div class="name">{$goods.goods_name}</div>
            <div class="goods_sn">{t domain="affiliate"}货号：{/t}{$goods.goods_sn}</div>
            <div class="info">
                <span class="price">{$goods.formated_shop_price}</span>
                <span class="market_price">{t domain="affiliate"}市场价：{/t}{$goods.formated_market_price}</span>
                <span class="goods_number">{t domain="affiliate"}库存：{/t}{$goods.goods_number}</span>
            </div>
            <div><a target="_blank" href='{url path="goods/merchant/preview" args="id={$goods.goods_id}"}'>{t domain="affiliate"}预览>>{/t}</a>
            </div>
        </div>
    </div>

    <div class="product-info">
    	{if $data_grade or $brokerage}
        	<div class="title">{t domain="affiliate"}推广佣金{/t}</div>
        {/if}
        
        <div class="goods-info m_b10">
         	 {if $brokerage}
             	<label>{t domain="affiliate"}门店佣金：{/t}{$brokerage}</label>
			 {/if}	
			 
        	 {if $data_grade}	
             <label class="w10">{t domain="affiliate"}分销权益：{/t}</label>
             <table class="table table-striped">
				<thead>
					<tr>
						<th>{t domain="affiliate"}分销等级{/t}</th>
						<th>{t domain="affiliate"}佣金{/t}</th>
					</tr>
				</thead>
				<tbody>
					<!-- {foreach from=$data_grade item=val} -->
					<tr>
						<td>{$val.grade_name}</td>
						<td>{$val.formated_grade_price}</td>
					</tr>
		        	<!-- {/foreach} -->
				</tbody>
			 </table>
             {/if}
        </div>
    </div>
</div>