<div class="goods-content">
    <div class="goods-info">
        <div class="left">
            <img src="{$goods.goods_thumb}" alt="">
        </div>
        <div class="right">
            <div class="name">{$goods.goods_name}</div>
            <div class="goods_sn">{t domain="promotion"}货号：{/t}{$goods.goods_sn}</div>
            <div class="info">
                <span class="price">{$goods.formated_shop_price}</span>
                <span class="market_price">{t domain="promotion"}市场价：{/t}{$goods.formated_market_price}</span>
                <span class="goods_number">{t domain="promotion"}库存：{/t}{$goods.goods_number}</span>
            </div>
            <div><a target="_blank" href='{url path="goods/admin/preview" args="id={$goods.goods_id}"}'>{t domain="promotion"}预览>>{/t}</a>
            </div>
        </div>
    </div>
</div>