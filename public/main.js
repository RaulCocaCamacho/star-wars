$(function() {

    $("#main").ready(function(){
        $.ajax({
            url: "http://127.0.0.1:8000/api/v1/get-topics",
            context: this,
            method: 'POST'
        }).done(printTopics);
    })

    let printTopics = (list) => {
        console.log(list)
        var $table = $('<table></table>');
        $.each(list, function(i, item) {
            $table.append($('<tr>').append(
                $('<td>').text(i)
            ));
        });

        $("#main").append($table);
    }

});
