	var todo_fitness = document.getElementById("count_todo_fitness").value;
	var completed_fitness = document.getElementById("count_completed_fitness").value;
	var total_fitness = parseInt(todo_fitness) + parseInt(completed_fitness);
	
	var percentage_fitness = document.getElementById("fitness_percentage");
	var progress_fitness = document.getElementById("fitness_progress");
	document.getElementById("fitness_completed").innerHTML = completed_fitness ;
	document.getElementById("fitness_total").innerHTML = total_fitness;  

	var progressBar_fitness;
	if(total_fitness==0){
		progressBar_fitness = 0;
	}else{
		progressBar_fitness= completed_fitness * (1/total_fitness) * 100;
	}
	percentage_fitness.innerHTML = parseInt(progressBar_fitness) + "%";     
	progress_fitness.style.width = progressBar_fitness + "%";