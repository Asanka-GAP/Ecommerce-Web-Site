function changeView(){
    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");
}

function signup(){
    var fname=document.getElementById("fname");
    var lname=document.getElementById("lname");
    var email=document.getElementById("email");
    var password=document.getElementById("password");
    var mobile=document.getElementById("mobile");
    var gender=document.getElementById("gender");

    alert(fname.value);
    alert(lname.value);

    var form = new FormData();

    form.append("f",fname.value);
    form.append("l",lname.value);
    form.append("e",email.value);
    form.append("p",password.value);
    form.append("m",mobile.value);
    form.append("g",gender.value);
    
    
    

}