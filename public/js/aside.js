function openAside(path, method) {
  $(".aside-web").addClass("loading");
  $(".aside-web").show();

  $.ajax({
    url: path,
    type: method,
    dataType: 'html',
    success: function success(response) {
      $(".aside-body").html(response);

      loadProfileOptions();
    },
    error: function error(xhr, status) {
      $(".aside-body").html("<p>Disculpe, existió un problema</p>");
    },
    complete: function complete() {
      $(".aside-web").removeClass("loading");
    }
  });
}

$(".close-icon").on("click", function () {
  $(".aside-web").hide();
})

function loadProfileOptions() {
  let url = "";

  $(".menu-profile-item").on("click", function (e) {
      if (url = $(this).data("url")) {
          e.preventDefault();

          $(".aside-web").addClass("loading");

          $.ajax({
              url: $(this).data("url"),
              type: "GET",
              dataType: 'html',
              success: function success(response) {
                  $(".menu-profile").html(response);
              },
              error: function error(xhr, status) {
                $(".aside-body").html("<p>Disculpe, existió un problema</p>");
              },
              complete: function complete() {
                $(".aside-web").removeClass("loading");
              }
            });
      }
  })
}