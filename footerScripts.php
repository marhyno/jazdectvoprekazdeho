<script src="/js/vendor/jquery-2.2.4.min.js"></script>
<script src="/js/vendor/bootstrap.min.js"></script>			
<!--<script type="text/javascript" src="/js/googleMapsAPI.js"></script>-->
<script src="/js/easing.min.js"></script>			
<script src="/js/hoverIntent.js"></script>
<script src="/js/superfish.min.js"></script>	
<script src="/js/jquery.magnific-popup.min.js"></script>	
<script src="/js/owl.carousel.min.js"></script>			
<script src="/js/jquery.sticky.js"></script>
<script src="/js/jquery-ui.js"></script>				
<script src="/js/jquery.nice-select.min.js"></script>			
<script src="/js/parallax.min.js"></script>	
<script src="/js/waypoints.min.js"></script>
<script src="/js/jquery.counterup.min.js"></script>	
<script src="/js/callBackend.js?100"></script>
<script src="/js/alertsAndScroll.js"></script>
<script src="/js/pdfobject.min.js"></script>
<script src="/js/onlineTestSZVJ.js"></script>
<link rel="stylesheet" href="/js/multipleSelect/jquery.multiselect.css">
<script src="/js/multipleSelect/jquery.multiselect.js"></script>
<script src="/js/main.js"></script>	
<script src="/js/jssor.slider-27.5.0.min.js" type="text/javascript"></script>
<script src="/js/imageGallerySlider.js" type="text/javascript"></script>
<script src="/js/view.js?<?php echo rand(0,898984984); ?>"></script>
<script src="/js/search.js?<?php echo rand(0,898984984); ?>"></script>
<script src="/js/tinymce/tinymce.min.js"></script>
<script src="/js/jquery.dataTable.js"></script>	
<script src="/js/jquery.dataTables.button.js"></script>	

<!-- required snowstorm JS, default behaviour -->
<script src="/js/snowstorm-min.js"></script>
<script>
    tinymce.init({ 
        selector:'#body',
        language: 'sk',
        resize: 'both',
        theme: 'modern',
        plugins: 'print preview fullpage searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template table charmap hr pagebreak nonbreaking anchor insertdatetime lists textcolor wordcount imagetools contextmenu colorpicker textpattern paste youtube',
        toolbar1: 'formatselect | undo redo | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat youtube',
        paste_data_images: true,
        media_live_embeds: true,
        min_height: 400,
        extended_valid_elements: "+iframe[src|width|height|name|align|class]",
    });
</script>

<!-- now, we'll customize the snowStorm object -->
<script>
snowStorm.snowColor = '#fff';   // blue-ish snow!?
snowStorm.flakesMaxActive = 10;    // show more snow on screen at once
snowStorm.useTwinkleEffect = false; // let the snow flicker in and out of view
snowStorm.excludeMobile = false;
</script>