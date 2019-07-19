// JavaScript Document
;(function (app, $) {
    app.distributor_list = {
        init: function () {
			$('.screen-btn').on('click', function(e) {
				e.preventDefault();
				var url		 = $("form[name='searchForm']").attr('action');
				var keywords = $("input[name='keywords']").val();
				
                if (keywords != '') {
                    url += '&keywords=' + keywords;
                }
				ecjia.pjax(url);
			});
        }
    };
    
    app.team_list = {
        init: function () {
            $(".select-button").click(function () {
                var url = $("form[name='searchForm']").attr('action');
                var keywords = $("input[name='keywords']").val();
                if (keywords != '') {
                    url += '&keywords=' + keywords;
                }
                ecjia.pjax(url);
            });
        },
    };
})(ecjia.admin, jQuery);

// end
