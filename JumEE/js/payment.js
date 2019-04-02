function setAppointment(id,type) {

  let empty = false;
  var place = "";
  var appDate = "";

  if (type == "2") {
    place = document.getElementById("meetingplace"+id).value;
    if (place) {
      $("#meetingplace"+id).removeClass("isError");
    } else {
      empty = true;
      $("#meetingplace"+id).addClass("isError");
    }
  }else{
    place = document.getElementById("meetingplace"+id).value;
    appDate = document.getElementById("inputAppointmentDate" + id).value;
    console.log(place);
    if (place) {
      $("#meetingplace"+id).removeClass("isError");
    } else {
      empty = true;
      $("#meetingplace"+id).addClass("isError");
    }
    if (appDate) {
      $("#inputAppointmentDate"+id).removeClass("isError");
    } else {
      empty = true;
      $("#inputAppointmentDate"+id).addClass("isError");
    }
  }
  if (empty) {
  } else {
    var xmlhttp = new XMLHttpRequest();
    var url = "";
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("tdPayment" + id).innerHTML = this.responseText;
      }
    };
    url = "../Ajax/payment.php";
    url += "?call=addPayment";
    url += "&Id=" + id;
    if (type == "2") {
      url += "&Place_Id=" + place;
    } else {
      url += "&Place_Id=" + place;
      url += "&Date=" + appDate;
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
  }

}
function deletePayment(id) {

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("tdPayment" + id).innerHTML = this.responseText;
      var table = $('#example').DataTable();

      table.rows('#tr'+id).remove().draw();
    }
  };
  url = "../Ajax/payment.php";
  url += "?call=deletePayment";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}
function displayDetail(id){

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("modalContent").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/payment.php";
  url += "?call=displayDetail";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}
