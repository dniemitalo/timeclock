window.onload = function() {
document.getElementById("first").focus();
};

function submitClicked() {
    if (validateForm()) {
        signUp();
    }
}

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
        document.getElementById('status').innerHTML = "<p style="color:red;">"+alertmessage+"</p>";
    }
    
    return validated;
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function signUp(){
    var idfield = document.getElementById('idfield').value;
    var last = document.getElementById('last').value;
    var first = document.getElementById('first').value;
    var email = document.getElementById('email').value;
    var cell = document.getElementById('cell').value;
    var gradclass = document.getElementById('gradclass').value;
    var shirtsize = document.getElementById('shirtsize').value;
    var server_login = document.getElementById('server_login').value;
    var server_password = document.getElementById('server_password').value;
    var guardian1first = document.getElementById('guardian1first').value;
    var guardian1last = document.getElementById('guardian1last').value;
    var guardian1email = document.getElementById('guardian1email').value;
    var guardian1cell = document.getElementById('guardian1cell').value;
    var guardian2first = document.getElementById('guardian2first').value;
    var guardian2last = document.getElementById('guardian2last').value;
    var guardian2email = document.getElementById('guardian2email').value;
    var guardian2cell = document.getElementById('guardian2cell').value;
    var activities = document.getElementById('activities').value;
    var availability = document.getElementById('availability').value;
    var bring = document.getElementById('bring').value;
    var role = document.getElementById('role').value;
    var prog_pref = document.getElementById('prog_pref').value;
    var team_pref = document.getElementById('team_pref').value;

    var params = 
        'idfield='+idfield+
        '&last='+last+
        '&first='+first+
        '&email='+email+
        '&cell='+cell+
        '&gradclass='+gradclass+
        '&shirtsize='+shirtsize+
        '&server_login='+server_login+
        '&server_password='+server_password+
        '&guardian1first='+guardian1first+
        '&guardian1last='+guardian1last+
        '&guardian1email='+guardian1email+
        '&guardian1cell='+guardian1cell+
        '&guardian2first='+guardian2first+
        '&guardian2last='+guardian2last+
        '&guardian2email='+guardian2email+
        '&guardian2cell='+guardian2cell+
        '&activities='+activities+
        '&availability='+availability+
        '&bring='+bring+
        '&role='+role+
        '&prog_pref='+prog_pref+
        '&team_pref='+team_pref;

    var xhr_signup = new XMLHttpRequest();
    xhr_signup.onreadystatechange = function() {
        if (xhr_signup.status == 200) {
            document.getElementById('status').innerHTML = xhr_signup.responseText;
            document.getElementById("regForm").reset();
        } else {
            document.getElementById('status').innerHTML = xhr_signup.status;
        }
    };
    xhr_signup.open("POST", "register2.php", true);
    xhr_signup.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr_signup.send(params);
}