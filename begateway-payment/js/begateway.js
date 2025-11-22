jQuery(document).ready(function($){
  jQuery(".bp_form form").submit(function(event) {
    event.preventDefault();

    var self = $(this);
    var formData = self.serialize();

    self.find('.bp_loader').show();

		$.ajax({
			url: bgt.url,
			type: 'POST',
			dataType: 'json',
            data: formData + '&action=bp_show&nonce='+bgt.nonce,
			success: function(data){
				if(data.status) {
                    if (window.location != window.parent.location) {
                        window.parent.location = data.gourl;
                    } else {
					    window.location.href = data.gourl;
                    }
				} else {
				    self.find('.bp_loader').hide();
                    self.find('.bp_result').html(data.message).show();
				}
			}
		});
	});
});
