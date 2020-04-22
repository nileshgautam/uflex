$(function () {
    // setting userdata into the login form
    if (hasData("remember_me")) {
        var data = JSON.parse(localStorage.getItem("remember_me"));
        $('#inputEmail').val(data.username);
        $('#inputPassword').val(data.password);
        $('#remember_me').prop('checked', true);
    }

    //login function
    $('.login-from').submit(function (e) {
        e.preventDefault();

        console.log('hi');
        let form_data = $(this).serialize();
        let username = $('#inputEmail').val();
        let password = $('#inputPassword').val();
        // let message;
        $.ajax({
            type: 'POST',
            url: BASEURL + 'UserAuthenticationControl/auth',
            data: form_data,
            success: function (responce) {
                let data = JSON.parse(responce);
                // console.log(data.msg);
                if (data.msg == 'true') {
                    if (data.remember_me == 1) {
                        var arr = { "username": username, "password": password };
                        saveData("remember_me", arr);
                    }
                    else if (data.remember_me == 0) {
                        removeData('remember_me');
                    }
                }
                if (data.role == 'admin') {
                    window.location.href = BASEURL + 'admin';
                }
                else if (data.role == 'ind') {
                    window.location.href = BASEURL + 'india';
                }
                else if (data.role == 'ldn') {
                    window.location.href = BASEURL + 'london';
                }
                else if (data.role == 'manager') {
                    window.location.href = BASEURL + 'manager';
                }
                else {
                    showAlert(data.msg, data.type);
                }
            }
        });
    });
});

// Local storage function
function retriveData(FILE_KEY) {
    return localStorage.getItem(FILE_KEY);
}
function saveData(FILE_KEY, data) {
    localStorage.setItem(FILE_KEY, JSON.stringify(data));
}
function hasData(FILE_KEY) {
    return localStorage.hasOwnProperty(FILE_KEY) ? true : false;
    // localStorage 
}
function removeData(FILE_KEY) {
    localStorage.removeItem(FILE_KEY);
    // localStorage 
}
