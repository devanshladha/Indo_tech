function startQuiz() {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "index.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(xhr.responseText);
            updatePoints();
        }
    };
    xhr.send("action=start_quiz");
}

function redeemPoints() {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "index.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(xhr.responseText);
            updatePoints();
        }
    };
    xhr.send("action=redeem_points");
}

function updatePoints() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "get_points.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById('points-count').textContent = xhr.responseText;
        }
    };
    xhr.send();
}

window.onload = function() {
    updatePoints();
};
