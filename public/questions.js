let questionsList = document.getElementById("questionsList");

function updateQuestions() {
    let req = new XMLHttpRequest();
    req.open("GET", "/questions");
    req.onreadystatechange = function () {
        if (req.readyState == 4) {
            if (req.status == 200) {
                let response = JSON.parse(req.responseText);
                let questions = response.questions || [];
                displayQuestions(questions);
            } else {
                console.error("Failed to fetch questions. Status code: " + req.status);
            }
        }
    };
    req.send();
}

function displayQuestions(questions) {
    questionsList.innerHTML = "";
    questions.forEach(function (question) {
        let listItem = document.createElement("li");
        listItem.className = "list-group-item";
        listItem.innerHTML = `
            ${new Date(question.date).toLocaleString()} - ${question.nom} - ${question.question} - ${question.user ? question.user.nom : 'Unknown User'}
            <a href="question.php?id=${question.id}">Responses</a>
        `;
        questionsList.appendChild(listItem);
    });
}

setInterval(updateQuestions, 30000);

updateQuestions();
