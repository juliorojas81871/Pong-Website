<?php
session_start();
include '../apis/db.php';
?>
<!DOCTYPE html>
<html>

<head>

    <title>
        Game | IT
    </title>

    <meta content="width=device-width, initial-scale=.0" name="viewport">
    <!-- Bootstrap CSS File -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../lib/sweetalert/sweetalert.min.css" rel="stylesheet">
    <!-- Custom css -->
    <link href="../css/styles.css" rel="stylesheet">
</head>
<script>
//modified from http://jsfiddle.net/bencentra/q1s8gmqv/?utm_source=website&utm_medium=embed&utm_campaign=q1s8gmqv

var canvas;
var context;
var loop;
var leftPaddle;
var rightPaddle;
var ball;
var paddleWidth = 25;
var paddleHeight = 100;
var ballSize = 10;
var ballSpeed = 2;
var paddleSpeed = 2;
var drawables = [];
var timer = 30; //30 seconds
var reward = 1;
// Key Codes
const W = 87;
const S = 83;
const UP = 38;
const DOWN = 40;
let vision = .6;
let didSend = false;
<?php
if(isset($_SESSION['logged_in']))
{
    $username = $_SESSION['username'];
    $user_level = mysqli_query($con, "SELECT level FROM users WHERE username='".$username."'");
    if($user_level)
    {
        $row = mysqli_fetch_array($user_level);
        $level = $row['level'];
        $variable_query = mysqli_query($con, "SELECT * FROM admin_logic WHERE level = '".$level."'");
        if($variable_query)
        {
            $variable_row = mysqli_fetch_array($variable_query);
            echo 'var reward= parseInt("'.$variable_row['reward_pts'].'");var ballSpeed="'.$variable_row['speed'].'"; var timer="'.$variable_row['duration'].'";';
        }
    }
}
?>
// Keep track of pressed keys
var keys = {
    W: false,
    S: false,
    UP: false,
    DOWN: false
};

// Keep track of the score
var leftScore = 0;
var rightScore = 0;

function start() {
    didSend = false;
    leftPaddle = makeRect(25, canvas.height / 2 - paddleHeight / 2, paddleWidth, paddleHeight, paddleSpeed, '#BC0000');
    rightPaddle = makeRect(canvas.width - paddleWidth - 25, canvas.height / 2 - paddleHeight / 2, paddleWidth,
        paddleHeight, paddleSpeed, '#0000BC');
    ball = makeRect(0, 0, ballSize, ballSize, ballSpeed, '#000000');
    drawables.push(leftPaddle);
    drawables.push(rightPaddle);
    drawables.push(ball);
    console.log(drawables);
    resetBall();
    attachKeyListeners();
    loop = window.setInterval(gameLoop, 16); //16ms
    canvas.focus();
}

function init() {
    canvas = document.getElementById("board");
    if (canvas.getContext) {
        context = canvas.getContext("2d");
        $.get("../apis/get_settings.php", (data, status) => {
            console.log(data);
            let resp = JSON.parse(data);
            paddleHeight = resp.data.paddleHeight;
            paddleWidth = resp.data.paddleWidth;
            ballSize = resp.data.ballSize;
            ballSpeed = resp.data.ballSpeed;
            paddleSpeed = resp.data.paddleSpeed;
            start();
        });

    }
}

function resetBall() {
    ball.x = canvas.width / 2 - ball.w / 2;
    ball.y = canvas.height / 2 - ball.w / 2;
    // Modify the ball object to have two speed properties, one for X and one for Y
    ball.sX = ballSpeed;
    ball.sY = ballSpeed / 2;

    // Randomize initial direction
    if (Math.random() > 0.5) {
        ball.sX *= -1;
    }
    // Randomize initial direction
    if (Math.random() > 0.5) {
        ball.sY *= -1;
    }
}
// Bounce the ball off of a paddle
function bounceBall() {
    // Increase and reverse the X speed
    if (ball.sX > 0) {
        ball.sX += 1;
        // Add some "spin"
        if (keys.UP) {
            ball.sY -= 1;
        } else if (keys.DOWN) {
            ball.sY += 1;
        }
    } else {
        ball.sX -= 1;
        // Add some "spin"
        if (keys.W) {
            ball.sY -= 1;
        } else if (keys.S) {
            ball.sY += 1
        }
    }
    ball.sX *= -1;
}

