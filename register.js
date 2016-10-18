window.onload = function() {
document.getElementById("idfield").focus();
};

function validateForm() {
    var id = document.forms["regForm"]["ID"].value;
    var first = document.forms["regForm"]["first"].value;
    var last = document.forms["regForm"]["last"].value;
    if (id == null || id == "" || first==null||first==""||last==null||last=="") 
    {
        alert("All fields must be completed.");
        return false;
    }
}