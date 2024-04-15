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

//add Activity
document.addEventListener("DOMContentLoaded", function () {
    const memberNameInput = document.getElementById("member-id");
    const activityNameInput = document.getElementById("activity-name");
  
    const project = document.querySelector("#add-button1");
  
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
              alert("Refresh Page for result!!");
            } else {
              alert("Failed to add activity.");
            }
          } else {
            alert("Request failed with status: " + x.status);
          }
        };
        x.send(`email=${encodeURIComponent(memberName)}&activityName=${encodeURIComponent(activityName)}`);
      }
      else{
        alert("Please enter an email address.");
        return;
      }
    });
  
  });

//on click delete
document.addEventListener("DOMContentLoaded", function () {
  const deletebtn = document.querySelectorAll("#delete");

  deletebtn.forEach(function (button) {
    button.addEventListener("click", function (event) {
      if(confirm("Are you want to delete-activity!")==true)
      {
      //const projectName = button.previousElementSibling.value.substring(9);
      const activityId = button.previousElementSibling.value.substring(9);

      console.log("Activity ID:" + activityId);

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
      location.reload();
    }
    });
  });
});