<!-- {nocache} -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Description" content="" />
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
<title>{$title}</title>
<link href="{$front_url}/css/affiliate.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<img style="width: 100%;" src="{$front_url}/images/invite.png">
	<div class="form">
		<form class="invite-form" name="theForm" action="">
			<div class="input-container"><input type="text" name="mobile" placeholder="输入手机号码"/></div>
			<div class="input-container">
				<span class="identify_code">GY6B</span>
				<input class="code_captcha" type="text" name="mobile" placeholder="请输入左侧验证码"/>
				<span class="identify_code_btn">验证</span>
			</div>
			<div class="input-container"><input type="text" name="code" placeholder="输入短信验证码"/></div>
			<input class="receive_btn" type="submit" value="立即领取" />
		</form>
	</div>
	<div class="invite-notice">
		<ul>
		<li><p><i>1.</i>好友通过您的邀请，打开链接，在活动页输入手机号码登录，即可获得奖励；</p></li>
		<li><p><i>2.</i>每邀请一位新人好友并完成注册都可获得相应的奖励；</p></li>
		<li><p><i>3.</i>奖励一经领取后，不可删除，不可提现，不可转赠；</p></li>
		<li><p><i>4.</i>新用户领取的奖励查看方式：【我的-我的钱包】查看；</p></li>
		<li><p><i>5.</i>如有任何的疑问请咨询官网客服人员。</p></li>
		</ul>
	</div>
	<div class="wx-affiliate hide"><img src="{RC_App::apps_url('affiliate/statics/front/images/wx_affiliate.png')}"></div>
</body>
</html>
<!-- {* 包含脚本文件 *} -->
<script src="{$front_url}/js/jquery.min.js" type="text/javascript"></script>
<script src="{$front_url}/js/ecjia.js" type="text/javascript"></script>
<script src="{$front_url}/js/ecjia-front.js" type="text/javascript"></script>
<script src="{$front_url}/js/affiliate.js" type="text/javascript"></script>

<script type="text/javascript">
ecjia.front.affiliate.init();
</script>
<!-- {/nocache} -->