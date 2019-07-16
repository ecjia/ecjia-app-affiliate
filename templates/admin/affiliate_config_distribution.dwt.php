<?php defined('IN_ECJIA') or exit('No permission resources.');?>
<!-- {extends file="admin_shop_config.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
    ecjia.admin.affiliate.init();
</script>
<!-- {/block} -->

<!-- {block name="admin_config_form"} -->
<div class="row-fluid edit-page">
    <form method="post" class="form-horizontal" action="{$form_action}" name="theForm" enctype="multipart/form-data">
        <div class="span12">

            <h3 class="heading">{$ur_here}</h3>
            <div class="control-group formSep formSep1 intivee_reward_type intivee_reward_type_balance">
                <label class="control-label">{t domain="affiliate"}分销商数量上限：{/t}</label>
                <div class="controls chk_radio">
                    <input type="text" name="distribution_max_number" value="{$distribution_max_number}"/> 个
                    <div class="help-block">{t domain="affiliate"}设置每个商家最多可添加的分销商数量。{/t}</div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input type="submit" value='{t domain="affiliate"}确定{/t}' class="btn btn-gebo" />
                </div>
            </div>
        </div>
    </form>
</div>
<!-- {/block} -->