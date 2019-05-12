var start_btn_fitness = document.getElementById("start_fitness");
start_btn_fitness.onclick = start_fitness;
var end_btn_fitness = document.getElementById("end_fitness");
end_btn_fitness.onclick = end_fitness;

var startTime_fitness, endTime_fitness;
var seconds_fitness, minutes_fitness, hours_fitness;

function start_fitness() {
  startTime_fitness = new Date();
  window.localStorage.setItem("startTime_fitness", startTime_fitness);
}

function end_fitness() {
  endTime_fitness = new Date();
  window.localStorage.setItem("endTime_fitness", endTime_fitness);
startTime_fitness = new Date(window.localStorage.getItem("startTime_fitness")); 
endTime_fitness = new Date(window.localStorage.getItem("endTime_fitness"));
  timeDiff_fitness = endTime_fitness - startTime_fitness; //in ms

    
  seconds_fitness = Math.floor(timeDiff_fitness /1000);

  window.localStorage.setItem("seconds_fitness", seconds_fitness);


  document.getElementById("well_fitness").innerHTML =  "Elapsed time: " + window.localStorage.getItem("seconds_fitness") + " second(s).";
  
}
document.getElementById("well_fitness").innerHTML = "Elapsed time: " + window.localStorage.getItem("seconds_fitness") + " second(s).";
  