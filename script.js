document.addEventListener("DOMContentLoaded", function() {
  const formOpenBtn = document.querySelector("#form-open");
  const home = document.querySelector(".home");
  const formContainer = document.querySelector(".form_container");
  const formCloseBtn = document.querySelector(".form_close");
  const signupBtn = document.querySelector("#signup");
  const loginBtn = document.querySelector("#login");
  const pwShowHide = document.querySelectorAll(".pw_hide");
  const getStartedButton = document.querySelector("#get-started-button");

  // Event listener to open login form when "Get Started" button is clicked
  getStartedButton.addEventListener("click", function() {
    formContainer.classList.add("active");
  });

  formOpenBtn.addEventListener("click", () => home.classList.add("show"));
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
  });
  loginBtn.addEventListener("click", (e) => {
    e.preventDefault();
    formContainer.classList.remove("active");
  });
});
