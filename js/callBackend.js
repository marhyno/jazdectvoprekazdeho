$(document).on("click",".login100-form-btn",function(event) {
    event.preventDefault();
    event.stopPropagation();
    logIn();
});

function logIn() {
    $('.loading').show();
    var formData = new FormData();
    formData.append('email', $('#email').val());
    formData.append('password', $('#password').val());

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/user/login/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            localStorage.setItem("token", data);
            $('.loading').hide();
        },
        error: function (data) {
            $('.loading').hide();
            warningAnimation('An error occurred... Please reload the page and try again. Error: ' + data.responseText);
        }
    });
}

function updateUserData() {
    var data = {};
    data['username'] = 'stefan';
    var myJSON = JSON.stringify(data);
    $.ajax({
        processData: false,
        contentType: false,
        type: 'PUT',
        url: '/api/callBackend/user/',
        headers: {
            'token': '123465789',
            'data': myJSON,
        },
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            document.write(data);
            /*var result = isJson(data) ? jQuery.parseJSON(data) : data;
            //run function by name in variable
            console.log(result);
            window[callerFunction](result);
            $('#loading').hide();*/
        },
        error: function (data) {
            /*$('#loading').hide();
            warningAnimation('An error occurred... Please reload the page and try again. Error: ' + data.responseText);*/
        }
    });
}