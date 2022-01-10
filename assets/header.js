window.onload = function () {
    $.ajax({
        url : "/expression/new",
        type : 'GET',
        dataType : 'html',
        success : function(response) {
            $("#expression-form").html(response);
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
    }); 

    $.ajax({
        url : "/login",
        type : 'GET',
        dataType : 'html',
        success : function(response) {
            $("#login-form").html(response);
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        }
    }); 
    
    getData();

    function getData() {
        $.ajax({
            url : "getAllExpressions",
            type : 'GET',
            dataType : 'json',
            success : function(response) {
                let cont = 0;
                $('#table_id').DataTable({
                    data: response,
                    columns: [
                        {
                            render: function ( data, type, row ) {
                                return "<b>" + (cont += 1) + "</b>";
                            }
                        },
                        { data: 'name' },
                        { data: 'translation' },
                        { data: 'searches'}
                    ],
                    "order": [[ 3, "desc" ]]
                })
            },
            error : function(xhr, status) {
                console.log(xhr.error);
                alert('Disculpe, existió un problema');
            }
        });
    }
}
