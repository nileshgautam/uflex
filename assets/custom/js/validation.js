// Global varialble pattern
var alphaPattern = /^[a-zA-Z]+$/;
var stringPattern = /^[a-zA-Z0-9.-_&:\s]+$/;
var alphaNumericPattern = /^[a-zA-Z0-9\s]+$/;
var namePattern = /^[a-zA-Z.-\s]+$/;
var ifscPattern = /[a-zA-Z]{4}\d{7}/;
var numericPattern = /^[0-9]+$/;
var mobilePattern = /^[0-9]{10}$/;
var specialCharPattern = /^[a-zA-Z.-_:\s]+$/;
var pincodePattern = /^[0-9]{6}$/;
var datePattern = /^([0-2][0-9]|[3][0-1])\/|-([0-9][1-2])\/|-((19|20)[0-9]{2})$/;
var timePattern = /^[0-9:.-\s]+$/;
var websitePattern = /^https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)$/;
const EMAILPATTERN = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

// const EMAILPATTERN=/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;

// function to validate mobile number should be 10 digit only.
const validateMobileNumber = (mobilenumber) => {
    // var phoneno = /^\d{10}$/;
    const MOBILENUMBER = /^[0-9]{10}$/;
    if (mobilenumber.match(MOBILENUMBER)) {
        return true;
    }
    else {
        return false;
    }
}

// function to validate email.
const validateEmail=(email)=>{
    if (email.match(EMAILPATTERN)) {
        return true;
    }
    else {
        return false;
    }

}

// function to validate GST number
const gstNumberValidate = (gstNo) => {
   
    var gstin = gstNo;
    var stateCode = gstin.substring(0, 2);
    var str1 = gstin.substring(2, 7);
    var str2 = gstin.substring(7, 11);
    var str3 = gstin.substring(11, 12);

    if ($.trim(gstin) != "" && gstin.length != 15) {
        error = "Please enter 15 digit GSTIN";
        return error;
    }

    else if ($.trim(gstin) != "" && !str1.match(alphaPattern)) {
        error = "Please enter valid GSTIN";
        return error;
    }
    else if ($.trim(gstin) != "" && !str2.match(numericPattern)) {
        error = "Please enter valid GSTIN";
        return error;
    }
    else if ($.trim(gstin) != "" && !str3.match(alphaPattern)) {
        error = "Please enter valid GSTIN";
        return error;
    }
    
    // else if ($.trim(gstin) == "" && state.val() == "") {
    //     // alert(state.val());
    //     error = "Invalid state code";
    //     // state.focus();
    //     return error;
    // }
    // else if ($.trim(gstin) != "" && state.val() != parseInt(stateCode)) {
    //     error = "GSTIN does not match state";
    //     // state.focus();
    //     return error;
    // }

}

// date validate function
function ValidateDate() {
    var start = $('#start-date').val();
    var end = $('#end-date').val();
    var startDay = new Date(start);
    var endDay = new Date(end);
    var millisecondsPerDay = 1000 * 60 * 60 * 24;
    var millisBetween = endDay.getTime() - startDay.getTime();
    var days = millisBetween / millisecondsPerDay;
    // Round down.
    days = Math.floor(days);
    if (days < 0) {
        return true
    } else {
        return false
    }
}

