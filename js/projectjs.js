'use strict';
//profile and change pass
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
            } 
            else if(res="Failed to add member.")
            {
              //alert("hi,you want to drink chai!")
              alert("Member is not user of TeamUp.We send email to user\nwait for few seconds");
              const xhr = new XMLHttpRequest();
              xhr.open("POST", "database/send_email_newUser.php");
              xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xhr.onload = function () {
                if (xhr.status === 200) {
                  alert("Email sent!");
                 location.reload();
                } else {
                  alert("Member is not user of TeamUp");
                }
              };
              xhr.send("memberName=" + memberName);
            }
            else {
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

// on click delete
document.addEventListener("DOMContentLoaded", function () {
  const deletebtn = document.querySelectorAll("#delete");

  deletebtn.forEach(function (button) {
    button.addEventListener("click", function (event) {
      if(confirm("Are you want to delete project-member!")==true)
      {
      event.preventDefault();
      let mName = this.parentNode.querySelector('.email').textContent.trim();
      console.log("Member Name:" + mName);
 
      var x = new XMLHttpRequest();
      x.open("POST", "database/delete_member.php");
      x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      x.onload = function () {
        if (x.status >= 200 && x.status < 300) {
          var res = x.responseText;
          console.log(res);
           location.reload();
        
        } else {
          alert("Request failed with status: " + x.status);
        }
      };
      x.send("memail=" + encodeURIComponent(mName));
      location.reload();
    }
    });
  });
});