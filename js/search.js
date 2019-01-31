$(document).on('click', '.searchButton, .submenu a', function (e) {
    if ($(this).is('a')){
        removeAllActiveSubCategories();
        $(this).addClass('active');
    }
    e.preventDefault();
    performSearch('clean');
})

function performSearch(clean) {
    clean = clean || null;
    //IF PAGE IS SERVICE SEARCH
    if (window.location.href.indexOf('vyhladat') > 0) {
        var dataToSend = createFormData(clean);
        changeUrl(null,clean);
        sendSearchCriteria(dataToSend,'searchServices')
    }

    //IF PAGE IS MARKET SEARCH
    if (window.location.href.indexOf('bazar') > 0) {
        var dataToSend = createFormData(clean);
        changeUrl(findActiveSubCategory(), clean);
        dataToSend.append('category', findActiveSubCategory());
        sendSearchCriteria(dataToSend,'searchMarket')
    }

    //IF PAGE IS CALENDAR
    if (window.location.href.indexOf('kalendar') > 0) {
        getFiveEvents(showEvents);
    }
    
}

function createFormData(clean) {
    clean = clean || null;
    var filterData = new FormData();
    filterData.append('locationProvince', $('.locationProvince').val());
    filterData.append('locationRegion', $('.locationRegion').val());
    filterData.append('locationLocalCity', $('.locationLocalCity').val());
    filterData.append('distanceRange', $('.distanceRange').val());
    if (window.location.href.indexOf('vyhladat') > 0) {
        //only append if specific criteria values are not null
        if ($('.specificCriteria').val() != null){
            filterData.append('specificCriteriaValues', $('.specificCriteria').val());
            filterData.append('specificCriteriaName', $('.specificCriteria').attr('name'));
        }
        filterData.append('service', $('#serviceType').text());
    }
    if (findGetParameter('page') != undefined && clean != 'clean') {
        filterData.append('page', findGetParameter('page'));
    }
    return filterData;
}

function changeUrl(activeCategory, clean) {
    console.log(clean);
    
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
    if (findGetParameter('page') != undefined && clean != 'clean') {
      urlString += '&page=' + findGetParameter('page');
    }

    //if page is changed via pagination dont push to history = it will result into two same pages and user must click twice back to change view
    if (findGetParameter('page') == undefined) {
        window.history.pushState({
            "html": "",
            "pageTitle": "Výsledok"
        }, "", window.location.href.split("&search=true&")[0] + urlString);
    }
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

function fillFilterWithGetValues(){
    $('.locationProvince').val(findGetParameter('locationProvince'));
    $('.locationRegion').val(findGetParameter('locationRegion'));
    $('.locationLocalCity').val(findGetParameter('locationLocalCity'));
    $('.distanceRange').val(findGetParameter('distanceRange'));
    var specificCriteria = decodeURIComponent(findGetParameter('specificCriteria')).split(',');
    for (i = 0; i < specificCriteria.length; i++) {
        $(".specificCriteria option[value$='" + specificCriteria[i] + "']").attr('selected', 'selected');
    }
    $('.specificCriteria').multiselect('reload');

}