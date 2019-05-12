	var todo_chore = document.getElementById("count_todo_chore").value;
	var completed_chore = document.getElementById("count_completed_chore").value;
	var total_chore = parseInt(todo_chore) + parseInt(completed_chore);
	
	var percentage_chore = document.getElementById("chore_percentage");
	var progress_chore = document.getElementById("chore_progress");
	document.getElementById("chore_completed").innerHTML = completed_chore ;
	document.getElementById("chore_total").innerHTML = total_chore;  

	var progressBar_chore;
	if(total_chore==0){
		progressBar_chore = 0;
	}else{
		progressBar_chore= completed_chore * (1/total_chore) * 100;
	}
	percentage_chore.innerHTML = parseInt(progressBar_chore) + "%";     
	progress_chore.style.width = progressBar_chore + "%";