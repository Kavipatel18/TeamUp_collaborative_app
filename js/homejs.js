// profile and change password
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


// dropdown
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

document.addEventListener("DOMContentLoaded", function () {
  const chngebtn = document.querySelector("#change");

  chngebtn.addEventListener("click", change);

  function change() {
    let pass = document.getElementById("currentpassword");

    if (pass.value.trim() === "") {
      alert("Please enter your password.");
      return;
    }

    let currentpassword = document.getElementById("currentpassword").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "database/checkpassword.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        var response = xhr.responseText;

        if (response == "successfull") {
          const xhrUpdate = new XMLHttpRequest();
          xhrUpdate.open("POST", "database/update.php");
          xhrUpdate.setRequestHeader(
            "Content-Type",
            "application/x-www-form-urlencoded"
          );

          let pass1 = document.getElementById("password").value;
          let pass2 = document.getElementById("repassword").value;

          var data =
            "password=" +
            encodeURIComponent(pass1) +
            "&repassword=" +
            encodeURIComponent(pass2);

          var res;
          xhrUpdate.onload = function () {
            if (xhrUpdate.status >= 200 && xhrUpdate.status < 300) {
              res = xhrUpdate.responseText;
              alert(res);
            } else {
              alert("Request failed with status: " + xhrUpdate.status);
            }
          };
          
          xhrUpdate.send(data);
          window.location.href = "home.php";
        }
      } else {
        alert("Request failed with status:" + xhr.status);
      }
    };

    xhr.send("currentpassword=" + encodeURIComponent(currentpassword));
  }
});

// onclick of create button:
document.addEventListener("DOMContentLoaded", function () {
  const projectNameInput = document.getElementById("project-name");
  const projectsContainer = document.getElementById("projects-container");

  const project = document.querySelector("#create-button");
  const temp = document.querySelector("#proj");

  project.addEventListener("click", function (event) {
    event.preventDefault();
    console.log("you clicked it");
    const projectName = projectNameInput.value.trim();

    if (projectName !== "") {
      var x = new XMLHttpRequest();
      x.open("POST", "database/insert_project.php");
      x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      x.onload = function () {
        if (x.status >= 200 && x.status < 300) {
          var res = x.responseText;
         
          if (res == "Project name is already exists,please try another name!") {
            alert(res);
          } else {
            if (temp != null) temp.remove();
            createProject(projectName);
            projectNameInput.value = "";
            location.reload();
          }
        } else {
          alert("Request failed with status: " + x.status);
        }
      };
      x.send("project=" + encodeURIComponent(projectName));
    }
  });

  function createProject(projectName) {
    const projectElement = document.createElement("div");
    projectElement.classList.add("project");
    projectElement.innerHTML = `
            <input type="submit" style="border:none; font-size:18px;width: -webkit-fill-available;" id="projectshow"class="project-name" value="Project : ${projectName} " /><span class="delete" id="delete">&times;</span>
      `;

    projectsContainer.appendChild(projectElement);
  }
});

//project onclick redirector :
document.addEventListener("DOMContentLoaded", function () {
  const projectButtons = document.querySelectorAll(".project-name");
  const member = document.querySelectorAll(".member-project");
  projectButtons.forEach(function (button) {
    button.addEventListener("click", function (event) {
      const projectName = button.value.trim().substring(9);
      console.log("Project Name:" + projectName);

      window.location.href =
        "database/redirector.php?project=" + encodeURIComponent(projectName);
    });
  });
  member.forEach(function (button) {
    button.addEventListener("click", function (event) {
      const projectName = button.value.trim().substring(9);
      console.log("Project Name:" + projectName);

      window.location.href =
        "database/redirectormember.php?project=" + encodeURIComponent(projectName);
    });
  });
});

//on click delete
document.addEventListener("DOMContentLoaded", function () {
  const deletebtn = document.querySelectorAll("#delete");

  deletebtn.forEach(function (button) {
    button.addEventListener("click", function (event) {
      if(confirm("Are you want to delete-project!")==true)
      {
      const projectName = button.previousElementSibling.value.substring(9);
      console.log("Project Name:" + projectName);

      var x = new XMLHttpRequest();
      x.open("POST", "database/delete_project.php");
      x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      x.onload = function () {
        if (x.status >= 200 && x.status < 300) {
          var res = x.responseText;
            location.reload();
        
        } else {
          alert("Request failed with status: " + x.status);
        }
      };
      x.send("project=" + encodeURIComponent(projectName));
      location.reload();
    }
    });
  });
});


//search bar:

document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchInput");
  const projectsContainer = document.getElementById("proj1");

  if (projectsContainer) {
    searchInput.addEventListener("input", function (event) {
      const searchQuery = event.target.value.toLowerCase();
      console.log("Search Query:", searchQuery);

      filterProjects(searchQuery);
    });

    function filterProjects(query) {
      const projectContainers = document.querySelectorAll(".project");

      projectContainers.forEach(function (projectContainer) {
        const projectNameInput =
          projectContainer.querySelector(".project-name");
        const projectName = projectNameInput.value.toLowerCase();

        if (projectName.includes(query)) {
          projectContainer.style.display = "block";
        } else {
          projectContainer.style.display = "none";
        }
      });
    }
  } else {
    console.error("projectsContainer not found");
  }
});
