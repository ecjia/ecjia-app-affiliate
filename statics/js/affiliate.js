11 // JavaScript Document
;
(function (app, $) {
    app.affiliate = {
        init: function () {
            app.affiliate.invite_submit();
            app.affiliate.submit_form();
            app.affiliate.screen_click();
            app.affiliate.search_order();
        },

        invite_submit: function () {
            $("form[name='invite']").on('submit', function (e) {
                e.preventDefault();
                var ua = navigator.userAgent.toLowerCase();
                if (ua.match(/MicroMessenger/i) == "micromessenger") {
                    $('.wx-affiliate').removeClass('hide').css('top', '0px');

                    //禁用滚动条
                    $('body').css('overflow-y', 'hidden').on('touchmove', function (event) {
                        event.preventDefault;
                    }, false);
                    $('.wx-affiliate').on('click', function () {
                        $('.wx-affiliate').addClass('hide');
                        $('body').css('overflow-y', 'auto').off("touchmove"); //启用滚动条
                    })
                    return false;
                }

                var url = $("form[name='invite']").attr('action');
                var mobile_phone = $("input[name='mobile_phone']").val();
                var invite_code = $("input[name='invite_code']").val();

                var phoneReg = /^1[34578]\d{9}$/;
                if (phoneReg.test(mobile_phone) == false) {
                    alert('填写的手机号码格式不正确');
                    return false;
                }

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        mobile_phone: mobile_phone,
                        invite_code: invite_code,
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.state == 'error') {
                            alert(data.message);
                            location.href = data.url;
                        } else {
                            location.href = data.url;
                        }
                    }
                });
            });
        },

        submit_form: function (formobj) {
            var $form = $("form[name='theForm']");
            var option = {
                submitHandler: function () {
                    $form.ajaxSubmit({
                        dataType: "json",
                        success: function (data) {
                            ecjia.admin.showmessage(data);
                        }
                    });
                }
            }
            var options = $.extend(ecjia.admin.defaultOptions.validate, option);
            $form.validate(options);
        },

        screen_click: function () {
            $('.screen-btn').off('click').on('click', function (e) {
                e.preventDefault();
                var url = $("form[name='search_from']").attr('action');
                var status = $("select[name='status']").val();
                if (status != '') {
                    url += '&status=' + status;
                }

                var order_sn = $("input[name='order_sn']").val();
                if (order_sn != '') {
                    url += '&order_sn=' + order_sn;
                }

                ecjia.pjax(url);
            });
        },

        search_order: function () {
            $('.search_order').off('click').on('click', function (e) {
                e.preventDefault();
                var url = $("form[name='search_from']").attr('action');
                var status = $("select[name='status']").val();
                if (status != '') {
                    url += '&status=' + status;
                }

                var order_sn = $("input[name='order_sn']").val();
                if (order_sn != '') {
                    url += '&order_sn=' + order_sn;
                }
                ecjia.pjax(url);
            });
        },

        info: function () {
            app.affiliate.percent_form();
        },

        percent_form: function () {
            var $form = $("form[name='percent_form']");
            var option = {
                submitHandler: function () {
                    $form.ajaxSubmit({
                        dataType: "json",
                        success: function (data) {
                            ecjia.admin.showmessage(data);
                        }
                    });
                }
            }
            var options = $.extend(ecjia.admin.defaultOptions.validate, option);
            $form.validate(options);
        },
    };
})(ecjia.admin, jQuery);