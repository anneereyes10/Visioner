function setAppointment(id) {

  var place = document.getElementById("meetingplace").value;
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var AppDate = document.getElementById("inputAppointmentDate" + id).value;
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("tdPayment" + id).innerHTML = this.responseText;
    }
  };
  url = "../Ajax/payment.php";
  url += "?call=addPayment";
  url += "&Id=" + id;
  url += "&Place_Id=" + place;
  url += "&Date=" + AppDate;
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
