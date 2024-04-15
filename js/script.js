'use strict';
let otp = "";
document.addEventListener("DOMContentLoaded", function () {
  const formOpenBtn = document.querySelectorAll("#form-open"),
    home = document.querySelector(".home"),
    formContainer = document.querySelector(".form_container"),
    formCloseBtn = document.querySelector(".form_close"),
    signupBtn = document.querySelector("#signup"),
    backBtn = document.querySelector("#back"),
    loginBtn = document.querySelector("#login"),
    otpforgetBtn = document.querySelector("#passforget"),
    forgetPasswordBtn = document.querySelector("#forget"),
    otpsubmitBtn = document.querySelector("#otpsubmit"),
    changeBtn = document.querySelector("#change"),
    pwShowHide = document.querySelectorAll(".pw_hide");

  for(let i = 0;i<formOpenBtn.length;i++)
  formOpenBtn[i].addEventListener(
    "click",
    () => home.classList.add("show"),
    (document.querySelector(".forget_form").style.display = "none"),
    (document.querySelector(".forgetotp_form").style.display = "none"),
    (document.querySelector(".reset_form").style.display = "none")
  );
  formCloseBtn.addEventListener("click", () => home.classList.remove("show"));

  pwShowHide.forEach((icon) => {
    icon.addEventListener("click", () => {
      let getPwInput = icon.parentElement.querySelector("input");
      if (getPwInput.type === "password") {
        getPwInput.type = "text";
        icon.classList.replace("uil-eye-slash", "uil-eye");
      } else {
        getPwInput.type = "password";
        icon.classList.replace("uil-eye", "uil-eye-slash");
      }
    });
  });

  signupBtn.addEventListener("click", (e) => {
    e.preventDefault();
    formContainer.classList.add("active");
    document.querySelector(".login_form").style.display = "none";
    document.querySelector(".forget_form").style.display = "none";
    document.querySelector(".signup_form").style.display = "block";
    document.querySelector(".forgetotp_form").style.display = "none";
    document.querySelector("#passforget").style.display = "none";
    document.querySelector(".reset_form").style.display = "none";
  });

  loginBtn.addEventListener("click", (e) => {
    e.preventDefault();
    formContainer.classList.remove("active");
    document.querySelector(".signup_form").style.display = "none";
    document.querySelector(".forget_form").style.display = "none";
    document.querySelector(".login_form").style.display = "block";
    document.querySelector(".forgetotp_form").style.display = "none";
    document.querySelector("#passforget").style.display = "none";
    document.querySelector(".reset_form").style.display = "none";
  });

  forgetPasswordBtn.addEventListener("click", (e) => {
    e.preventDefault();
    document.querySelector(".login_form").style.display = "none";
    document.querySelector(".signup_form").style.display = "none";
    document.querySelector(".forget_form").style.display = "block";
    document.querySelector(".forgetotp_form").style.display = "none";
    document.querySelector("#passforget").style.display = "block";
    document.querySelector(".reset_form").style.display = "none";
  });

  backBtn.addEventListener("click", (e) => {
    e.preventDefault();
    document.querySelector(".login_form").style.display = "block";
    document.querySelector(".forget_form").style.display = "none";
    document.querySelector(".forgetotp_form").style.display = "none";
    document.querySelector("#passforget").style.display = "none";
    document.querySelector(".reset_form").style.display = "none";
  });

  otpforgetBtn.addEventListener("click", (e) => {
    e.preventDefault();
    formContainer.classList.add("active");
    document.querySelector(".login_form").style.display = "none";
    document.querySelector(".forget_form").style.display = "block";
    document.querySelector(".signup_form").style.display = "none";
    document.querySelector(".forgetotp_form").style.display = "block";
    document.querySelector("#passforget").style.display = "none";
    document.querySelector(".reset_form").style.display = "none";
    let email = document.getElementById("email").value;
    xhr.open("POST", "database/checkemail.php");
    xhr.send("email=" + email);
  });

  otpsubmitBtn.addEventListener("click", (e) => {
    let x = document.getElementById("number").value;
    if (x != otp) {
      alert("Invalid Otp");
      e.preventDefault();
      formContainer.classList.remove("active");
      document.querySelector(".signup_form").style.display = "none";
      document.querySelector(".forget_form").style.display = "none";
      document.querySelector(".login_form").style.display = "block";
      document.querySelector(".forgetotp_form").style.display = "none";
      document.querySelector("#passforget").style.display = "none";
      document.querySelector(".reset_form").style.display = "none";
    }
    else{
      e.preventDefault();
      formContainer.classList.remove("active");
      document.querySelector(".signup_form").style.display = "none";
      document.querySelector(".forget_form").style.display = "none";
      document.querySelector(".login_form").style.display = "none";
      document.querySelector(".forgetotp_form").style.display = "none";
      document.querySelector("#passforget").style.display = "none";
      document.querySelector(".reset_form").style.display = "block";
    }
  });
 
  //change pass

  changeBtn.addEventListener("click", (e) => {
    let password = document.getElementById("password").value;
    let repassword = document.getElementById("repassword").value;
    
    const xhr = new XMLHttpRequest();

    xhr.open("POST", "database/update.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert("Updated!!");
        } else {
            alert("Unwanted Error!!");
        }
    };
    xhr.send("password=" + password + "&repassword=" + repassword);
});



});

//forget pass otp

const forget = document.querySelector("#passforget");

function generateOtp(length) {
  let emailInput = document.getElementById("email");
  
  if (emailInput.value.trim() === '') {
    alert("Please enter your email address.");
    return; 
  }
  otp = "";
  for (let i = 0; i < length; i++)
    otp += Math.floor(Math.random() * 10).toString();

  let email = document.getElementById("email").value;
  
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "database/send_email.php");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (xhr.status === 200) {
      alert("Email sent successfully");
    } else {
      alert("Unwanted Error in sending email");
    }
  };
  xhr.send("otp=" + otp + "&email=" + email);

}

forget.addEventListener("click", () => generateOtp(4));
 