function attachKeyListeners() {
    // Listen for keydown events
    window.addEventListener('keydown', function(e) {
        // console.log("keydown", e);
        if (e.keyCode === W) {
            keys.W = true;
        }
        if (e.keyCode === S) {
            keys.S = true;
        }
        if (e.keyCode === UP) {
            keys.UP = true;
        }
        if (e.keyCode === DOWN) {
            keys.DOWN = true;
        }
        console.log(keys);
    });
    window.addEventListener('keyup', function(e) {
        //console.log("keyup", e);
        if (e.keyCode === W) {
            keys.W = false;
        }
        if (e.keyCode === S) {
            keys.S = false;
        }
        if (e.keyCode === UP) {
            keys.UP = false;
        }
        if (e.keyCode === DOWN) {
            keys.DOWN = false;
        }
        console.log(keys);
    });
}
// Create a rectangle object - for paddles, ball, etc
function makeRect(x, y, width, height, speed, color) {
    if (!color)
        color = '#000000';
    return {
        x: x,
        y: y,
        w: width,
        h: height,
        s: speed,
        c: color,
        draw: function() {
            context.fillStyle = this.c;
            context.fillRect(this.x, this.y, this.w, this.h);
        }
    };
}

function doAI() {
    // rightPaddle.y = ball.y;//perfect AI
    vision = .6;
    let diff = leftScore - rightScore;
    if (diff < 0) {
        vision -= .1 * diff;
    }
    if (diff > 0) {
        vision -= .1 * diff;
    }
    if (ball.x >= canvas.width * vision) {

        let paddleHalf = paddleHeight / 2;
        if (ball.y > rightPaddle.y + paddleHalf) {
            rightPaddle.y += rightPaddle.s;
        } else if (ball.y < rightPaddle.y) {
            rightPaddle.y -= rightPaddle.s;
        }
    }
    clampToCanvas(rightPaddle);
}

function movePaddle() {
    if (keys.W) {
        leftPaddle.y -= leftPaddle.s;
    }
    if (keys.S) {
        leftPaddle.y += leftPaddle.s;
    }
    if (keys.UP) {
        leftPaddle.y -= leftPaddle.s;
    }
    if (keys.DOWN) {
        leftPaddle.y += leftPaddle.s;
    }
    clampToCanvas(leftPaddle);
}

function clampToCanvas(paddle) {
    if (paddle.y < 0) {
        paddle.y = 0;
    }
    if (paddle.y + paddle.h > canvas.height) {
        paddle.y = canvas.height - paddle.h;
    }
}

function moveBall() {
    // Move the ball
    ball.x += ball.sX;
    ball.y += ball.sY;
    // Bounce the ball off the top/bottom
    if (ball.y < 0 || ball.y + ball.h > canvas.height) {
        ball.sY *= -1;
    }
}

function checkPaddleCollision() {
    // Bounce the ball off the paddles
    if (ball.y + ball.h / 2 >= leftPaddle.y && ball.y + ball.h / 2 <= leftPaddle.y + leftPaddle.h) {
        if (ball.x <= leftPaddle.x + leftPaddle.w) {
            bounceBall();
        }
    }
    if (ball.y + ball.h / 2 >= rightPaddle.y && ball.y + ball.h / 2 <= rightPaddle.y + rightPaddle.h) {
        if (ball.x + ball.w >= rightPaddle.x) {
            bounceBall();
        }
    }
}

function checkScore() {
    // Score if the ball goes past a paddle
    if (ball.x < leftPaddle.x) {
        rightScore += reward;
        resetBall();
        ball.sX *= -1;
    } else if (ball.x + ball.w > rightPaddle.x + rightPaddle.w) {
        leftScore += reward;
        resetBall();
        ball.sX *= -1;
    }
}

