$(document).ready(function () {
  // ------ show more table
  $(".history-table #see-more").click(function () {
    $(".history-table .table .hide").css({
      display: "table-row",
    });
  });

  //    -------------------- drop menu box user header
  isOpenDrop = false;
  $("header .user .drop-icon").click(function () {
    if (isOpenDrop) {
      $(this).find(".drop-box").css({
        display: "none",
      });
      isOpenDrop = !isOpenDrop;
    } else {
      $(this).find(".drop-box").css({
        display: "block",
      });
      isOpenDrop = !isOpenDrop;

    }
  });
});
