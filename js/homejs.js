document.addEventListener("DOMContentLoaded", function () {
  const formOpenBtn = document.querySelector("#changepass"),
    pwShowHide = document.querySelectorAll(".pw_hide"),
    home = document.querySelector(".home"),
    formContainer = document.querySelector(".form_container"),
    formCloseBtn = document.querySelector(".form_close");

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
});

function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
  if (!event.target.matches(".dropbtn")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};

document.addEventListener("DOMContentLoaded", function () {
  const chngebtn = document.querySelector("#change");

  chngebtn.addEventListener("click", change);
});

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
        alert(response);
      } else {
        alert(response);
      }
    } else {
      alert("Request failed with status:" + xhr.status);
    }
  };

  xhr.send("currentpassword=" + encodeURIComponent(currentpassword));
}
document.addEventListener("DOMContentLoaded", function () {
  const projectForm = document.getElementById("create-project-form");
  const projectNameInput = document.getElementById("project-name");
  const projectsContainer = document.getElementById("projects-container");
  const project = document.querySelector("#create-button");

  project.addEventListener("click", function (event) {
    event.preventDefault();
    let temp = document.getElementById("remove");
    if (temp != null) temp.remove();
    const projectName = projectNameInput.value.trim();

    if (projectName !== "") {
      createProject(projectName);
      projectNameInput.value = "";
    }
  });

  function createProject(projectName) {
    const projectElement = document.createElement("div");
    projectElement.classList.add("project");

    projectElement.innerHTML = `
            <input type="submit" style="border:none; font-size:18px;width: -webkit-fill-available;" id="proj" class="project-name" value="${projectName}" />
      `;

    projectsContainer.appendChild(projectElement);

    // Add event listener to the edit icon
    const editIcon = projectElement.querySelector(".edit-icon");
    const deleteIcon = projectElement.querySelector(".delete-icon");
    const projectNameInput = projectElement.querySelector(".project-name");

    editIcon.addEventListener("click", function () {
      projectNameInput.removeAttribute("disabled");
      projectNameInput.focus(); // Focus on input field
    });

    deleteIcon.addEventListener("click", function () {
      if (confirm("Delete Project!")) {
        projectElement.remove();
      } else {
      }
    });

    projectNameInput.addEventListener("blur", function () {
      projectNameInput.setAttribute("disabled", true);
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const projectsContainer = document.getElementById("projects-container");

  projectsContainer.addEventListener("click", function (event) {
    const clickedElement = event.target;

    if (clickedElement.classList.contains("project-name")) {
      const projectName = clickedElement.value;

      var x = new XMLHttpRequest();
      x.open("POST", "database/insert_project.php");
      x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      
      x.onload = function () {
        
        if (x.status >= 200 && x.status < 300) {
          var response = x.responseText;
          alert(response);
          window.location.href = "project.php";
        } else {
          alert("Request failed with status: " + x.status);
        }
      };
      x.send("project=" + encodeURIComponent(projectName));
    }
  });
});
