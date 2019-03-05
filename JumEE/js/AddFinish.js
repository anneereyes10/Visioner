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
        document.getElementById("Plan").innerHTML = '';
        document.getElementById("Category").innerHTML = '';
        document.getElementById("Part").innerHTML = '';
        document.getElementById("Material").innerHTML = '';
          break;
      case "Plan":
        document.getElementById("Category").innerHTML = '';
        document.getElementById("Part").innerHTML = '';
        document.getElementById("Material").innerHTML = '';
          break;
      case "Category":
        document.getElementById("Part").innerHTML = '';
        document.getElementById("Material").innerHTML = '';
          break;
      case "Part":
        document.getElementById("Material").innerHTML = '';
          break;
  }
}
function highlight_item(name){
  var plan = document.getElementById(name);
  plan.classList.remove("bg-light");
  plan.classList.add("text-white");
  plan.classList.add("bg-info");
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
      document.getElementById("Plan").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=plan";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selPlan(id) {
  cleaner("Plan");
  highlight_item("Plan_"+id);

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Category").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=category";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selCategory(id) {
  cleaner("Category");
  highlight_item("Category_"+id);

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Part").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=part";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selPart(id) {
  cleaner("Part");
  highlight_item("Part_"+id);

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // document.getElementById("Material").innerHTML = this.responseText;
      displayMaterial(id);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=material";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}
function displayMaterial(id){
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
function displayUpgrade(id){
    var xmlhttp = new XMLHttpRequest();
    var url = "";
    var btn = "";
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("Upgrade").innerHTML = this.responseText;
        console.log(this.responseText);
      }
    };
    url = "../Ajax/AddFinish.php";
    url += "?call=upgrade";
    url += "&Id=" + id;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
function selMaterial(id) {
  cleaner("Material");
  highlight_item("Material_"+id);

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // document.getElementById("Upgrade").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=selectMaterial";
  url += "&Id=" + id;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

}

function selUpgrade(id) {
  cleaner("Upgrade");
  highlight_item("Upgrade_"+id);

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {};
  url = "../Ajax/AddFinish.php";
  url += "?call=selectUpgrade";
  url += "&Id=" + id;
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

function addCategory(PlanId,CategoryId) {
  cleaner("Plan");
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Category").innerHTML = this.responseText;
      showCategory(PlanId);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=addcategory";
  url += "&PlanId=" + PlanId;
  url += "&CategoryId=" + CategoryId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function addRoom(PlanCategoryId,RoomId) {
  cleaner("Category");
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Room").innerHTML = this.responseText;
      showRoom(PlanCategoryId);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=addroom";
  url += "&PlanCategoryId=" + PlanCategoryId;
  url += "&RoomId=" + RoomId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function addPart(CategoryRoomId,PartId) {
  cleaner("Room");
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Part").innerHTML = this.responseText;
      showPart(CategoryRoomId);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=addparts";
  url += "&CategoryRoomId=" + CategoryRoomId;
  url += "&PartId=" + PartId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function addMaterial(RoomPartId,MaterialId) {
  cleaner("Part");
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

function deleteCategory(PlanCategoryId,PlanId) {
  cleaner("Plan");

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Category").innerHTML = this.responseText;
      showCategory(PlanId);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=deletecategory";
  url += "&PlanCategoryId=" + PlanCategoryId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function deleteRoom(CategoryRoomId,PlanCategoryId) {
  cleaner("Category");

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Room").innerHTML = this.responseText;
      showRoom(PlanCategoryId);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=deleteroom";
  url += "&CategoryRoomId=" + CategoryRoomId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function deletePart(RoomPartId,CategoryRoomId) {
  cleaner("Room");

  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Part").innerHTML = this.responseText;
      showPart(CategoryRoomId);
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=deleteparts";
  url += "&RoomPartId=" + RoomPartId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function deleteMaterial(PartMaterialId,RoomPartId) {
  cleaner("Part");

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

function showCategory(PlanId) {
  var xmlhttp = new XMLHttpRequest();
  var url = "";
  var btn = "";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("modalContent").innerHTML = this.responseText;
    }
  };
  url = "../Ajax/AddFinish.php";
  url += "?call=showcategory";
  url += "&Id=" + PlanId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function showRoom(PlanCategoryId) {
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
  url += "&Id=" + PlanCategoryId;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}

function showPart(CategoryRoomId) {
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
  url += "&Id=" + CategoryRoomId;
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
