function validate() {
    var name = document.getElementById("name");
    if (name.value == "") {
      error = " Name field is required! ";
      document.getElementById("error").innerHTML = error;
      return false;
    }
  
    var lastname = document.getElementById("lastname");
    if (lastname.value == "") {
      error = " Last Name  field is required! ";
      document.getElementById("error").innerHTML = error;
      return false;
    }
  
    var username = document.getElementById("username");
    if (username.value == "") {
      error = " Username  field is required! ";
      document.getElementById("error").innerHTML = error;
      return false;
    }
  
    var email = document.getElementById("email");
    if (email.value == "" || email.value.indexOf("@") == -1) {
      error = " You Have To Write Valid Email Address! ";
      document.getElementById("error").innerHTML = error;
      return false;
    }
  
    var password = document.getElementById("password");
    if (password.value == "" || password.value <= 8) {
      error = " Password Must Be More Than Or Equal To 8 Digits. ";
      document.getElementById("error").innerHTML = error;
      return false;
    }
  
    var confirmpassword = document.getElementById("confirmpassword");
    if (confirmpassword.value == "" || confirmpassword.value != password.value) {
      error = " Password doesent match. ";
      document.getElementById("error").innerHTML = error;
      return false;
    } else {
      return true;
    }
  }
  
 