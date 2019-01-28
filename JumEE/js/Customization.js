
function filterLayout() {
  cleaner("Layout");
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var Size_Min      = document.getElementById("Layout_Size_Min").value;
  var Size_Max      = document.getElementById("Layout_Size_Max").value;
  var Price_Min     = document.getElementById("Layout_Price_Min").value;
  var Price_Max     = document.getElementById("Layout_Price_Max").value;
  var Bedroom_Min   = document.getElementById("Layout_Bedroom_Min").value;
  var Bedroom_Max   = document.getElementById("Layout_Bedroom_Max").value;
  var Bathroom_Min  = document.getElementById("Layout_Bathroom_Min").value;
  var Bathroom_Max  = document.getElementById("Layout_Bathroom_Max").value;
  var Parking_Min   = document.getElementById("Layout_Parking_Min").value;
  var Parking_Max   = document.getElementById("Layout_Parking_Max").value;
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Layout").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/Customization.php";
  url += "?call=filterLayout";
  url += "&Size_Min="     + Size_Min;
  url += "&Size_Max="     + Size_Max;
  url += "&Price_Min="    + Price_Min;
  url += "&Price_Max="    + Price_Max;
  url += "&Bedroom_Min="  + Bedroom_Min;
  url += "&Bedroom_Max="  + Bedroom_Max;
  url += "&Bathroom_Min=" + Bathroom_Min;
  url += "&Bathroom_Max=" + Bathroom_Max;
  url += "&Parking_Min="  + Parking_Min;
  url += "&Parking_Max="  + Parking_Max;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}
// ADD -------------------------------------------------------- ADD

function addProject() {
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var name = document.getElementById("inputProject_Name").value;
  var dateNow = Date.now();
  var dateOut = new Date(Date.now()).toLocaleString();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // var table = $('#example').DataTable();
      // table.row.add([name,dateOut]).draw();
      // document.getElementById("msg_Project").innerHTML = this.responseText;
      location.reload();
    }
  };
  url = "../Ajax/Customization.php";
  url += "?call=addProject";
  url += "&Name=" + name;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function DeleteProject(ProjectId) {
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    }
  };
  url = "../Ajax/Customization.php";
  url += "?call=Delete";
  url += "&Id=" + ProjectId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function cleaner(name){
  switch(name) {
      case "Layout":
        document.getElementById("Room").innerHTML = '';
        document.getElementById("Parts").innerHTML = '';
        document.getElementById("Material").innerHTML = '';
        document.getElementById("Upgrade").innerHTML = '';
        break;
      case "Floor":
        document.getElementById("Parts").innerHTML = '';
        document.getElementById("Material").innerHTML = '';
        document.getElementById("Upgrade").innerHTML = '';
        break;
      case "Room":
        document.getElementById("Material").innerHTML = '';
        document.getElementById("Upgrade").innerHTML = '';
        break;
      case "Parts":
        document.getElementById("Upgrade").innerHTML = '';
        break;
      default:
        break;
  }
}


// SELECT -------------------------------------------------------- SELECT

function selFinish(Finish_Id,Project_Id) {
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      getItems();
    }
  };
  url = "../Ajax/Customization.php";
  url += "?call=finish";
  url += "&Finish_Id=" + Finish_Id;
  url += "&Project_Id=" + Project_Id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}
function selLayout(id) {
  cleaner("Layout");
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Floor").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/Customization.php";
  url += "?call=floor";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selFloor(id) {
  cleaner("Floor");

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Room").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/Customization.php";
  url += "?call=room";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selRoom(id) {
  cleaner("Room");

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Parts").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/Customization.php";
  url += "?call=parts";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selParts(id) {
  cleaner("Parts");

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Material").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/Customization.php";
  url += "?call=material";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selMaterial(id,rp) {
  cleaner("Material");

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Upgrade").innerHTML = this.responseText;
      getItems();
    }
  };
  url = "../Ajax/Customization.php";
  url += "?call=upgrade";
  url += "&Id=" + id;
  url += "&rp=" + rp;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selUpgrade(id,pm) {
  cleaner("Upgrade");

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    getItems();
  };
  url = "../Ajax/Customization.php";
  url += "?call=upgradeselect";
  url += "&Id=" + id;
  url += "&PartMaterial_Id=" + pm;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function getItems(){
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("projectlist").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/Customization.php";
  url += "?call=projectItem";
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}
