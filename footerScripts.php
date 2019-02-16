<script src="/js/popper.min.js"></script>				
<script src="/js/vendor/jquery-2.2.4.min.js"></script>
<script src="/js/vendor/bootstrap.min.js"></script>			
<!--<script type="text/javascript" src="/js/googleMapsAPI.js"></script>-->
<script src="/js/easing.min.js"></script>			
<script src="/js/hoverIntent.js"></script>
<script src="/js/superfish.min.js"></script>	
<script src="/js/jquery.magnific-popup.min.js"></script>	
<script src="/js/owl.carousel.min.js"></script>			
<script src="/js/jquery.sticky.js"></script>
<script src="/js/jquery-ui.min.js"></script>	
<script src="/js/jquery.nice-select.min.js"></script>			
<script src="/js/parallax.min.js"></script>	
<script src="/js/waypoints.min.js"></script>
<script src="/js/jquery.counterup.min.js"></script>	
<script src="/js/callBackend.js?<?php echo rand(0,898984984); ?>"></script>
<script src="/js/alertsAndScroll.js"></script>
<script src="/js/pdfobject.min.js"></script>
<script src="/js/onlineTestSZVJ.js"></script>
<link rel="stylesheet" href="/js/multipleSelect/jquery.multiselect.css">
<script src="/js/multipleSelect/jquery.multiselect.js"></script>
<script src="/js/main.js?02"></script>	
<script src="/js/jssor.slider-27.5.0.min.js" type="text/javascript"></script>
<script src="/js/imageGallerySlider.js" type="text/javascript"></script>
<script src="/js/view.js?<?php echo rand(0,898984984); ?>"></script>
<script src="/js/search.js?<?php echo rand(0,898984984); ?>"></script>
<script src="/js/tinymce/tinymce.min.js"></script>
<script src="/js/jquery.dataTable.js"></script>	
<script src="/js/jquery.dataTables.button.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript" src="/js/timepicker.js"></script>  

<!-- required snowstorm JS, default behaviour -->
<script src="/js/snowstorm-min.js"></script>

<!-- now, we'll customize the snowStorm object -->
<script>
snowStorm.snowColor = '#fff';   // blue-ish snow!?
snowStorm.flakesMaxActive = 0;    // show more snow on screen at once
snowStorm.useTwinkleEffect = false; // let the snow flicker in and out of view
snowStorm.excludeMobile = true;
</script>
<script type='text/javascript' data-cfasync='false'> 
    window.purechatApi = {
        l: [],
        t: [],
        on: function () {
            this.l.push(arguments);
        }
    };
    (function () {
        var done = false;
        var script = document.createElement('script');
        script.async = true;
        script.type = 'text/javascript';
        script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript';
        document.getElementsByTagName('HEAD').item(0).appendChild(script);
        script.onreadystatechange = script.onload = function (e) {
            if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
                var w = new PCWidget({
                    c: 'c5c4daca-3c75-4742-a780-7a6792fe7394',
                    f: true
                });
                done = true;
            }
        };
    })(); 
</script>