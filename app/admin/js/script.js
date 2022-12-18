$(document).ready(function () {
  $("#summernote").summernote({
    height: 200,
  });
});

const checkAllElement = document.querySelector("#checkAll");
const tableBoxElements = document.querySelectorAll(".table-boxes");
checkAllElement.addEventListener("click", function () {
  for (el of tableBoxElements) {
    if (el.checked === true) {
      el.checked = false;
    } else {
      el.checked = true;
    }
  }
});
