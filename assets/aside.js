$(".profile-icon").on("click", function () {
    $.ajax({
        url : "/profile",
        type : 'GET',
        dataType : 'html',
        success : function(response) {
            $(".aside-web").html(response);
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
        complete : function () {
            $(".aside-web").show();
        }
    }); 
})