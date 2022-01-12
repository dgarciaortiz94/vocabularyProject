$(".profile-icon").on("click", function () {
    openAside("/profile", "GET");
})

$(".logo").on("click", function () {
})

function openAside(path, method) {
    $.ajax({
      url: path,
      type: method,
      dataType: 'html',
      success: function success(response) {
        $(".aside-body").html(response);
      },
      error: function error(xhr, status) {
        $(".aside-body").html("<p>Disculpe, existió un problema</p>");
      },
      complete: function complete() {
        $(".aside-web").show();
      }
    });
}