var chkbx = document.querySelectorAll('[id^="chk_todo_"]');

for(var i = 0; i < chkbx.length; i++) {
  chkbx[i].addEventListener('click', clickChkbx);
}

function clickChkbx(event) {
    var checkedCount = 0;
    var idLastChecked = event.target.id;
//    for(var i = 0; i < chkbx.length; i++) {
//      if(chkbx[i].checked) {
////        checkedCount++;
////        console.log (chkbx[i].value);
//      }
//    }

    var chkbxGrp = document.querySelectorAll('[id^="chk_todo_' + idLastChecked.substr(9, 6) + '"]');
    
//      On compte le nombre de cases cochées pour  une seule ligne todo
    for(var j = 0; j < chkbxGrp.length; j++) {
      if(chkbxGrp[j].checked) {
        checkedCount++;
      }
    }
//    Si il y a plus d'une case de cochée pour une seule ligne todo
    if (checkedCount > 1) {
//    On decoche toutes les cases pour la même ligne todo
        for(var j = 0; j < chkbxGrp.length; j++) {
            chkbxGrp[j].checked = false;
        }   
//    On coche la derniere case chochée pour la même ligne todo
        document.getElementById(idLastChecked).checked = true;
    };

}