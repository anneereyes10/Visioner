function setAppointment(id,type) {

  var place = "";
  var appDate = "";
  
  if (type == "2") {
    place = document.getElementById("meetingplace"+id).value;
  }else{
    place = document.getElementById("meetingplace"+id).value;
    appDate = document.getElementById("inputAppointmentDate" + id).value;
  }
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
