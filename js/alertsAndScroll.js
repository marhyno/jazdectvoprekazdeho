$(document).ready(function () {
    // Add smooth scrolling to all links
    $(".scroll").on('click', function (event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function () {

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        } // End if
    });

    $(document).on('click', '.loading',function () {
        $(this).hide();
    })

});

$(window).bind('beforeunload', function () {
    $('.loading').show();
    setTimeout(function() {
        $('.loading').hide();
    }, 20000);
});

function confirmationAnimation(comment) {
    setTimeout(function () {
        $('#confirmationMessage').show(); //at reload page, its display:none;
        $('#confirmationMessage').removeClass('alert-danger');
        $('#confirmationMessage').addClass('alert-success');
        $('#confirmation-header').html('ÚSPECH!');
        $('#confirmation-text').html(' ' + comment);
        $('#confirmationMessage').toggleClass('in');
    }, 50);
    var myVar = setTimeout(function () {
        $('#confirmationMessage').removeClass('in');
        $('#confirmationMessage').toggleClass('out');
        $('#confirmationMessage').removeClass('out');
    }, 5000);
}

function warningAnimation(comment) {
    setTimeout(function () {
        $('#confirmationMessage').show(); //at reload page, its display:none;
        $('#confirmationMessage').removeClass('alert-success');
        $('#confirmationMessage').addClass('alert-danger');
        $('#confirmation-header').html('CHYBA!');
        $('#confirmation-text').html(' ' + comment);
        $('#confirmationMessage').toggleClass('in');
    }, 50);
    var myVar = setTimeout(function () {
        $('#confirmationMessage').removeClass('in');
        $('#confirmationMessage').toggleClass('out');
        $('#confirmationMessage').removeClass('out');
    }, 5000);
}

$(document).ready(function () {
	$('#hideMessage').on("click", function () {
		var myVar = setTimeout(function () {
				$('#confirmationMessage').removeClass('in');
				$('#confirmationMessage').toggleClass('out');
				$('#confirmationMessage').removeClass('out');
			}, 50);
	});
});