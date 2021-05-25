$(document).ready(function() {
    $("#adminLogicForm").hide();
    load_data("0");

    function load_data(page) {
        $.ajax({
            url: "../apis/admin_table.php",
            type: "POST",
            data: { page: page },
            success: function(response) {
                // console.log((response));
                $("#adminTable").html(response);
            },
        });
    }
    $(document).on("click", ".pg1", function() {
        var page = $(this).attr("id");
        load_data(page);
    });
});

$("#addNew").click(function() {
    $("#adminLogicForm").show();
    $("#addNew").hide();
});

$("#closeForm").click(function() {
    $("#adminLogicForm").hide();
    $("#addNew").show();
});
$("#addForm").click(function(event) {
    event.preventDefault();
    var reward = $("#reward").val();
    var speed = $("#speed").val();
    var duration = $("#duration").val();
    var difficulty = $("#difficulty").val();
    if (!isNaN(reward) &&
        $.isNumeric(speed) &&
        $.isNumeric(duration) &&
        $.isNumeric(difficulty)
    ) {
        var fd = new FormData();
        fd.append("reward", reward);
        fd.append("speed", speed);
        fd.append("duration", duration);
        fd.append("difficulty", difficulty);
        $.ajax({
            url: "../apis/submit_logic.php",
            data: fd,
            type: "POST",
            contentType: false,
            processData: false,
            success: function(response) {
                // console.log(response);
                var res = JSON.parse(response);
                if (res.status == "success") {
                    swal("Level Added", "", "success").then((value) => {
                        $("#closeForm").click();
                        location.reload();
                    });
                } else {
                    swal(res.message, "", "error");
                }
            },
        });
    } else {
        console.log("validation failed");
    }
});

$(document).on("click", ".edit_logic", function() {
    // event.stopPropagation();
    // event.stopImmediatePropagation();
    var currentRow = $(this).closest("tr");
    var reward = currentRow.find("td:eq(1)").text();
    var speed = currentRow.find("td:eq(2)").text();
    var duration = currentRow.find("td:eq(3)").text();
    var level = currentRow.find("td:eq(4)").text();
    $("#adminLogicForm").show();
    $("#reward").val(reward);
    $("#speed").val(speed);
    $("#duration").val(duration);
    $("#difficulty").val(level);
});