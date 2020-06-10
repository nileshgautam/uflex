// Country, state, and city

$(function () {
    // select all the  country
    $("#country").change(function () {
        let sstate = $(this).attr('data-state');
        // let state = $(this).attr('data-state');
        let id = $(this).children("option:selected").attr('id');

        country_id = {
            c_id: id
        }
        $.ajax({
            type: "POST",
            url: baseUrl + "AdminControl/get_state",
            data: country_id,
            success: function (comp_responce) {
                obj = JSON.parse(comp_responce)
                if (obj) {
                    // console.log(obj)
                    let data = populate_option(obj, id, sstate);
                    // console.log(id);
                    $('#state').empty();
                    $('#state').append(data);
                    // company_responce = obj;
                    $("#state").change();
                }
            },
            error: function () {
                console.log("error loading data");
            }
        });
        // alert(id);
    });

    // select all the  state
    $("#state").change(function () {
        let s_city = $(this).attr('data-city');
        let id = $(this).children("option:selected").attr('id');
        // console.log(id);
        // console.log(s_city);

        state_id = {
            c_id: id
        }

        $.ajax({
            type: "POST",
            url: baseUrl + "AdminControl/get_cities",
            data: state_id,
            success: function (comp_responce) {
                obj = JSON.parse(comp_responce)
                if (obj) {
                    // console.log("object")
                    // console.log(obj)
                    let data = populate_cities(obj, id, s_city);
                    //  console.log(data);
                    $('#city').empty();
                    $('#city').append(data);
                    // company_responce = obj;
                }
            },
            error: function () {
                console.log("error loading data")
            }
        });
        // alert(id);
    });
    // for auto triger
    $("#country").change();
    $("#state").change();

    //  Function for populate states
    function populate_option(obj, id, ss) {

        // console.log(obj);

        let html = '';
        for (let i = 0; i < obj.length; i++) {
            if (ss != '') {
                html += `<option id="${id == obj[i]['id'] ? id : obj[i]['id']}" ${obj[i]['name'] == ss ? "selected" : ""}>${name == obj[i]['name'] ? name : obj[i]['name']}</option>`;
            } else {
                html += `<option id="${id == obj[i]['id'] ? id : obj[i]['id']}" ${obj[i]['name'] == "Haryana" ? "selected" : ""}>${name == obj[i]['name'] ? name : obj[i]['name']}</option>`;
            }
        }
        // $("#country").change();
        return html;
    }
    // Function to show list of all the city
    function populate_cities(obj, id, s_city) {

        let html = '';

        for (let i = 0; i < obj.length; i++) {
            if (s_city != '') {
                html += `<option id="${id == obj[i]['id'] ? id : obj[i]['id']}" ${obj[i]['name'] == s_city ? "selected" : ""}>${name == obj[i]['name'] ? name : obj[i]['name']}</option>`;

            } else {
                html += `<option id="${id == obj[i]['id'] ? id : obj[i]['id']}" ${obj[i]['name'] == 'Gurgaon' ? "selected" : ""}>${name == obj[i]['name'] ? name : obj[i]['name']}</option>`;
            }
        }
        return html;
    }
});

// Users form 

$(function () {
    let error = false;
    let emailPretext = $('#user-error-email').text();
    let mobilePretext = $('#user-error-mobile').text();

    $('#input-user-email').on('keyup change', function () {
        const EMAIL = $(this).val();
        const EMAILRESPONCE = validateEmail(EMAIL);
        if (EMAILRESPONCE == false) {
            $('#user-error-email').text('Enter valid email id, i.e. example@example.example.');
            $('#user-error-email').addClass('text-danger');
            error = true;
        }
        else if (EMAILRESPONCE == true) {
            $('#user-error-email').text(emailPretext);
            $('#user-error-email').removeClass('text-danger');
            error = false;
        }
    });

    $('#input-user-mobile').on('keyup change', function () {
        const MOBILENUMBER = $(this).val();
        const MOBILERESPONCE = validateMobileNumber(MOBILENUMBER);
        if (MOBILERESPONCE == false) {
            $('#user-error-mobile').text('Enter valid mobile number, i.e.: 999-999-9999, It should be 10 digits only.');
            $('#user-error-mobile').addClass('text-danger');
            error = true;
        }
        else if (MOBILERESPONCE == true) {
            $('#user-error-mobile').text(mobilePretext);
            $('#user-error-mobile').removeClass('text-danger');
            error = false;
        }
    });

    $('#cnf-password').on('keyup', function () {

        // alert('hi');
        let password = $('#password').val();
        let cnfpassword = $('#cnf-password').val();
        if (password != cnfpassword) {
            this.style.outline = '1px solid red';
            error = true;
            // showAlert('Error! Password not match...', 'danger');
        }
        if (password == cnfpassword) {
            this.style.outline = '';
            error = false;
            // showAlert('Error! Password not match...', 'danger');
        }
    });

    $('#user-form').submit(function (e) {
        e.preventDefault();
        let form_data = $(this).serialize();
        // console.log('hi');
        const USERID = $('#user-id').val();
        // console.log(clientId);
        if (USERID == '') {
            url = baseUrl + "AdminControl/user_post";
        } else {
            url = baseUrl + "AdminControl/user_edit_post";
        }
        if (error != true) {
            // console.log(error);
            $.ajax({
                type: 'POST',
                url: url,
                data: form_data,
                success: function (responce) {
                    // console.log(responce);
                    let data = JSON.parse(responce);
                    showAlert(data.message, data.type);
                    if (data.path != undefined)
                        setTimeout(() => {
                            window.location.href = baseUrl + data.path
                        }, 1000);

                }
            });
        }
        else {
            showAlert('Warning!  (*) field are required', 'warning');
            error = true;
        }

    });
    
});


