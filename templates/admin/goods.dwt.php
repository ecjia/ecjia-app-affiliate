<div class="goods-temp-info">
    <p class="m_t10"><a target="_blank" href='{url path="goods/merchant/preview" args="id={$goods.goods_id}"}'>{t domain="promotion"}预览>>{/t}</a></p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="w250">{t domain="promotion"}商品SPU{/t}</th>
                <th>{t domain="promotion"}编号{/t}</th>
                <th class="w110">{t domain="promotion"}限购总数量{/t}<span class="m_l5 red-color">*</span>
                </th>
                <th class="w110">{t domain="promotion"}每人限购{/t}</th>
                <th class="w130">{t domain="promotion"}活动价{/t}<span class="m_l5 red-color">*</span>
                </th>
            </tr>
        </thead>
        <tr>
            <td>
                <img class="ecjiaf-fl" src="{$goods.goods_thumb}" width="60" height="60">
                <div class="product-info">
                    <div class="name">{$goods.goods_name}</div>
                    <div class="other-info">
                        <span class="price">{$goods.formated_shop_price}</span>
                        <span class="number">{t domain="promotion"}库存：{/t}{$goods.goods_number}</span>
                    </div>
                </div>
            </td>
            <td>
                <div class="m_b5">{t domain="promotion"}货号：{/t}{$goods.goods_sn}</div>
            </td>
            <td><input class="form-control" type="text" name="promote_limited" value="{$goods.promote_limited}"></td>
            <td><input class="form-control" type="text" name="promote_user_limited" value="{$goods.promote_user_limited}"></td>
            <td><input class="form-control" type="text" name="promote_price" value="{$goods.promote_price}"></td>
        </tr>
    </table>
</div>