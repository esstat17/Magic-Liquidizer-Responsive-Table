/*
* Plugin Name: Magic Liquidizer Responsive Table
* Plugin URI: http://www.innovedesigns.com/wordpress/magic-liquidizer-responsive-table-rwd-you-must-have-wp-plugin/
* Author: Elvin Deza
* Description: A simple and lightweight plugin that converts HTML table into responsive. After activation, go to Dashboard > Magic Liquidizer Lite > Table.
* Version: 1.0.5
* Tags: responsive, fluid
* Author URI: http://innovedesigns.com/author/esstat17
*/

(function($) {

  $.fn.responsiveTable = function(options) {
    var settings = $.extend({
      
      // Selectors
      /**
       * The header columns selector.
       * Default: 'thead td, thead th';
       * other examples: 'tr th', ...
       */
      headerSelector : 'thead td, thead th, tr th',
      /**
       * The body rows selector.
       * Default: 'tbody tr';
       * Other examples: 'tr', ...
       */
      bodyRowSelector : 'tbody tr',
      
      // Elements
      /**
       * The responsive rows container
       * element. 
       * Default: '<dl></dl>';
       * Other examples: '<ul></ul>'.
       */
      responsiveRowElement : '<dl></dl>',
      /**
       * The responsive column title
       * container element.
       * Default: '<dt></dt>'; 
       * Other examples: '<li></li>'.
       */
      responsiveColumnTitleElement : '<dt></dt>',
      /**
       * The responsive column value container element. 
       * Default: '<dd></dd>'; 
       * Other examples: '<li></li>'.
       */
      responsiveColumnValueElement : '<dd></dd>',
      
      // Disable it.
      enable : true
      
    }, options);
	
    return this.each(function(j, e) {
      // $this = The table (each).
      var $this = $(this);

      // Ensure that the element this is being executed on a table!
    
      // General
      var result = $('<div class="ml-responsive-table ml-responsive-table-'+j+'" />');
      
      // Head
      // Iterate head - extract titles
      var titles = new Array();
      $this.find(settings.headerSelector).each(function(i, e) {
        var title = $(this).html();
        titles[i] = title;
      });

      // Body
      // Iterate body
      $this.find(settings.bodyRowSelector).each(function(i, e) {
        // Row
        var row = $(settings.responsiveRowElement);
        row.addClass('ml-grid ml-clearfix ml-row-' + i);
        
        // Column
        $(this).children('td').each(function(ii, ee) {
          var dt = $(settings.responsiveColumnTitleElement);
          
          dt.addClass('ml-title col-' + ii + ' ml-table');
          dt.html(titles[ii]);
          var dd = $(settings.responsiveColumnValueElement);
          
          dd.addClass('ml-value col-' + ii + ' ml-table');
          dd.html($(this).html());
          // Set empty class if value is empty.
          if ($.trim($(this).html()) == '') {
            dd.addClass('empty');
            dt.addClass('empty');
          }
          row.append(dt).append(dd);
        });
        
         result.append(row);
        
      });
				
    
      if(settings.enable){
      
      	 // Display responsive version after table.
     	 $this.after(result);
      
        // Hide table. We might need it again!
      	 $this.hide();
      	 
      } else {
      	
      	$(".ml-responsive-table").detach();
      	
        // Show table 
		$this.show();
      }

       
     
    });
  };

 
})(jQuery); 

(function($){
	$.fn.MagicLiquidizerTable = function(options){
   					var settings = $.extend({
            			table: '1',
            			breakpoint: '720',
            			whichelement: 'table',
        				}, options );       				
	return this.each(function() {
		
		function responsiveTableFn() {
   					 
			var viewwidth = $( window ).width();
    	/** Media screens **/
    		if (viewwidth < settings.breakpoint) {	// Tablet and Smartphone Screens 
    			$('html').addClass('rwd-table'); 		
    			if(settings.table=='1' && !$('.ml-responsive-table').length > 0){ $(settings.whichelement).responsiveTable({ enable:true }); }				
    		} else {
    			$('html').removeClass('rwd-table');
    		    if(settings.table=='1'){ $(settings.whichelement).responsiveTable({ enable: false }) }    		    
    		}
  		} // responsiveTableFn() ends
  		$(window).resize(responsiveTableFn).ready(responsiveTableFn);
	});  // each fn ends
	};  // MagicLiquidizer fn
   
}( jQuery ));