var start_btn_chore = document.getElementById("start_chore");
start_btn_chore.onclick = start_chore;
var end_btn_chore = document.getElementById("end_chore");
end_btn_chore.onclick = end_chore;

var startTime_chore, endTime_chore;
var seconds_chore, minutes_chore, hours_chore;

function start_chore() {
  startTime_chore = new Date();
  window.localStorage.setItem("startTime_chore", startTime_chore);
}

function end_chore() {
  endTime_chore = new Date();
  window.localStorage.setItem("endTime_chore", endTime_chore);
startTime_chore = new Date(window.localStorage.getItem("startTime_chore")); 
endTime_chore = new Date(window.localStorage.getItem("endTime_chore"));
  timeDiff_chore = endTime_chore - startTime_chore; //in ms

    
  seconds_chore = Math.floor(timeDiff_chore /1000);

  window.localStorage.setItem("seconds_chore", seconds_chore);


  document.getElementById("well_chore").innerHTML =  "Elapsed time: " + window.localStorage.getItem("seconds_chore") + " second(s).";
  
}
document.getElementById("well_chore").innerHTML = "Elapsed time: " + window.localStorage.getItem("seconds_chore") + " second(s).";
  