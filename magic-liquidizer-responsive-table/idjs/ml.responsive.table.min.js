/*
* Plugin Name: Magic Liquidizer Responsive Table
* Plugin URI: http://www.innovedesigns.com/wordpress/magic-liquidizer-responsive-table-rwd-you-must-have-wp-plugin/
* Author: Elvin Deza
* Description: A simple and lightweight plugin that converts HTML table into responsive. After activation, go to Dashboard > Magic Liquidizer Lite > Table.
* Version: 1.0.5
* Tags: responsive, fluid
* Author URI: http://innovedesigns.com/author/esstat17
*/

(function(a){a.fn.responsiveTable=function(b){var c=a.extend({headerSelector:"thead td, thead th, tr th",bodyRowSelector:"tbody tr",responsiveRowElement:"<dl></dl>",responsiveColumnTitleElement:"<dt></dt>",responsiveColumnValueElement:"<dd></dd>",enable:true},b);return this.each(function(f,h){var g=a(this);var d=a('<div class="ml-responsive-table ml-responsive-table-'+f+'" />');var i=new Array();g.find(c.headerSelector).each(function(j,k){var l=a(this).html();i[j]=l});g.find(c.bodyRowSelector).each(function(j,k){var l=a(c.responsiveRowElement);l.addClass("ml-grid ml-clearfix ml-row-"+j);a(this).children("td").each(function(n,m){var o=a(c.responsiveColumnTitleElement);o.addClass("ml-title col-"+n+" ml-table");o.html(i[n]);var e=a(c.responsiveColumnValueElement);e.addClass("ml-value col-"+n+" ml-table");e.html(a(this).html());if(a.trim(a(this).html())==""){e.addClass("empty");o.addClass("empty")}l.append(o).append(e)});d.append(l)});if(c.enable){g.after(d);g.hide()}else{a(".ml-responsive-table").detach();g.show()}})}})(jQuery);(function(a){a.fn.MagicLiquidizerTable=function(b){var c=a.extend({table:"1",breakpoint:"720",whichelement:"table"},b);return this.each(function(){function d(){var e=a(window).width();if(e<c.breakpoint){a("html").addClass("rwd-table");if(c.table=="1"&&!a(".ml-responsive-table").length>0){a(c.whichelement).responsiveTable({enable:true})}}else{a("html").removeClass("rwd-table");if(c.table=="1"){a(c.whichelement).responsiveTable({enable:false})}}}a(window).resize(d).ready(d)})}}(jQuery));