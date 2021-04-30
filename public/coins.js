


document.addEventListener('DOMContentLoaded', function () {

  var getObject = document.querySelectorAll('#change-ratio');

  console.log(getObject);

  for (i = 0; i < getObject.length; i++) {

    var getPercent = getObject[i].innerText;

    if (parseFloat(getPercent) < 0) {
      getObject[i].style.color = "red";
    } else {
      getObject[i].style.color = "green";
    }

  }


  // your code here
}, false);