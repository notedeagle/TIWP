var score = 0;
var level = 1;
var lives = 5;
var playing = false;
var timer = true;

var start = document.getElementById("start");
var scoreDisplay = document.getElementById("score-display");
var cells = document.querySelectorAll(".cell");

function displayScore() {
    scoreDisplay.innerHTML = "Score: " + score + "<span id='level-display'> Level: " + level +
        "</span><span id='lifes-display'> Lives: " + lives + "</span>";
}

function randomCell() {
    return Math.floor(Math.random() * 16);
}

function gameOver() {
    if (lives === 0 || timer === false) {
        clearInterval(getCells);
        score = 0;
        level = 1;
        lives = 5;
        playing = false;
    }
}

function highlightCell() {
    var target = randomCell();
    var prevScore = score;
    cells[target].style.background = "green";
    setTimeout(function() {
        cells[target].style.background = "red";
        if (score === prevScore) {
            lives--;
            displayScore();
            gameOver();
        }
    }, 1000)
}

function countdown() {
    var seconds = 60;
    function tick() {
        var counter = document.getElementById("counter");
        seconds--;
        counter.innerHTML = "0:" + (seconds < 10 ? "0" : "") + String(seconds);
        if( seconds > 0 ) {
            setTimeout(tick, 1000);
        } else {
            timer = false;
            gameOver();
        }
    }
    tick();
}

start.addEventListener("click", function() {
    if (!playing) {
        playing = true;
        displayScore();
        countdown();
        getCells = setInterval(function() {
            highlightCell();
        }, 1500);
    }
});

for (var i = 0; i < cells.length; i++) {
    cells[i].addEventListener("click", function() {
        if (playing) {
            var cell = this;
            if (this.style.background === "green") {
                score++;
                if (score >= 10) {
                    clearInterval(getCells);
                    getCells = setInterval(function() {
                        highlightCell();
                        level = 2;
                        displayScore();
                    }, 1000);
                }

                if (score >= 20) {
                    clearInterval(getCells);
                    getCells = setInterval(function() {
                        highlightCell();
                        level = 3;
                        displayScore();
                    }, 500);
                }
            }
            else {
                lives--;
                gameOver();
            }
            displayScore();
        }
    })
}