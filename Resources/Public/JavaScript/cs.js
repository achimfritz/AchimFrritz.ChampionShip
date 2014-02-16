(function ($) {
	$(function () {
		$('.datetimepicker').datetimepicker({
			timeformat: 'H:i',
			dateFormat: 'dd.mm.yy',
			stepMinute: 5
		});

		$('div.cs-col').equalHeight();

		$('ul.nav li a').on('shown', function() {
			//$('div.cs-col').equalHeight();
		});

		// delete action
		$('span.deleteAction').bind('click', function() {
			var form = $(this).next('form.deleteAction');
			$('input.btn', form).trigger('click');
		});
				//form.trigger('submit');
				//ev.preventDefault();

		var oTable = $('.dataTable').dataTable({
          "bJQueryUI": true,
          "aLengthMenu": [ 20, 50, 200 ],
          'aaSorting': [ [0, 'asc'] ],
          'iDisplayLength': 20
          //'sDom': 'lfrtip'
     });
	});
}(jQuery));

