	var todo_grocery = document.getElementById("count_todo_grocery").value;
	var completed_grocery = document.getElementById("count_completed_grocery").value;
	var total_grocery = parseInt(todo_grocery) + parseInt(completed_grocery);
	
	var percentage_grocery = document.getElementById("grocery_percentage");
	var progress_grocery = document.getElementById("grocery_progress");
	document.getElementById("grocery_completed").innerHTML = completed_grocery ;
	document.getElementById("grocery_total").innerHTML = total_grocery;  

	var progressBar_grocery;
	if(total_grocery==0){
		progressBar_grocery = 0;
	}else{
		progressBar_grocery= completed_grocery * (1/total_grocery) * 100;
	}

	percentage_grocery.innerHTML = parseInt(progressBar_grocery) + "%";     
	progress_grocery.style.width = progressBar_grocery + "%";