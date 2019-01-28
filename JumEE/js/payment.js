function setAppointment(id) {

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
  url += "&Date=" + AppDate;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}
