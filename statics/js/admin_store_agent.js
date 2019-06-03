// JavaScript Document
;
(function (app, $) {
    app.store_agent_list = {
        init: function () {
            $(".date").datepicker({
                format: "yyyy-mm-dd",
                container: '.main_content',
            });
            app.store_agent_list.search();
        },

        search: function () {
            $(".select-button").click(function () {
                var start_date = $("input[name='start_date']").val();
                var end_date = $("input[name='end_date']").val();
                if (start_date != '' && end_date != '' && start_date >= end_date) {
                    var data = {
                        message: js_lang.time_error,
                        state: "error",
                    };
                    ecjia.admin.showmessage(data);
                    return false;
                }
                var url = $("form[name='searchForm']").attr('action');
                if (start_date != '') url += '&start_date=' + start_date;
                if (end_date != '') url += '&end_date=' + end_date;
                var keywords = $("input[name='keywords']").val();
                if (keywords != '') {
                    url += '&keywords=' + keywords;
                }
                ecjia.pjax(url);
            });
        },
    };

    app.store_agent_info = {
        init: function () {
        	app.store_agent_info.validate();
            app.store_agent_info.submit_form();
        },
        
        validate: function () {
            $(".user-mobile").koala({
                delay: 500,
                keyup: function (event) {
                    var $this = $(this);
                    var url = $this.attr('action');
                    var mobile = $this.val();
                    if (mobile.length < 11) {
                        return false;
                    }
                    var data = {
                        user_mobile: mobile,
                    }
                    $.post(url, data, function (data) {
                        if (data.state == 'error') {
                        	 $('.agent_name_css').hide();
                        	 if(data.result) {
                        		 $('input[name="user_id"]').val(data.result.user_id);
                                 $('input[name="agent_name"]').val(data.result.agent_name); 
                        	 } 
                             ecjia.admin.showmessage(data);
                        } else {
                        	 $('.agent_name_css').show();
                        	 $('.result_agent_name').html(data.result.agent_name);
                             $('input[name="user_id"]').val(data.result.user_id);
                             $('input[name="agent_name"]').val(data.result.agent_name);
                        }
                    }, 'json');
                }
            });
        },
        
	    submit_form: function (formobj) {
	        var $form = $("form[name='theForm']");
	        var option = {
	            rules: {
	            	user_mobile: {
	                    required: true
	                }
	            },
	            messages: {
	            	user_mobile: {
	                    required: js_lang.mobile
	                }
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