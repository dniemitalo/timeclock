window.onload = function() {
  document.getElementById("idfield").focus();
};

function validateForm() {
    var x = document.forms["punchForm"]["ID"].value;
    if (x == null || x == "") {
        alert("ID must be filled out");
        return false;
    }
}