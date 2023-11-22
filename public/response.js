var responsesList = document.getElementById("responsesList");

function updateResponses() {
    const urlParams = new URLSearchParams(window.location.search);
    const questionId = urlParams.get('id');

    const req = new XMLHttpRequest();
    req.open('GET', `/responses?question_id=${questionId}`);
    req.onreadystatechange = function () {
        if (req.readyState === 4 && req.status === 200) {
            const response = JSON.parse(req.responseText);
            const responses = response.responses || [];
            displayResponses(responses);
        } else {
            console.error('Failed to fetch responses. Status code:', req.status);
        }
    };
    req.send();
}


function displayResponses(responses) {
    responsesList.innerHTML = "";
    responses.forEach(function (response) {
        var listItem = document.createElement("li");
        listItem.className = "list-group-item";
        listItem.innerHTML = `
            ${new Date(response.date).toLocaleString()} - ${response.response} - ${response.user ? response.user.nom : 'Unknown User'}
        `;
        responsesList.appendChild(listItem);
    });
}

setInterval(updateResponses, 30000);

updateResponses();
