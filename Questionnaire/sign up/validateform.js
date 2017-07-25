function Validateform()
{
	document.getElementById("perr").innerHTML="* passwords do not match";
	var pw=document.form["myForm"]["password"].value;
	var cpw=document.form["myForm"]["confirm_password"].value;
	if(pw.localeCompare(cpw)!=0) {
		document.myForm.password.focus();
		document.getElementById("perr").innerHTML="* passwords do not match";
		return false;
	}
	
	var enroll=document.myForm.eno.value;
	if(isNaN(enroll))
	{
		document.myForm.confirm_password.focus();
		document.getElementById("en_err").innerHTML="* Contains only digits"; 
		return false;
	}

	return true;
}