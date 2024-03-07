'use strict';
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
              alert("Refresh Page for result!!");
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