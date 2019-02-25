
function filterPlan() {
  cleaner("Plan");
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var Size_Min      = document.getElementById("Plan_Size_Min").value;
  var Size_Max      = document.getElementById("Plan_Size_Max").value;
  var Price_Min     = document.getElementById("Plan_Price_Min").value;
  var Price_Max     = document.getElementById("Plan_Price_Max").value;
  var Bedroom_Min   = document.getElementById("Plan_Bedroom_Min").value;
  var Bedroom_Max   = document.getElementById("Plan_Bedroom_Max").value;
  var Bathroom_Min  = document.getElementById("Plan_Bathroom_Min").value;
  var Bathroom_Max  = document.getElementById("Plan_Bathroom_Max").value;
  var Parking_Min   = document.getElementById("Plan_Parking_Min").value;
  var Parking_Max   = document.getElementById("Plan_Parking_Max").value;
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Plan").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/Customization.php";
  url += "?call=filterPlan";
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
  var msg = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "duplicate") {
        msg = `
          <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
          <span class="sr-only">Close</span>
          </button>
          <h4>Duplicate of Information Detected. </h4>
          <p><a href='javascript:void(0)' class='alert-link' onclick='setFocus(inputName)'>Name</a>: `+name+`</p>
          </div>
        `;
        document.getElementById("msg_Project").innerHTML = msg;
      } else if (this.responseText == "missing") {
        msg = `
          <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
          <span class="sr-only">Close</span>
          </button>
          <h6>
            Project Name missing.
          </h6>
          </div>
        `;
        document.getElementById("msg_Project").innerHTML = msg;
      } else {
        msg = `
          <div class="alert alert-success alert-dismissible" role="alert">
  	      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  	      <span aria-hidden="true">×</span>
  	      <span class="sr-only">Close</span>
  	      </button>
  	      <h6>
  	        Successfully Added New Plan.
  	      </h6>
  	      </div>
        `;
        document.getElementById("msg_Project").innerHTML = msg;

        var action = `
          <a href="customization.php?project=`+this.responseText+`" class="btn btn-next btn-primary"> Select </a>
          <button class="btn btn-primary w-full" onclick="DeleteProject(`+this.responseText+`);"> Delete </button>
        `;
        var table = $('#example').DataTable();
        table.row.add([name,action]).draw();
      }
      // location.reload();
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
      case "Plan":
        document.getElementById("Category").innerHTML = '';
        document.getElementById("Part").innerHTML = '';
        // document.getElementById("Material").innerHTML = '';
        // document.getElementById("Upgrade").innerHTML = '';
        break;
      case "Category":
        document.getElementById("Part").innerHTML = '';
        // document.getElementById("Material").innerHTML = '';
        // document.getElementById("Upgrade").innerHTML = '';
        break;
      case "Room":
        // document.getElementById("Material").innerHTML = '';
        // document.getElementById("Upgrade").innerHTML = '';
        break;
      case "Parts":
        // document.getElementById("Upgrade").innerHTML = '';
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
function selPlan(id) {
  cleaner("Plan");
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Category").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/Customization.php";
  url += "?call=category";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selCategory() {
  cleaner("Category");
  var id = document.getElementById("selcategory").value;
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Part").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/Customization.php";
  url += "?call=part";
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
  console.log(id);
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

function selMaterial(id,pm) {
  cleaner("Material");

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      getItems();
    }
  };
  url = "../Ajax/Customization.php";
  url += "?call=addMaterial";
  url += "&Id=" + id;
  url += "&PartId=" + pm;
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
  url += "?call=addUpgrade";
  url += "&Id=" + id;
  url += "&PartId=" + pm;
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
