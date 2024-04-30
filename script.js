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
                document.getElementById("msg").innerHTML = "Registration Success !";
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";
            } else {
                document.getElementById("msg").innerHTML = response;
                document.getElementById("msgdiv").className = "d-block";
                swal("Error", response, "error");
            }

        }
    }

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
            if (response == "success") {
                document.getElementById("msg2").innerHTML = "Login Success!";
                document.getElementById("msg2").className = "alert alert-success";
                document.getElementById("msgdiv2").className = "d-block";

                window.location = "home.php";
            } else {
                document.getElementById("msg2").innerHTML = response;
                document.getElementById("msgdiv2").className = "d-block";
            }
        }
    }

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
                alert("Email sent successfully. Check your Inbox.");
                var modal = document.getElementById("fpmodal");
                forgotPasswordmodal = new bootstrap.Modal(modal);
                forgotPasswordmodal.show();
            } else {
                document.getElementById("msg2").innerHTML = response;
                document.getElementById("msgdiv2").className = "d-block";
            }
        }
    }

    request.open("GET", "forgotPasswordProcess.php?e=" + email, true);
    request.send();

}

function showPassword() {

    var textfield = document.getElementById("np");
    var button = document.getElementById("npb");

    if (textfield.type == "password") {
        textfield.type = "text";
        button.innerHTML = "Hide";
    } else {
        textfield.type = "password";
        button.innerHTML = "Show";
    }

}

function showPassword2() {

    var textfield = document.getElementById("rnp");
    var button = document.getElementById("rnpb");

    if (textfield.type == "password") {
        textfield.type = "text";
        button.innerHTML = "Hide";
    } else {
        textfield.type = "password";
        button.innerHTML = "Show";
    }

}

function resetPassword() {

    var email = document.getElementById("email2");
    var newpassword = document.getElementById("np");
    var retypepassword = document.getElementById("rnp");
    var verificationcode = document.getElementById("vcode");

    var form = new FormData();
    form.append("e", email.value);
    form.append("n", newpassword.value);
    form.append("r", retypepassword.value);
    form.append("v", verificationcode.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                alert("Password updated successfully.");
                forgotPasswordmodal.hide();
            } else {
                alert(response);
            }

        }
    }

    request.open("POST", "resetPasswordProcess.php", true);
    request.send(form);

}

function signout() {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {

            var response = request.responseText;

            if (response == "success") {
                window.location.reload();
            }

        }
    }

    request.open("GET", "signOutProcess.php", true);
    request.send();

}

function showPassword3() {

    var input = document.getElementById("user_password");
    var icon = document.getElementById("basic-addon2_i");

    if (input.type == "password") {
        input.type = "text";
        icon.className = "bi bi-eye-fill text-white";
    } else {
        input.type = "password";
        icon.className = "bi bi-eye-slash-fill text-white";
    }

}

function changeProfileImg() {

    var img = document.getElementById("profileimage");

    img.onchange = function () {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        document.getElementById("img").src = url;

    }

}

function updateProfile() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");
    var image = document.getElementById("profileimage");

    var form = new FormData();
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("m", mobile.value);
    form.append("l1", line1.value);
    form.append("l2", line2.value);
    form.append("p", province.value);
    form.append("d", district.value);
    form.append("c", city.value);
    form.append("pc", pcode.value);
    form.append("i", image.files[0]);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "updated" || response == "saved") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "updateProfileProcess.php", true);
    request.send(form);

}

function loadBrands() {

    var cid = document.getElementById("category").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;

            document.getElementById("brand").innerHTML = response;

        }
    }

    request.open("GET", "loadBrandProcess.php?cid=" + cid, true);
    request.send();

}

function loadmodels() {

    var bid = document.getElementById("brand").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            document.getElementById("model").innerHTML = response;
        }
    }

    request.open("GET", "loadModelsProcess.php?bid=" + bid, true);
    request.send();

}

function saveclr() {

    var clr = document.getElementById("clr_input").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "saved") {
                window.location.reload();
            } else {
                alert(response);
            }

        }
    }

    request.open("GET", "saveClrProcess.php?clr=" + clr, true);
    request.send();

}

function addproduct() {

    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");
    var condition = 0;

    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    }

    var clr = document.getElementById("clr");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var form = new FormData();
    form.append("ca", category.value);
    form.append("b", brand.value);
    form.append("m", model.value);
    form.append("t", title.value);
    form.append("con", condition);
    form.append("col", clr.value);
    form.append("q", qty.value);
    form.append("co", cost.value);
    form.append("dwc", dwc.value);
    form.append("doc", doc.value);
    form.append("desc", desc.value);

    var form_count = image.files.length;

    for (var x = 0; x < form_count; x++) {
        form.append("image" + x, image.files[x]);
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                window.location.reload();
            } else {
                alert(response);
            }

        }
    }

    request.open("POST", "addNewProductProcess.php", true);
    request.send(form);

}

function changeProductImg() {

    var image = document.getElementById("imageuploader");

    image.onchange = function () {

        var length = image.files.length;

        if (length <= 3) {

            for (var x = 0; x < length; x++) {

                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;

            }

        } else {
            alert("You have uploaded " + length + " files. You are only proceed to upload 3 or less than 3 files.");
        }

    }

}

function changeStatus(id){

    var product_id = id;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function (){
        if(request.status == 200 && request.readyState == 4){
            var response = request.responseText;
            if(response == "deactivated" || response == "activated"){
                window.location.reload();
            }else{
                alert (response);
            }
        }
    }

    request.open("GET","changeStatusProcess.php?id="+product_id,true);
    request.send();
    
}


function sendId(){
    window.location = "updateProduct.php";
}

function sort1(x){

    var search= document.getElementById("s");
    var time = "0";
    var qty = "0";
    var condition = "0";

    if(document.getElementById("n").checked){
        time = "1";
    }else if(document.getElementById("o").checked){
        time = "2";
    }

    if(document.getElementById("h").checked){
        qty = "1";
    }else if(document.getElementById("l").checked){
        qty = "2";
    }

    if(document.getElementById("b").checked){
        condition = "1";
    }else if(document.getElementById("u").checked){
        condition = "2";
    }

    var form = new FormData();
    form.append("s",search.value);
    form.append("t",time);
    form.append("q",qty);
    form.append("c",condition);
    form.append("page",x);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function (){
        if(request.status == 200 && request.readyState == 4){
            var response = request.responseText;

            document.getElementById("sort").innerHTML = response;
            
        }
    }

    request.open("POST","sortProcess.php",true);
    request.send(form);


}