function validate() {
    var old_password = document.getElementById("oldpassword").value;
    var new_password = document.getElementById("newpassword").value;
    var repeat_password = document.getElementById("rnewpassword").value;
    var error_msg = document.getElementById("error");
    if (old_password == "" || new_password == "" || repeat_password == "") {
        error_msg.innerHTML = "Please fill all fields.";
        return false;
    }
    else if(new_password!==repeat_password){

        error_msg.innerHTML = "Password doesen't match.";
        return false;
    }
    return true;
}