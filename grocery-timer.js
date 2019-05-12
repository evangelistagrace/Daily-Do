var start_btn_grocery = document.getElementById("start_grocery");
start_btn_grocery.onclick = start_grocery;
var end_btn_grocery = document.getElementById("end_grocery");
end_btn_grocery.onclick = end_grocery;

var startTime_grocery, endTime_grocery;
var seconds_grocery, minutes_grocery, hours_grocery;

function start_grocery() {
  startTime_grocery = new Date();
  window.localStorage.setItem("startTime_grocery", startTime_grocery);
}

function end_grocery() {
  endTime_grocery = new Date();
  window.localStorage.setItem("endTime_grocery", endTime_grocery);
startTime_grocery = new Date(window.localStorage.getItem("startTime_grocery")); 
endTime_grocery = new Date(window.localStorage.getItem("endTime_grocery"));
  timeDiff_grocery = endTime_grocery - startTime_grocery; //in ms

    
  seconds_grocery = Math.floor(timeDiff_grocery /1000);

  window.localStorage.setItem("seconds_grocery", seconds_grocery);


  document.getElementById("well_grocery").innerHTML = "Elapsed time: " + window.localStorage.getItem("seconds_grocery") + " second(s).";
  
}
document.getElementById("well_grocery").innerHTML = "Elapsed time: " + window.localStorage.getItem("seconds_grocery") + " second(s).";
  