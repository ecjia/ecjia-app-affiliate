// JavaScript Document
;(function (app, $) {
    app.distribution_grade_info = {
        init: function () {
            app.distribution_grade_info.search_goods();
            app.distribution_grade_info.search_link_opt();
            app.distribution_grade_info.add_link();
            
            app.distribution_grade_info.submit_form();
        },
        
        search_goods: function () {
            $('.searchGoods').off('click').on('click', function () {
                var searchURL = $(".searchForm").attr('data-href'),
                    cat_id = $("select[name='cat_id']").val(),
                    goods_keywords = $("input[name='goods_keywords']").val(),
                    goods_sn = $("input[name='goods_sn']").val();
                var filters = {
                    'cat_id': cat_id,
                    'goods_keywords': goods_keywords,
                    'goods_sn': goods_sn
                };
                $.post(searchURL, filters, function (data) {
                    $("input[name='id']").val('');
                    app.distribution_grade_info.goods_list(data);
                }, "JSON");
            });

            $('.select-goods-btn').off('click').on('click', function () {
                var url = $(".nav-list-ready").attr('data-url'),
                    id = $("input[name='id']").val();
                if (id == '' || id == 0 || id == undefined) {
                    smoke.alert(js_lang.pls_select_goods, {ok: js_lang.ok});
                    return false;
                }
                var json = {
                    'id': id,
                    'type': 'add'
                };
                $.post(url, json, function (data) {
                    $('.change_goods').removeClass('hide');
                    $('.choose_goods').addClass('hide');

                    $('#addModal').modal('hide');
                    $(".modal-backdrop").remove();

                    $('.goods-temp-content').html(data.content);
                }, "JSON");
            });
        },
        
        goods_list: function (data) {
            $('.nav-list-ready').html('');
            if (data.content.length > 0) {
                for (var i = 0; i < data.content.length; i++) {
                    var disable = $('.nav-list-content .ms-elem-selection').find('input[value="' + data.content[i].value + '"]').length ? 'disabled' : '';
                    var opt = '<li class="ms-elem-selectable ' + disable + '" data-id="' + data.content[i].goods_id + '"><span>' + data.content[i].goods_name + '</span></li>'
                    $('.nav-list-ready').append(opt);
                }
            } else {
                $('.nav-list-ready').append('<li class="ms-elem-selectable disabled"><span>' + js_lang.goods_information_not_found + '</span></li>');
            }

            app.distribution_grade_info.search_link_opt();
            app.distribution_grade_info.add_link();
        },

        search_link_opt: function () {
            //li搜索筛选功能
            $('#ms-search').quicksearch(
                $('.ms-elem-selectable', '#ms-custom-navigation'), {
                    onAfter: function () {
                        $('.ms-group').each(function () {
                            $(this).find('.isShow').length ? $(this).css('display', 'block') : $(this).css('display', 'none');
                        });
                        return;
                    },
                    show: function () {
                        this.style.display = "";
                        $(this).addClass('isShow');
                    },
                    hide: function () {
                        this.style.display = "none";
                        $(this).removeClass('isShow');
                    }
                });
        },

        add_link: function () {
            $('.nav-list-ready li').on('click', function () {
                var $this = $(this),
                    id = $this.attr('data-id'),
                    url = $('.nav-list-ready').attr('data-url');
                
                $('input[name="id"]').val(id);
                if (!$this.hasClass('disabled')) {
                    $this.addClass('disabled');
                    $this.siblings('li').removeClass('disabled');

                    $('.nav-list-content').html('');
                    $.post(url, {id: id}, function (data) {
                        $('.nav-list-content').html(data.content);
                    });
                }
            });
        },

        submit_form: function () {
            var $form = $("form[name='theForm']");
            var option = {
                rules: {
                	grade_name: {
                        required: true
                    },
                    user_rank: {required: true, min: 1}
                },
                messages: {
                	grade_name: {
	                    required: js_lang.pls_grade_name,
	                },
	                user_rank: {min: js_lang.select_user_rank}
                },
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
        }
    };
})(ecjia.admin, jQuery);

// end
