$(document).ready(function() { 	

	$("#masterCh").click(function() {
		var checkedStatus = $(this).find('span').hasClass('checked');
				
		$("#checkAll tr .chChildren input:checkbox").each(function() {
			this.checked = checkedStatus;
				if (checkedStatus == this.checked) {
					$(this).closest('.checker > span').removeClass('checked');
				}
				if (this.checked) {
					$(this).closest('.checker > span').addClass('checked');
				}
		});
	});
		
});