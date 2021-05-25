function fetch_data() {
    $("#adminLogicForm").hide();
    load_data("1");

    function load_data(page) {
        $.ajax({
            url: "../apis/scores.php",
            type: "POST",
            data: { page: page },
            success: function(response) {
                // console.log((response));
                $("#scoresTable").html(response);
            },
        });
    }
    $(document).on("click", ".pg1", function() {
        var page = $(this).attr("id");
        load_data(page);
    });
}
$(document).ready(function() {
    fetch_data();
});

$(document).on("click", ".edit_record", function() {
    var currentRow = $(this).closest("tr");
    var serial_no = currentRow.find("td:eq(0)").text();
    var score = $("input.score_row" + serial_no).val();
    // console.log(score);
    var id = currentRow.find("td:eq(3)").text();
    $.ajax({
        url: "../apis/update_scores.php",
        type: "POST",
        data: { id: id, score: score },
        success: function(response) {
            console.log(response);
            fetch_data();
        },
    });
});
$(document).on("click", ".delete_record", function() {
    var currentRow = $(this).closest("tr");
    var id = currentRow.find("td:eq(3)").text();
    $.ajax({
        url: "../apis/delete_scores.php",
        type: "POST",
        data: { id: id },
        success: function(response) {
            console.log(response);
            fetch_data();
        },
    });
});