function drawScores() {
    // Draw the scores
    context.fillStyle = '#000000';
    context.font = '24px Arial';
    context.textAlign = 'left';
    context.fillText('Score: ' + leftScore, 5, 24);
    context.textAlign = 'right';
    context.fillText('Score: ' + rightScore, canvas.width - 5, 24);
    context.fillText('Timer: ' + timer, 300, 24);


    context.fillText("Vision: " + vision, 200, 50);
}

function erase() {
    context.fillStyle = '#FFFFFF';
    context.fillRect(0, 0, canvas.width, canvas.height);
}

function gameLoop() {
    erase();
    movePaddle();
    doAI();
    moveBall();

    checkPaddleCollision();
    checkScore();
    drawScores();
    //draw stuff
    for (let i = 0; i < drawables.length; i++) {
        drawables[i].draw();
    }
    if (timer == 0) {
        saveScore();
    }
}

function start_timer() {
    setTimeout(function() {
        timer--;
        start_timer();
    }, 1000);
}

function saveScore() {
    if (!didSend) { //mutex boolean to block multiple calls from sending repeated data
        didSend = true;
        window.clearInterval(loop);
        $.ajax({
            url: "../apis/save_score.php",
            data: {
                score: leftScore
            },
            type: "POST",
            success: function(response) {
                swal("Score saved!", "Check them in profile page", "success").then((value) => {
                    location.reload();
                });
            }
        });


    }
}
</script>
<script src=" ../lib/jquery/jquery.min.js">
</script>
<script src="../lib/jquery/jquery-migrate.min.js"></script>
<script src="../lib/jquery/jquery.js"></script>
<script src="../lib/popper/popper.min.js"></script>
<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
<script src="../lib/sweetalert/sweetalert.min.js"></script>

<body>

    <?php 
    require("nav.php");
    if(!isset($_SESSION["username"])){echo 'Scores will not be saved until you login:  <button type="button" data-toggle="modal"
        data-target="#loginModal">Login here</button><br>';}?>
    <div class="modal fade" id="loginModal" tabindex="-" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="userID">User ID</label>
                            <input type="text" class="form-control" id="userID" placeholder="Username or email">
                            <span class="text-danger font-weight-bold usernameAlert emailAlert userIDAlert">
                                <!-- alerts innerHTML goes here -->
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="loginPassword">Password</label>
                            <input type="password" class="form-control" id="loginPassword" placeholder="Password">
                            <span class="text-danger font-weight-bold passwordAlert">
                                <!-- alerts innerHTML goes here -->
                            </span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modal-close">Close</button>
                    <button type="submit" id="loginSubmit" class="btn btn-primary">Login</button>
                </div>
            </div>
        </div>
    </div>
    <a href="http://bencentra.com/2017-07-11-basic-html5-canvas-games.html">Collection of Canvas based games by Ben
        Centra</a>
    <main>
        <canvas id="board" width="600px" height="600px" style="border: 1px solid black;">

        </canvas>
        <button type="button" id="startGameBtn" class="btn btn-primary">Start Game</button>
        <button type="button" id="endGameBtn" class="btn btn-primary">End Game</button>
    </main>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script> -->

    <script src="../js/validate.js"></script>
    <script src="../js/login.js"></script>
    <script src="../js/logout.js"></script>
    <script>
    $(document).ready(function() {
        $("#board").hide();
        $("#endGameBtn").hide();
    });
    $("#startGameBtn").click(function(event) {
        $("#board").show();
        init();
        $("#endGameBtn").show();
        $("#startGameBtn").hide();
        start_timer();
    });
    $("#endGameBtn").click(function(event) {
        location.reload();
        // window.clearInterval(loop);
        // erase();
        $("#board").hide();
        $("#endGameBtn").hide();
        $("#startGameBtn").show();

    });
    </script>
</body>

</html>