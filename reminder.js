function displayReminders(){
    var items=document.getElementsByName('reminder');
    if(items.length>0){
      var reminderItems="Reminder(s):" + "\n";
      for(var i=0; i<items.length; i++){
        if(items[i].type=='checkbox' && items[i].checked==true)
        reminderItems+=items[i].value+"\n";
      }
      alert(reminderItems);
    }
    testing
  }