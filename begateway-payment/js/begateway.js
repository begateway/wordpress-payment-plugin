jQuery3_2_1(document).ready(function($){
  jQuery3_2_1(".bp_form form").submit(function(event) {
    event.preventDefault();

    dhis = jQuery3_2_1(this);
    var formData = dhis.serialize();

    dhis.find('.bp_loader').show();

		jQuery3_2_1.ajax({
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
				    dhis.find('.bp_loader').hide();
            dhis.find('.bp_result').html(data.message).show();
				}
			}
		});
	});
});
