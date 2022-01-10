window.onload = function () {
    $.ajax({
        url : "new",
        type : 'GET',
        dataType : 'html',
        success : function(response) {
            $("#embed").html(response);
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

                console.log(response);
                $('#table_id').DataTable({
                    data: response,
                    columns: [
                        { data: 'name' },
                        { data: 'translation' },
                        { data: 'searches'}
                    ]
                })
            },
            error : function(xhr, status) {
                console.log(xhr.error);
                alert('Disculpe, existió un problema');
            }
        });
    }
}
