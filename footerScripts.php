<script src="/js/vendor/jquery-2.2.4.min.js"></script>
<script src="/js/vendor/bootstrap.min.js"></script>			
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
<script src="/js/easing.min.js"></script>			
<script src="/js/hoverIntent.js"></script>
<script src="/js/superfish.min.js"></script>	
<script src="/js/jquery.ajaxchimp.min.js"></script>
<script src="/js/jquery.magnific-popup.min.js"></script>	
<script src="/js/owl.carousel.min.js"></script>			
<script src="/js/jquery.sticky.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>				
<script src="/js/jquery.nice-select.min.js"></script>			
<script src="/js/parallax.min.js"></script>	
<script src="/js/waypoints.min.js"></script>
<script src="/js/jquery.counterup.min.js"></script>			
<script src="/js/mail-script.js"></script>	
<script src="/js/main.js"></script>	
<script src="/js/callBackend.js?100"></script>
<script src="/js/alertsAndScroll.js"></script>
<script src="/js/pdfobject.min.js"></script>
<script src="/js/onlineTestSZVJ.js"></script>
<link rel="stylesheet" href="/js/multipleSelect/jquery.multiselect.css">
<script src="/js/multipleSelect/jquery.multiselect.js"></script>

<script>
if ($('#pdfViewer').length > 0) {
    PDFObject.embed("/assets/szvj.pdf", "#pdfViewer");
}
</script>
<script>
$('.showHideSubMenu').on('click',function () {  
    var subMenu = $(this).next('.submenu');
    if ($(subMenu).is(':visible')){
        $(this).find('i').removeClass('up').addClass('down');
        $(subMenu).hide('50');
    }else{
        $(subMenu).slideDown( "slow" );
        $(this).find('i').removeClass('down').addClass('up');
    }
})

$(document).ready(function(){
    $('.multiselect').multiselect({
        columns: 1,     // how many columns should be use to show options
        search : true, // include option search box

        // search filter options
        searchOptions : {
            delay        : 100,                  // time (in ms) between keystrokes until search happens
            searchText   : true,                 // search within the text
        },
    
        // plugin texts
        texts: {
            placeholder    : 'Vyberte si z možností', // text to use in dummy input
            search         : 'Hľadať',         // search input placeholder text
            selectedOptions: ' možnosti vybraté',      // selected suffix text
            selectAll      : 'Vybrať všetky',     // select all text
            unselectAll    : 'Zrušiť všetky',   // unselect all text
            noneSelected   : 'Žiadne vybraté'   // None selected text
        },
    
        // general options
        selectAll          : true, // add select all option
        minHeight          : 200,   // minimum height of option overlay
        maxHeight          : null,  // maximum height of option overlay
        maxWidth           : null,  // maximum width of option overlay (or selector)
        maxPlaceholderWidth: null, // maximum width of placeholder button
        maxPlaceholderOpts : 10, // maximum number of placeholder options to show until "# selected" shown instead
        showCheckbox       : true,  // display the checkbox to the user
        optionAttributes   : [],  // attributes to copy to the checkbox from the option element

    });

    $('#ms-list-1').css('display','inline-block').css('width','250px');

})
</script>