"use strict";
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

document.addEventListener("DOMContentLoaded", function () {
  const dropdownButton = document.getElementById("dropdownButton");
  const dropdownContent = document.getElementById("myDropdown");

  if (dropdownButton && dropdownContent) {
    dropdownButton.addEventListener("click", function (event) {
      dropdownContent.classList.toggle("show");
    });

    window.addEventListener("click", function (event) {
      if (!event.target.matches("#dropdownButton")) {
        dropdownContent.classList.remove("show");
      }
    });
  } else {
    console.error("Dropdown button or dropdown content not found.");
  }
});

//add Activity
document.addEventListener("DOMContentLoaded", function () {
  const memberNameInput = document.getElementById("member-id");
  const activityNameInput = document.getElementById("activity-name");

  const project = document.querySelector("#add-button");

  project.addEventListener("click", function (event) {
    event.preventDefault();
    console.log("you clicked it");
    const memberName = memberNameInput.value.trim();
    const activityName = activityNameInput.value.trim();

    if (memberName !== "" && activityName !== "") {
      var x = new XMLHttpRequest();
      x.open("POST", "database/add_activity.php");
      x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      x.onload = function () {
        if (x.status >= 200 && x.status < 300) {
          var res = x.responseText;
          if (res == "Activity added successfully.") {
            location.reload();
          } else {
            alert(res);
          }
        } else {
          alert("Request failed with status: " + x.status);
        }
      };
      x.send(
        "email=" +
          encodeURIComponent(memberName) +
          "&activityName=" +
          encodeURIComponent(activityName)
      );
    } else {
      alert("Please enter details first!!");
      return;
    }
  });
});

//Check Activity
document.addEventListener("DOMContentLoaded", function () {
  const checkBox = document.querySelectorAll("#isdone");

  checkBox.forEach(function (button) {
    button.addEventListener("click", function (event) {
      event.preventDefault();

      let activityId = this.getAttribute("data-activity-id");
      console.log(activityId);

      console.log("you clicked it");
      var x = new XMLHttpRequest();
      x.open("POST", "database/check_activity.php");
      x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      x.onload = function () {
        if (x.status >= 200 && x.status < 300) {
          var res = x.responseText;
          if (res == "Activity Done successfully.") {
            location.reload();
          } else {
            alert(res);
          }
        } else {
          alert("Request failed with status: " + x.status);
        }
      };
      x.send("activityID=" + encodeURIComponent(activityId));
    });
  });
});

//on click delete
document.addEventListener("DOMContentLoaded", function () {
  const deletebtn = document.querySelectorAll(".delete");

  deletebtn.forEach(function (button) {
    button.addEventListener("click", function (event) {
      let activityId = this.getAttribute("data-activity-id");

      var x = new XMLHttpRequest();
      x.open("POST", "database/delete_activity.php");
      x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      x.onload = function () {
        if (x.status >= 200 && x.status < 300) {
          var res = x.responseText;

          location.reload();
        } else {
          alert("Request failed with status: " + x.status);
        }
      };

      x.send("activityID=" + encodeURIComponent(activityId));
    });
  });
});

// on click delete
document.addEventListener("DOMContentLoaded", function () {
  const deletebtn = document.querySelectorAll("#delete1");

  deletebtn.forEach(function (button) {
    button.addEventListener("click", function (event) {
      if (confirm("Are you want to delete project-member!") == true) {
        event.preventDefault();
        let mName = this.parentNode.querySelector(".email").textContent.trim();
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
