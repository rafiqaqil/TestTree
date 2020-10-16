/*
* @license
* (c) 2011-2020 Corporate Web Solutions Ltd. This software may be used to support and facilitate your
* development utilizing JSCharting if you hold a valid license for JSCharting.  This software may not
* be used or integrated for any task independent of its JSCharting support role.
* Please see https://jscharting.com/store/ for JSCharting licensing options.
*
* */
/*
* @license
* (c) 2011-2020 Corporate Web Solutions Ltd. This software may be used to support and facilitate your
* development utilizing JSCharting if you hold a valid license for JSCharting.  This software may not
* be used or integrated for any task independent of its JSCharting support role.
* Please see https://jscharting.com/store/ for JSCharting licensing options.
*
* */
$(document).ready(function(){"undefined"!==typeof bundleMessage?"undefined"!==typeof JSC?bundleMessage.getMessage(JSC.getVersion()):$("#bundleMsg").html("/jsc/jscharting.js is not found. Please double check your installation or contact support for assistance."):"undefined"!==typeof JSC?$("#bundleMsg").html("JSCharting (v"+JSC.getVersion()+")"):$("#bundleMsg").html("/jsc/jscharting.js is not found. Please double check your installation or contact support for assistance.");"file:"!==window.location.protocol&&
$(".warning").hide()});
 $(document).ready(function () {
	$.ajax({
		url : "license.txt",
		dataType: "text",
		success : function (data) {
			if(data != ''){
				makeLicenseNotice(data);
				var isEndOfAgreement = true;
				var div = $('#license-text');
				$(div).on('scroll', function(){
					if ($(div)[0].scrollHeight - $(div)[0].scrollTop == $(div)[0].clientHeight) {
						if(isEndOfAgreement){
							$('#btns div').css({
								'display':'inline-block'
							})
							$('#btns p').css({
								'display':'none'
							})
							isEndOfAgreement = false
						}
					}
				});
			}
		}
	});
});

function makeLicenseNotice(data){
	var width1 = window.matchMedia("(max-height: 700px)");
	var cookieName = 'JSC_notice_'+JSC.getVersion();
	function WidthChange(){
		if (width1.matches){
			$("#license-text").css({'height':'300px'})
		} else{
			$("#license-text").css({'height':'400px'})
		}
	}
	if(!$.cookie(cookieName)){
		$('<div id="notice-background">' +
			'<div id="license-notice">'+
				'<h2>JSCharting Licensing Agreement</h2>' +
				'<textarea id="license-text" readonly></textarea>' +
				'<div id="btns">' +
					'<div id="decline-btn">Decline</div>' +
					'<div id="accept-btn">Accept</div>' +
					'<p>Please read to the end of the agreement to Accept or Decline</p>' +
				'</div>' +
			'</div>' +
		'</div>').appendTo('#wrapper');
		$('#notice-background').css({
			'width':'100%',
			'height':'100%',
			'position': 'fixed',
			'z-index':'1001',
			'overflow':'auto',
			'background-color':'rgba(0,0,0,0.7)',
			'top': '0',
			'left': '0',
		});
		$('#license-notice').css({
			'background-color':'white',
			'color':'black',
			'border-radius':'10px',
			'width':'600px',
			'z-index':'1002',
			'position':'fixed',
			'top': '50%',
			'left': '50%',
			'margin': '-300px 0 0 -320px',
			'padding':'20px',
			'font-size':'14px'
		});
		$('#license-notice h2').css({
			'text-align':'center',
			'margin-top':'10px'
		});
		$('#btns').css({
			'text-align':'center'
		})
		$('#btns div').css({
			'display':'none',
			'padding':'10px',
			'margin-top':'8px',
			'padding':'8px 14px',
			'cursor':'pointer',
			'font-weight':'bold',
		})
		$('#btns p').css({
			'color':'gray',
			'margin-bottom':'10px'
		})
		$('#accept-btn').css({
			'color':'white',
			'background-color':'#038bbf',
			'text-align':'center',
		})
		$("#license-text").css({
			'width':'100%',
			'height':'300px',
			'resize': 'none',
			'border':'none'
		})
		
		$("#license-text").html(data);
		WidthChange();
		width1.addListener(WidthChange);
		$("#decline-btn").click(function() {
			$('#decline-btn').css({
				'display':'none'
			})
			$('#btns p').css({
				'display':'block',
				'font-size':'14px'
			})
			$("#btns p").html('JSCharting may not be used without accepting the license terms, please contact <a href="mailto:orders@JSCharting.com">orders@JSCharting.com</a> for assistance.')
		});
		$("#accept-btn").click(function() {
			$("#notice-background").fadeOut(200)
			$.cookie(cookieName,'true', {expires: 365, path: '/'})
		});
	}
}

/*!
 * jQuery Cookie Plugin v1.3.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as anonymous module.
        define(['jquery'], factory);
    } else {
        // Browser globals.
        factory(jQuery);
    }
}
(function ($) {

    var pluses = /\+/g;

    function raw(s) {
        return s;
    }

    function decoded(s) {
        return decodeURIComponent(s.replace(pluses, ' '));
    }

    function converted(s) {
        if (s.indexOf('"') === 0) {
            // This is a quoted cookie as according to RFC2068, unescape
            s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
        }
        try {
            return config.json ? JSON.parse(s) : s;
        } catch(er) {}
    }

    var config = $.cookie = function (key, value, options) {

        // write
        if (value !== undefined) {
            options = $.extend({}, config.defaults, options);

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = config.json ? JSON.stringify(value) : String(value);

            return (document.cookie = [
                config.raw ? key : encodeURIComponent(key),
                '=',
                config.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path    ? '; path=' + options.path : '',
                options.domain  ? '; domain=' + options.domain : '',
                options.secure  ? '; secure' : ''
            ].join(''));
        }

        // read
        var decode = config.raw ? raw : decoded;
        var cookies = document.cookie.split('; ');
        var result = key ? undefined : {};
        for (var i = 0, l = cookies.length; i < l; i++) {
            var parts = cookies[i].split('=');
            var name = decode(parts.shift());
            var cookie = decode(parts.join('='));

            if (key && key === name) {
                result = converted(cookie);
                break;
            }

            if (!key) {
                result[name] = converted(cookie);
            }
        }

        return result;
    };

    config.defaults = {};

    $.removeCookie = function (key, options) {
        if ($.cookie(key) !== undefined) {
            // Must not alter options, thus extending a fresh object...
            $.cookie(key, '', $.extend({}, options, { expires: -1 }));
            return true;
        }
        return false;
    };

}));
