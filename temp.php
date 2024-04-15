<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Activity Tracking</title>
<style>
    .member {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
    }
    .activity-input {
        margin-top: 5px;
    }
</style>
</head>
<body>
<div id="members"></div>

<script>
function addMember() {
    // Create member div
    const memberDiv = document.createElement('div');
    memberDiv.className = 'member';
    
    // Add input for member name
    const nameInput = document.createElement('input');
    nameInput.type = 'text';
    nameInput.placeholder = 'Enter member name';
    
    // Add button to add activity
    const addButton = document.createElement('button');
    addButton.textContent = '+ Add Activity';
    addButton.onclick = function() {
        addActivityInput(memberDiv);
    };
    
    // Add activity inputs container
    const activityInputsContainer = document.createElement('div');
    
    // Append elements to member div
    memberDiv.appendChild(nameInput);
    memberDiv.appendChild(addButton);
    memberDiv.appendChild(activityInputsContainer);
    
    // Append member div to container
    document.getElementById('members').appendChild(memberDiv);
}

function addActivityInput(memberDiv) {
    // Create activity input
    const activityInput = document.createElement('input');
    activityInput.type = 'text';
    activityInput.placeholder = 'Enter activity';
    activityInput.className = 'activity-input';
    
    // Append activity input to member div
    memberDiv.querySelector('div').appendChild(activityInput);
}
</script>

<button onclick="addMember()">Add Member</button>
</body>
</html>
