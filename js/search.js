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
        changeUrl(null, clean);
        var dataToSend = createFormData(clean);
        sendSearchCriteria(dataToSend,'searchServices')
    }

    //IF PAGE IS MARKET SEARCH
    if (window.location.href.indexOf('bazar') > 0) {
        changeUrl(findActiveSubCategory(), clean);
        var dataToSend = createFormData(clean);
        sendSearchCriteria(dataToSend,'searchMarket')
    }

    //IF PAGE IS CALENDAR
    if (window.location.href.indexOf('kalendar') > 0) {
        changeUrl(null, clean);
        var dataToSend = createFormData(clean);
        getFiveEvents(dataToSend,showEvents);
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
    if (window.location.href.indexOf('kalendar') > 0) {
        filterData.append('eventFrom',$('.eventFrom').val());
        filterData.append('eventTo',$('.eventTo').val());
        filterData.append('specificCriteria', $('.eventType').val());
    }

    if (window.location.href.indexOf('bazar') > 0) {
        filterData.append('specificCriteria', $('.specificCriteria').val());
        filterData.append('subCategory', findActiveSubCategory().html());
        filterData.append('mainCategory', findMainCategoryFromSub(findActiveSubCategory()));
    }

    var pageNumber = clean != 'clean' ? findGetParameter('page') : 0;
    filterData.append('page', pageNumber);
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
    if (window.location.href.indexOf('vyhladat') > 0 || window.location.href.indexOf('bazar') > 0) {
        urlString += "&specificCriteria=" + $('.specificCriteria').val();
    }
    if (window.location.href.indexOf('kalendar') > 0) {
        urlString += "&eventFrom=" + $('.eventFrom').val();
        urlString += "&eventTo=" + $('.eventTo').val();
        urlString += "&specificCriteria=" + $('.eventType').val();
    }
    if (activeCategory){
        console.log(findMainCategoryFromSub(activeCategory));
        
        urlString += "&mainCategory=" + findMainCategoryFromSub(activeCategory);
        urlString += "&subCategory=" + activeCategory.html();
    }
    urlString = hasUrlQuestionMark() ? urlString : '?' + urlString;
    if (clean == 'clean') {
    } else if (findGetParameter('page') != null) {
        urlString += '&page=' + findGetParameter('page');
    }

    //if page is changed via pagination dont push to history = it will result into two same pages and user must click twice back to change view
    if (findGetParameter('page') == undefined || clean == 'clean') {
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
    return $('.navigation').find('.active');
}

function findMainCategoryFromSub(subCategory) {
    return subCategory.parent().parent().parent().find('a').eq(0).text();
}

function fillFilterWithGetValues(){
    $('.locationProvince').val(decodeURIComponent(findGetParameter('locationProvince')));
    $('.locationRegion').val(decodeURIComponent(findGetParameter('locationRegion')));
    $('.locationLocalCity').val(decodeURIComponent(findGetParameter('locationLocalCity')));
    $('.distanceRange').val(findGetParameter('distanceRange'));
    fillLocationSelects(updateFields = true)
    if (window.location.href.indexOf('kalendar') > 0) {
        $('.eventFrom').val(findGetParameter('eventFrom'));
        $('.eventTo').val(findGetParameter('eventTo'));
    }

    var specificCriteria = decodeURIComponent(findGetParameter('specificCriteria')).split(',');
    for (i = 0; i < specificCriteria.length; i++) {
        $(".specificCriteria option[value$='" + specificCriteria[i] + "']").attr('selected', 'selected');
    }
    $('.specificCriteria').multiselect('reload');
    $(".showHideSubMenu[data-mainMenu='" + decodeURIComponent(findGetParameter('mainCategory')) + "']").click();
    $(".showHideSubMenu[data-mainMenu='" + decodeURIComponent(findGetParameter('mainCategory')) + "']").next("ul").find("a[data-subMenu='" + decodeURIComponent(findGetParameter('subCategory')) + "']").addClass('active');
}