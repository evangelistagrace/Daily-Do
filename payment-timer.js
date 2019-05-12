
var start_btn_payment = document.getElementById("start_payment");
start_btn_payment.onclick = start_payment;
var end_btn_payment = document.getElementById("end_payment");
end_btn_payment.onclick = end_payment;

var startTime_payment, endTime_payment;
var seconds_payment, minutes_payment, hours_payment;

function start_payment() {
startTime_payment = new Date();
window.localStorage.setItem("startTime_payment", startTime_payment);
}

function end_payment() {
endTime_payment = new Date();
window.localStorage.setItem("endTime_payment", endTime_payment);
startTime_payment = new Date(window.localStorage.getItem("startTime_payment")); 
endTime_payment = new Date(window.localStorage.getItem("endTime_payment"));
timeDiff_payment = endTime_payment - startTime_payment; //in ms

    
seconds_payment = Math.floor(timeDiff_payment /1000);

window.localStorage.setItem("seconds_payment", seconds_payment);


document.getElementById("well_payment").innerHTML =  "Elapsed time: " + window.localStorage.getItem("seconds_payment") + " second(s).";

}
document.getElementById("well_payment").innerHTML = "Elapsed time: " + window.localStorage.getItem("seconds_payment") + " second(s).";
