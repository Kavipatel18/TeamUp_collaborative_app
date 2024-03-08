'use strict';
//dropdown
document.addEventListener("DOMContentLoaded", function() {
    const dropdownButton = document.getElementById("dropdownButton");
    const dropdownContent = document.getElementById("myDropdown");

    if (dropdownButton && dropdownContent) {
        dropdownButton.addEventListener("click", function(event) {
            dropdownContent.classList.toggle("show");
        });

        window.addEventListener("click", function(event) {
            if (!event.target.matches("#dropdownButton")) {
                dropdownContent.classList.remove("show");
            }
        });
    } else {
        console.error("Dropdown button or dropdown content not found.");
    }
});

//add member
document.addEventListener("DOMContentLoaded", function () {
    const memberNameInput = document.getElementById("member-id");
  
    const project = document.querySelector("#add-button");
  
    project.addEventListener("click", function (event) {
      event.preventDefault();
      console.log("you clicked it");
      const memberName = memberNameInput.value.trim();
  
      if (memberName !== "") {
        var x = new XMLHttpRequest();
        x.open("POST", "database/add_member.php");
        x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
        x.onload = function () {
          if (x.status >= 200 && x.status < 300) {
            var res = x.responseText;
  
            if (res == "Member added successfully.") {
                location.reload();
            } else {
              alert("Failed to add member.");
            }
          } else {
            alert("Request failed with status: " + x.status);
          }
        };
        x.send("email=" + encodeURIComponent(memberName));
      }
      else{
        alert("Please enter an email address.");
                    return;
      }
    });

});

//profile and change button
document.addEventListener("DOMContentLoaded", function () {
  const formOpenBtn = document.querySelector("#profile"),
    chngepassBtn = document.querySelector("#changepass"),
    home = document.querySelector(".home"),
    pwShowHide = document.querySelectorAll(".pw_hide"),
    profileForm = document.querySelector(".profile_form"),
    resetForm = document.querySelector(".reset_form"),
    formCloseBtn = document.querySelector(".form_close");

  formOpenBtn.addEventListener("click", function () {
    home.classList.add("show");
    resetForm.style.display = "none";
    profileForm.style.display = "block";
  });

  chngepassBtn.addEventListener("click", function () {
    resetForm.style.display = "block";
    profileForm.style.display = "none";
  });

  formCloseBtn.addEventListener("click", function () {
    home.classList.remove("show");
  });

  pwShowHide.forEach((icon) => {
    icon.addEventListener("click", function () {
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
});
