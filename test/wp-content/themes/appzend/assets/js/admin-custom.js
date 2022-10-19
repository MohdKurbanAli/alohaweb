jQuery(function($){
 
	// on upload button click
	$('body').on( 'click', '.meta-upload-image-btn', function(e){
 
		e.preventDefault();
 
		var button = $(this),
		custom_uploader = wp.media({
			title: 'Insert image',
			library : {
				// uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
				type : 'image'
			},
			button: {
				text: 'Use this image' // button label text
			},
			multiple: false
		}).on('select', function() { // it also has "open" and "close" events
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			var elem = button.parent('div.meta-image-wrapper').find('.meta-image');
			console.log( elem );
			if( elem.length == 0 ) {
				$('<div class="meta-image"><img src="'+attachment.url+'" width="100px" height="100px"></div>').insertBefore(button);
			}
			button.parent('div.meta-image-wrapper').find('.meta-image').children('img').attr('src', attachment.url);
            button.parent('div.meta-image-wrapper').find('.meta-upload-image').val(attachment.url).change();
		}).open();
 
	});
 
	// on remove button click
	$('body').on('click', '.meta-remove-image-btn', function(e){
 
		e.preventDefault();
 
		var button = $(this);
		button.parent('div.meta-image-wrapper').find('.meta-image').remove();
        button.parent('div.meta-image-wrapper').find('.meta-upload-image').val('').change();
		
	});

    // on remove button click
	$('body').on('click', '.overwrite_defaults', function(e){
 
		var button = $(this);
		if(button.prop("checked") == true) {
            $('.meta_attr_container').addClass('show');
        } else {
            $('.meta_attr_container').removeClass('show');
        }
	});

	if( $( '.overwrite_defaults' ).prop("checked") == true ) {
		$('.meta_attr_container').addClass('show');
	} else {
		$('.meta_attr_container').removeClass('show');
	}

	/* Call the Color Picker */
    $( ".color-picker" ).wpColorPicker();

	$('.meta-range').mousemove(function(){
		$(this).next('.meta-range-val').val($(this).val());
	});

 
});

function openTab(evt, tabName) {
	var i, x, tablinks;
	x = document.getElementsByClassName("tab_content");
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("tablink");
	for (i = 0; i < x.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" w3-red", ""); 
	}
	document.getElementById(tabName).style.display = "block";
	evt.currentTarget.className += " w3-red";
}