function emptyFormValidation(){
	var content = "";
	var inputCheck = new RegExp("^[a-z A-Z ]+(\s[a-z A-Z ]+)?$");
	var emptyFieldCheck = inputCheck.exec(formComments.comment.value);

	if(!emptyFieldCheck){
		content += "Your comment is empty or contains invalid characters.\n\n";
	}

	if(!content == ""){
		alert(content);
		form = document.getElementById("formComments");
		//form.action ="material.php?matID=$_GET['matID']";
		history.go(-1);
	}
}
function emptyLectUpload(){
	var upload = document.getElementById("myfile").value;
    if (upload == null || x == "") {
        alert("Your upload was empty!");
        history.go(-1);
        
	}
}
function emptyFAQUpload(){
	var FAQcontent = "";
	var FAQinputCheck = new RegExp("^[a-z A-Z ]+(\s[a-z A-Z ]+)?$");
	var emptyQuestionCheck = FAQinputCheck.exec(addfaq.question.value);
	var emptyAnswerCheck = FAQinputCheck.exec(addfaq.answer.value);

	if(!emptyQuestionCheck || !emptyAnswerCheck){
		FAQcontent += "Your question and/or answer is empty or contains invalid characters.\n\n";
	}

	if(!FAQcontent == ""){
		alert(FAQcontent);
		form = document.getElementById("FAQadd");
		history.go(-1);
}

}
function emptyForumValidation(){
	var content = "";
	var inputCheck = new RegExp("^[a-z A-Z ]+(\s[a-z A-Z ]+)?$");
	var emptyFieldCheck = inputCheck.exec(reply.submitPost.value);

	if(!emptyFieldCheck){
		content += "Your post is empty or contains invalid characters.\n\n";
	}

	if(!content == ""){
		alert(content);
		form = document.getElementById("reply");
		history.go(-1);
	}
}
