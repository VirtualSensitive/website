(function($) {
	"use strict";
	var themeVars = {
			'@ColorFirst' 	: '#d5ff00',
			'@ImagesDir'	: "'"+demo_var.themeURL+'/images/'+"'" 
			};
	function setDemoColor(color){
		$.cookie("defColor", color, {path:'/'});
		themeVars['@ColorFirst'] = color;
		less.modifyVars(themeVars);
		// chance chart color
		$('.chart').each(function(key, data) {
				var get_data = '<article class="chart ng-isolate-scope ng-scope" data-percent="40"> <div class="percents"> <span class="percent"></span>% </div> </article>'
				$(data).parents(".processbar").find('h3').before(get_data);
				$(data).remove();

			})
		$(".chart").easyPieChart({
			size: '200',
			scaleColor: false,
			lineWidth: 20,
			animate: 2000,
			trackColor: "#d2d4d8",
			barColor: color,
			easing: 'easeOut',
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});
	}
	$(document).ready(function() {
		var defColor = $.cookie("defColor");
		if(defColor!=null){
			setDemoColor(defColor);
		}
		
		$(document).delegate('.show-setting', 'click', function() {
			if (!$('#switch').hasClass('open-switch')) {
				$('#switch').addClass('open-switch');
				$('#switch').animate({'left': 0});
			} else {
				$('#switch').removeClass('open-switch');
				$('#switch').animate({'left': -190});
			}
		});

		$(".switch-section .form-control").on("change", function() {
			var homename = $(this).val();
			$.cookie("defType", homename, {path:'/'});
			setTimeout(function(){
				window.location.href = demo_var.homeURL+'/?home_page_alternative='+homename;
			}, 500);
		});

		$('.colorchange').click(function() {
			setDemoColor($(this).data('codecolor'));
		});
	});
})(jQuery);
