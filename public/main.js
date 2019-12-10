$(function () {

    $("#main").ready(function () {
        $.ajax({
            url: "http://127.0.0.1:8000/api/v1/get-topics",
            context: this,
            method: 'POST'
        }).done(printTopics);
    });

    let printTopics = (list) => {
        var $table = $('.topics table');
        $.each(list, function (i, item) {
            var tr = $('<tr>');
            var td = $('<td>');
            $table.append(tr);
            var topic = $('<input>').attr("class", 'topic').attr("type", 'button').val(i);
            var a = $('<a>').attr("href", item).attr('target', '_blank').text(item)
            tr.append(td).append(topic)
            tr.append(td).append(a)
        });
        $(".spinner").hide()
        $(".topics").append($table);

    };

    $('.topics table').on('click', 'input', function (event) {
        console.log('event', event)
        console.log('value', this.value)

        $(".spinner").show()
        $.ajax({
            url: "http://127.0.0.1:8000/api/v1/get-list/" +  this.value,
            context: this,
            method: 'POST'
        }).done(printList);
    });

    var printList =  (list) => {
        console.log(list)
        var table = arrayToTable(list, {
            thead: true,
            attrs: {class: 'table'}
        });
        $('.list').html('')
        $(".spinner").hide()
        $('.list').append(table);
    }

    var arrayToTable = function(data, options = {}){
        var table = $('<table />'),
            thead,
            tfoot,
            rows = [],
            row,
            i, j,
            defaults = {
                th: true, // should we use th elemenst for the first row
                thead: false, //should we incldue a thead element with the first row
                tfoot: false, // should we include a tfoot element with the last row
                attrs: {} // attributes for the table element, can be used to
            }

        options = $.extend(defaults, options);

        table.attr(options.attrs)

        // loop through all the rows, we will deal with tfoot and thead later
        for(i = 0; i < data.length; i++){
            row = $('<tr />');
            if(i == 0){
                data.forEach(
                    (item)=> {
                        Object.keys(item).forEach(
                            (att)=> {
                                row.append($('<th />').html(att));
                            }
                        )
                    }
                )
            }
            data.forEach(
                (item)=> {
                    Object.keys(item).forEach(
                        (att)=> {
                            row.append($('<th />').html(data[i][att]));
                        }
                    )
                }
            )
            rows.push(row);
        }

        // if we want a thead use shift to get it
        if(options.thead){
            thead = rows.shift();
            thead = $('<thead />').append(thead);
            table.append(thead);
        }

        // if we want a tfoot then pop it off for later use
        if(options.tfoot){
            tfoot = rows.pop();
        }

        // add all the rows
        for (i = 0; i < rows.length; i++) {
            table.append(rows[i]);
        };

        // and finally add the footer if needed
        if(options.tfoot){
            tfoot = $('<tfoot />').append(tfoot);
            table.append(tfoot);
        }
        return table;
    }
});


