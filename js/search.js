$(document).on('click', '.searchButton, .submenu a', function (e) {
    if ($(this).is('a')){
        removeAllActiveSubCategories();
        $(this).addClass('active');
    }
    e.preventDefault();
    performSearch();
})

function performSearch() {
    //IF PAGE IS SERVICE SEARCH
    if (window.location.href.indexOf('vyhladat') > 0) {
        var dataToSend = createFormData();
        changeUrl();
        sendSearchCriteria(dataToSend,'searchServices')
    }

    //IF PAGE IS MARKET SEARCH
    if (window.location.href.indexOf('bazar') > 0) {
        var dataToSend = createFormData();
        changeUrl(findActiveSubCategory());
        dataToSend.append('category', findActiveSubCategory());
        sendSearchCriteria(dataToSend,'searchMarket')
    }
    
}

function createFormData() {
    var filterData = new FormData();
    filterData.append('locationProvince', $('.locationProvince').val());
    filterData.append('locationRegion', $('.locationRegion').val());
    filterData.append('locationLocalCity', $('.locationLocalCity').val());
    filterData.append('distanceRange', $('.distanceRange').val());
    if (window.location.href.indexOf('vyhladat') > 0) {
        filterData.append('specificCriteria', $('.specificCriteria').val());
        filterData.append('service', $('#serviceType').text());
    }
    return filterData;
}

function changeUrl(activeCategory) {
    activeCategory = activeCategory || null;
    var urlString = "&search=true";
    urlString += "&locationProvince=" + $('.locationProvince').val();
    urlString += "&locationRegion=" + $('.locationRegion').val();
    urlString += "&locationLocalCity=" + $('.locationLocalCity').val();
    urlString += "&distanceRange=" + $('.distanceRange').val();
    if (window.location.href.indexOf('vyhladat') > 0) {
        urlString += "&specificCriteria=" + $('.specificCriteria').val();
    }
    if (activeCategory){
        urlString += "&activeCategory=" + activeCategory;
    }
    urlString = hasUrlQuestionMark() ? urlString : '?' + urlString;
    window.history.pushState({
        "html": "",
        "pageTitle": "Výsledok"
    }, "", window.location.href.split("&search=true&")[0] + urlString);
}

function hasUrlQuestionMark(){
    return window.location.href.indexOf('?') > 0;
}

function removeAllActiveSubCategories() {
    $('.navigation').find('.submenu').each(function() {
        $(this).find('a').each(function () {
            $(this).removeClass('active');
        });
    })
}

function findActiveSubCategory() {
    return $('.navigation').find('.active').html();
}


function sendSearchCriteria(formData, apiLink) {
    console.log(formData);
    console.log(apiLink);
    
    $('.loading').show(); 
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/' + apiLink,
        data: formData,
        xhrFields: {
        withCredentials: true
        },
        success: function (data) {
            var result = isJson(data) ? jQuery.parseJSON(data) : data;
            //run function by name in variable
            console.log(result);
            $('.loading').hide();
        },
        error: function (data) {
            $('.loading').hide();
            warningAnimation('Bohužial nastala chyba na našej strane, obnovte stránku a skúste to znovu. ' + data.responseText);
        }
    });
}