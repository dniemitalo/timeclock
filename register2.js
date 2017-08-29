window.onload = function() {
document.getElementById("first").focus();
};

function validateForm() {
    var first = document.forms["regForm"]["first"].value.trim();
    var last = document.forms["regForm"]["last"].value.trim();
    var email = document.forms["regForm"]["email"].value.trim();
    var cell = document.forms["regForm"]["cell"].value.replace(/[^0-9]/g,"");
    var gradclass = document.forms["regForm"]["gradclass"].value;
    var shirtsize = document.forms["regForm"]["shirtsize"].value;
    var idfield = document.forms["regForm"]["idfield"].value.trim();
    var server_login = document.forms["regForm"]["server_login"].value.trim();
    var server_password = document.forms["regForm"]["server_password"].value.trim();
    var guardian1first = document.forms["regForm"]["guardian1first"].value.trim();
    var guardian1last = document.forms["regForm"]["guardian1last"].value.trim();
    var guardian1email = document.forms["regForm"]["guardian1email"].value.trim();
    var guardian1cell = document.forms["regForm"]["guardian1cell"].value.replace(/[^0-9]/g,"");
    var availability = document.forms["regForm"]["availability"].value.trim();
    var bring = document.forms["regForm"]["bring"].value.trim();

    var alertmessage = "";
    var validated = true;

    if (first==null||first==""||last==null||last=="") {
		alertmessage += "First and/or last name missing.\n";
        validated = false;
    }
    if (!validateEmail(email)){
        alertmessage += "Email missing or invalid.\n";
        validated = false;   
    }
    if (cell.length != 7 && cell.length != 10 && document.forms["regForm"]["cell"].value.trim() != "none") {
        alertmessage += "Cell phone number missing or invalid.\n";
        validated = false;
    }
    if (gradclass == null || gradclass =="") {
        alertmessage += "Graduating class missing.\n";
        validated = false;
    }
    if (shirtsize == null || shirtsize =="") {
        alertmessage += "T-Shirt size missing.\n";
        validated = false;
    }
    if (idfield == null || idfield =="") {
        alertmessage += "Linn-Mar ID card number missing.\n";
        validated = false;
    }
    if (server_login == null || server_login =="" || server_login.length < 4) {
        alertmessage += "LM computer login missing or invalid.\n";
        validated = false;
    }
    if (server_password.length != 8) {
        alertmessage += "LM computer password missing or invalid.\n";
        validated = false;
    }
    if (guardian1first == null || guardian1first =="" || guardian1last == null || guardian1last =="") {
        alertmessage += "Guardian 1 first and/or last name missing.\n";
        validated = false;
    }
    if (!validateEmail(guardian1email)) {
        alertmessage += "Guardian 1 email missing or invalid.\n";
        validated = false;
    }
    if (guardian1cell.length != 7 && guardian1cell.length != 10) {
        alertmessage += "Guardian 1 cell number missing or invalid.\n";
        validated = false;
    }
    if (availability == null || availability =="") {
        alertmessage += "Meeting time availability missing.\n";
        validated = false;
    }
    if (bring == null || bring =="" || bring.split(" ").length < 10) {
        alertmessage += "'What you can bring' missing or too short.\n";
        validated = false;
    }
    
    if (!validated) {
        alert(alertmessage);
    }
    
    return validated;
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}