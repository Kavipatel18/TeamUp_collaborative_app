<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: white;
            padding: 1rem 0;
            text-align: center;
        }
        #create-project-form {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        #create-project-form h2 {
            margin-top: 0;
        }
        #project-name {
            width: calc(100% - 120px);
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        #create-button {
            padding: 0.5rem 1rem;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #projects-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 1rem;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .project {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 0.5rem;
        }
        .edit-icon {
            cursor: pointer;
        }
        input[type="text"]{
            border: none;
        }
        input[type="text" i]{
            border: none;
        }
        input:disabled{
            border: none;
            
        }
    </style>
</head>
<body>
    <header>
        <h1>TeamUp</h1>
    </header>
    <div id="create-project-form">
        <h2>Create a New Project</h2>
        <input type="text" id="project-name" placeholder="Enter project name" required>
        <button id="create-button">Create</button>
    </div>
    <div id="projects-container"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const projectForm = document.getElementById('create-project-form');
            const projectNameInput = document.getElementById('project-name');
            const projectsContainer = document.getElementById('projects-container');
            const project = document.querySelector('#create-button');
            
            project.addEventListener('click', function(event) {
                event.preventDefault();
                const projectName = projectNameInput.value.trim();
                
                if (projectName !== '') {
                    createProject(projectName);
                    projectNameInput.value = ''; // Clear input field after project creation
                }
            });

            function createProject(projectName) {
                const projectElement = document.createElement('div');
                projectElement.classList.add('project');
                projectElement.innerHTML = `
                    <input style="height:25px;width:700px;"type="text" class="project-name" value="${projectName}" disabled>
                    <span class="edit-icon">&#9998;</span>
                `;
                
                projectsContainer.appendChild(projectElement);

                // Add event listener to the edit icon
                const editIcon = projectElement.querySelector('.edit-icon');
                const projectNameInput = projectElement.querySelector('.project-name');

                editIcon.addEventListener('click', function() {
                    projectNameInput.removeAttribute('disabled');
                    projectNameInput.focus(); // Focus on input field
                });

                projectNameInput.addEventListener('blur', function() {
                    projectNameInput.setAttribute('disabled', true);
                });
            }
        });
    </script>
</body>
</html>

