function changeView() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signUpBox.classList.toggle("d-none");
  signInBox.classList.toggle("d-none");
}

function signup() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var password = document.getElementById("password");
  var mobile = document.getElementById("mobile");
  var gender = document.getElementById("gender");

  var form = new FormData();

  form.append("f", fname.value);
  form.append("l", lname.value);
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("m", mobile.value);
  form.append("g", gender.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;

      if (response == "Success") {
        document.getElementById("msg").innerHTML = "Registration success !";
        document.getElementById("msg").className = "alert alert-success";
        document.getElementById("msgdiv").className = "d-block";
        swal ("Success",response,"success");
      } else {
        document.getElementById("msg").innerHTML = response;
        document.getElementById("msgdiv").className = "d-block";
        swal ("Error",response,"error");
      }
    }
  };

  request.open("POST", "signUpProcess.php", true);
  request.send(form);
}

function signin() {
  var email = document.getElementById("email2");
  var password = document.getElementById("password2");
  var rememberme = document.getElementById("rememberme");

  var form = new FormData();
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("r", rememberme.checked);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      if (response == "Success") {
        document.getElementById("msg2").innerHTML = "Login Success!";
        document.getElementById("msg2").className = "alert alert-success";
        document.getElementById("msgdiv2").className = "d-block";

        window.location = "home.php";
      } else {
        document.getElementById("msg2").innerHTML = response;
        document.getElementById("msgdiv2").className = "d-block";
      }
    }
  };

  request.open("POST", "signinProcess.php", true);
  request.send(form);
}

var forgotPasswordmodal;
function forgotPassword() {
  var email = document.getElementById("email2").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      if (response == "success") {
        alert("Email sent Successfully. Check your Inbox.");
        var modal = document.getElementById("fpmodal");
        forgotPasswordmodal = new bootstrap.Modal(modal);
        forgotPasswordmodal.show();
      }else{
        document.getElementById("msg2").innerHTML = response;
        document.getElementById("msgdiv2").className = "d-block";
        
      }
    }
  };

  request.open("GET", "forgotPasswordProcess.php?e=" + email, true);
  request.send();
}

function showPassword(){
  var textfield = document.getElementById("np");
  var button = document.getElementById("rnb");

  if (textfield.type == "password") {
    textfield.type = "text";
    button.innerHTML = "Hide";


  }else{
    textfield.type ="password";
    button.innerHTML= "Show";
  }
}

function showPassword2(){
  var textfield = document.getElementById("rnp");
  var button = document.getElementById("rnbp");

  if (textfield.type == "password") {
    textfield.type = "text";
    button.innerHTML = "Hide";


  }else{
    textfield.type ="password";
    button.innerHTML= "Show";
  }
}

function resetPassword(){
  var email = document.getElementById("email2");
  var newpassword = document.getElementById("np");
  var retypepassword = document.getElementById("rnp");
  var verificationcode = document.getElementById("vcode");

  var form = new FormData();

  form.append("e",email.value);
  form.append("n",newpassword.value);
  form.append("r",retypepassword.value);
  form.append("v",verificationcode.value);
  
  var request = new XMLHttpRequest();

  request.onreadystatechange = function (){
    if (request.status == 200 && request.readyState ==4) {
      var response = request.responseText;

      if (response == "success") {
        alert("Password updated successfully.");
        forgotPasswordmodal.hide();
      }else{
      alert(response);
      }
    }
  }

  request.open("POST","resetPasswordProcess.php",true);
  request.send(form);

}

function signout(){
  var request = new XMLHttpRequest();

  request.onreadystatechange = function (){
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;

      if (this.responseText == "success") {
        window.location.reload();
      }

      alert(response);
    }
  }

  request.open("GET","signoutProcess.php",true);
  request.send();
}

function showPassword3(){
  var textfield = document.getElementById("pf");
  var button = document.getElementById("basic-addon2_i");

  if (textfield.type == "password") {
    textfield.type = "text";
    button.classList = "bi bi-eye-fill text-white";


  }else{
    textfield.type ="password";
    button.classList="bi bi-eye-slash-fill text-white";
  }
}


function changeProfileImg(){
  var img = document.getElementById("profileimage");

  img.onchange = function(){
    var file = this.files[0];
    var url = window.URL.createObjectURL(file);


    document.getElementById("img").src = url;
    

  }
}

function updateProfile(){
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var line1 = document.getElementById("line1");
  var line2 = document.getElementById("line2");
  var mobile = document.getElementById("mobile");
  var province = document.getElementById("province");
  var district = document.getElementById("district");
  var city = document.getElementById("city");
  var pcode = document.getElementById("pcode");
  var image = document.getElementById("profileimage");
  
  var form = new FormData();
  form.append("f",fname.value);
  form.append("l",lname.value);
  form.append("m",mobile.value);
  form.append("l1",line1.value);
  form.append("l2",line2.value);
  form.append("p",province.value);
  form.append("c",city.value);
  form.append("d",district.value);
  form.append("pc",pcode.value);
  form.append("i",image.files[0]);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function(){
    if(request.status==200 && request.readyState==4){
      var response = request.responseText;
      if(response == "updated" || response=="saved"){
        window.location.reload();
      }else{
        alert(response);
      }
    }
  }

  request.open("POST","updateProfileProcess.php",true);
  request.send(form);
  
}