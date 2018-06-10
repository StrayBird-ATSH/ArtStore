var passwordValue = "";
var emailValue = "";
$("form input").blur(function () {
    console.log('confirmationTwo line2');
    var $parent = $(this).parent();
    $parent.find(".msg").remove();
    //removes the previous notifying elements
    //find(): finds all the matching elements in the matching elements set

    //Name validation
    if ($(this).is("input[name=\"first\"]")) {
        console.log('confirmationTwo line7');
        var nameVal = $.trim(this.value),
            regName = /^[a-zA-Z ]+$/;
        if (nameVal === "") {
            errorMsg = "Please input your first name";
            $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
        }
        else if (!regName.test(nameVal)) {
            errorMsg = "Your name should include only English characters";
            $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
        }
        else {
            okMsg = "Correct";
            $parent.find(".high").remove();
            $parent.append("<span class='msg onSuccess'>" + okMsg + "</span>");
        }
    }
    if ($(this).is("input[name=\"last\"]")) {
        console.log('confirmationTwo line7');
        regName = /^[a-zA-Z ]+$/;
        nameVal = $.trim(this.value);
        if (nameVal === "") {
            errorMsg = "Please input your last name";
            $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
        }
        else if (!regName.test(nameVal)) {
            errorMsg = "Your name should include only English characters";
            $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
        }
        else {
            okMsg = "Correct";
            $parent.find(".high").remove();
            $parent.append("<span class='msg onSuccess'>" + okMsg + "</span>");
        }
    }

    //Password validation
    if ($(this).is("#login-password")) {
        console.log('confirmationTwo line29');
        var passwordVal = $.trim(this.value);
        if (passwordVal === "") {
            errorMsg = "Password cannot be empty";
            $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
        }
        else if (passwordVal === "111") {
            errorMsg = "Sorry, the password does not match your account name.";
            $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
        }
        else {
            okMsg = "Correct";
            $parent.find(".high").remove();
            $parent.append("<span class='msg onSuccess'>" + okMsg + "</span>");
        }
    }
    if ($(this).is("#password")) {
        console.log('confirmationTwo line48');
        passwordVal = $.trim(this.value);
        if (passwordVal === "") {
            errorMsg = "Password cannot be empty";
            $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
        }
        else if (passwordVal === "111") {
            errorMsg = "Sorry, the password does not match your account name.";
            $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
        }
        else {
            okMsg = "Correct";
            $parent.find(".high").remove();
            $parent.append("<span class='msg onSuccess'>" + okMsg + "</span>");
        }
    }
    if ($(this).is("input[name=\"password1\"]")) {
        regName = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,21}$/;
        passwordVal = $.trim(this.value);
        passwordValue = passwordVal;
        if (passwordVal === "") {
            errorMsg = "Password cannot be empty";
            $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
        }
        else if (!regName.test(passwordVal)) {
            errorMsg = "Name should not be empty, longer than 6 digits, " +
                "shorter than 21 digits and include both numbers and characters" +
                ", excluding special characters, e.g. abc123456.";
            //class='msg onError' the space in the middle is the style of CSS
            $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
        }
        else {
            okMsg = "Correct";
            $parent.find(".high").remove();
            $parent.append("<span class='msg onSuccess'>" + okMsg + "</span>");
        }
    }
    if ($(this).is("input[name=\"password2\"]")) {
        var passwordValTwo = $.trim(this.value);
        if (passwordValTwo === "") {
            errorMsg = "Password confirmation cannot be empty";
            $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
        }
        else if (passwordValTwo !== passwordValue) {
            errorMsg = "Passwords does not match, please input again";
            $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
        }
        else {
            okMsg = "Correct";
            $parent.find(".high").remove();
            $parent.append("<span class='msg onSuccess'>" + okMsg + "</span>");
        }
    }


    //email validation
    if ($(this).is("input[name=\"email\"]")) {
        console.log('confirmationTwo line28');
        var emailVal = $.trim(this.value);
        var regEmail = /.+@.+\.[a-zA-Z]{2,4}$/;
        emailValue = emailVal;
        if (emailVal === "") {
            var errorMsg = "Email address cannot be empty.";
            $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
        }
        else if (!regEmail.test(emailVal)) {
            errorMsg = "Please input the correct email address" +
                " e.g. 123@abc.com ";
            $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
        }
        else if (emailVal === "helloWorld") {
            errorMsg = "The account does not exist";
            $parent.append("<span class='msg onError'>" + errorMsg + "</span>");
        }
        else {
            var okMsg = "Correct";
            $parent.find(".high").remove();
            $parent.append("<span class='msg onSuccess'>" + okMsg + "</span>");
        }
    }
}).keyup(function () {
    //triggerHandler prevents the browser from automatically getting
    // focus for the element after performing the event
    $(this).triggerHandler("blur");
}).focus(function () {
    $(this).triggerHandler("blur");
});

//when clicking the reset button, the trigger() triggers the text box to lose focus
$("#send").click(function () {
    //trigger the browser automatically gets focus for the element after the event
    $("form .required:input").trigger("blur");
    var numError = $("form .onError").length;
    if (numError) {
        return false;
    }
    alert("Register successfully");
});