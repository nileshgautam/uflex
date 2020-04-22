function AjaxPost(formData, url, successCallBack, errorCallBack, args = null) {
    var request = new XMLHttpRequest;
    request.onreadystatechange = function () {
        try {
            if (this.readyState == 4 && this.status == 200) {
                var content = request.responseText.trim();
                if (args == null)
                    successCallBack(content)
                else {
                    successCallBack(content, args)
                }

            } else if (this.status == 404 || this.status == 403) {
                throw "Error: readyState= " + this.readyState + " status= " + this.status;
            }
        } catch (e) {
            errorCallBack(e);
        }
    }
    request.open("POST", url);
    request.send(formData);
}

function AjaxError(error) {
    showAlert("Please contact IT. ", 'error');
}

function showAlert(errorMessage = '', Type = 'success', Delay = 2000) {
    if (errorMessage != '') {
        $.notify({
            message: errorMessage
        }, {
            type: Type,
            animate: {
                enter: 'animated bounceIn',
                exit: 'animated bounceOut'
            },
            newest_on_top: true,
            delay: Delay
        });
        return false;
    } else {
        return true;
    }
};

function isNumberKeyWithMax(evt, text) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    var txt = text.value + String.fromCharCode(charCode);
    var max = parseFloat(text.max);
    max = isNaN(max) ? Number.MAX_VALUE : max;
    var val = parseFloat(txt);
    val = isNaN(val) ? 0 : val;
    console.log(val);

    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;

    if (val > max)
        return false;
    return true;
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;

    return true;
}