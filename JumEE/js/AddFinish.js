function cleaner(name){
  var parent = document.getElementById(name).children;
  for (var i = 0; i < parent.length; i++) {
    var child = parent[i].children[0];
    child.classList.remove('text-white');
    child.classList.remove('bg-info');
    child.classList.add('bg-light');
  }
  switch(name) {
      case "Finish":
        document.getElementById("Floor").innerHTML = '';
        document.getElementById("Room").innerHTML = '';
        document.getElementById("Parts").innerHTML = '';
        document.getElementById("Material").innerHTML = '';
        document.getElementById("Upgrade").innerHTML = '';
          break;
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
  }
}
function highlight_item(name){
  var layout = document.getElementById(name);
  layout.classList.remove("bg-light");
  layout.classList.add("text-white");
  layout.classList.add("bg-info");
}

// SELECT -------------------------------------------------------- SELECT

function selFinish(id) {
  cleaner("Finish");
  highlight_item("Finish_"+id);

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Layout").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=layout";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selLayout(id) {
  cleaner("Layout");
  highlight_item("Layout_"+id);

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Floor").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=floor";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selFloor(id) {
  cleaner("Floor");
  highlight_item("LayoutFloor_"+id);

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Room").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=room";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selRoom(id) {
  cleaner("Room");
  highlight_item("FloorRoom_"+id);

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Parts").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=parts";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selParts(id) {
  cleaner("Parts");
  highlight_item("RoomPart_"+id);

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Material").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=material";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selMaterial(id,rp) {
  cleaner("Material");
  highlight_item("PartMaterial_"+id);

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Upgrade").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=upgrade";
  url += "&Id=" + id;
  url += "&RoomPart_Id=" + rp;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selUpgrade(id,pm) {
  cleaner("Upgrade");
  highlight_item("MaterialUpgrade_"+id);

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {};
  url = "../Ajax/AddFinish.php";
  url += "?call=upgradeselect";
  url += "&Id=" + id;
  url += "&PartMaterial_Id=" + pm;
  url += "&empty=false";
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selUpgradeE(id,pm) {
  cleaner("Upgrade");
  highlight_item("MaterialUpgrade_"+id);

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {};
  url = "../Ajax/AddFinish.php";
  url += "?call=upgradeselect";
  url += "&Id=" + id;
  url += "&PartMaterial_Id=" + pm;
  url += "&empty=true";
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}


// ADD -------------------------------------------------------- ADD

function addFloor(LayoutId,FloorId) {
  cleaner("Layout");
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Floor").innerHTML = this.responseText;
      showFloor(LayoutId);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=addfloor";
  url += "&LayoutId=" + LayoutId;
  url += "&FloorId=" + FloorId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function addRoom(LayoutFloorId,RoomId) {
  cleaner("Floor");
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Room").innerHTML = this.responseText;
      showRoom(LayoutFloorId);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=addroom";
  url += "&LayoutFloorId=" + LayoutFloorId;
  url += "&RoomId=" + RoomId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function addParts(FloorRoomId,PartsId) {
  cleaner("Room");
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Parts").innerHTML = this.responseText;
      showPart(FloorRoomId);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=addparts";
  url += "&FloorRoomId=" + FloorRoomId;
  url += "&PartsId=" + PartsId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function addMaterial(RoomPartId,MaterialId) {
  cleaner("Parts");
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Material").innerHTML = this.responseText;
      showMaterial(RoomPartId);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=addmaterial";
  url += "&RoomPartId=" + RoomPartId;
  url += "&MaterialId=" + MaterialId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function addUpgrade(PartMaterialId,UpgradeId) {
  cleaner("Material");
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Upgrade").innerHTML = this.responseText;
      showUpgrade(PartMaterialId);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=addupgrade";
  url += "&PartMaterialId=" + PartMaterialId;
  url += "&UpgradeId=" + UpgradeId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}


// DELETE -------------------------------------------------------- DELETE

function deleteFloor(LayoutFloorId,LayoutId) {
  cleaner("Layout");

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Floor").innerHTML = this.responseText;
      showFloor(LayoutId);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=deletefloor";
  url += "&LayoutFloorId=" + LayoutFloorId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function deleteRoom(FloorRoomId,LayoutFloorId) {
  cleaner("Floor");

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Room").innerHTML = this.responseText;
      showRoom(LayoutFloorId);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=deleteroom";
  url += "&FloorRoomId=" + FloorRoomId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function deleteParts(RoomPartId,FloorRoomId) {
  cleaner("Room");

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Parts").innerHTML = this.responseText;
      showPart(FloorRoomId);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=deleteparts";
  url += "&RoomPartId=" + RoomPartId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function deleteMaterial(PartMaterialId,RoomPartId) {
  cleaner("Parts");

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Material").innerHTML = this.responseText;
      showMaterial(RoomPartId);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=deletematerial";
  url += "&PartMaterialId=" + PartMaterialId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function deleteUpgrade(MaterialUpgradeId,PartMaterialId) {
  cleaner("Material");

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Upgrade").innerHTML = this.responseText;
      showUpgrade(PartMaterialId);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=deleteupgrade";
  url += "&MaterialUpgradeId=" + MaterialUpgradeId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}


// SHOW -------------------------------------------------------- SHOW

function showFloor(LayoutId) {
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("modalContent").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=showfloor";
  url += "&Id=" + LayoutId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function showRoom(LayoutFloorId) {
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("modalContent").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=showroom";
  url += "&Id=" + LayoutFloorId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function showPart(FloorRoomId) {
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("modalContent").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=showpart";
  url += "&Id=" + FloorRoomId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function showMaterial(RoomPartId) {
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("modalContent").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=showmaterial";
  url += "&Id=" + RoomPartId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function showUpgrade(PartMaterialId) {
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("modalContent").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=showupgrade";
  url += "&Id=" + PartMaterialId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}
