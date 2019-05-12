
	var todo_payment = document.getElementById("count_todo_payment").value;
	var completed_payment = document.getElementById("count_completed_payment").value;
	var total_payment = parseInt(todo_payment) + parseInt(completed_payment);
	
	var percentage_payment = document.getElementById("payment_percentage");
	var progress_payment = document.getElementById("payment_progress");
	document.getElementById("payment_completed").innerHTML = completed_payment ;
	document.getElementById("payment_total").innerHTML = total_payment;  

	var progressBar_payment;
	if(total_payment==0){
		progressBar_payment = 0;
	}else{
		progressBar_payment= completed_payment * (1/total_payment) * 100;
	}
	percentage_payment.innerHTML = parseInt(progressBar_payment) + "%";     
	progress_payment.style.width = progressBar_payment + "%";

  