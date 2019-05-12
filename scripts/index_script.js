var modalWrapper=document.getElementById('modal-wrapper');
var modalLogin=document.getElementById('modal-login');
var modalSignup=document.getElementById('modal-signup');
var openModalLogin=() => {
	modalWrapper.style.display='block';
	setTimeout(() => {
		modalLogin.style.transition='linear .5s';
		modalLogin.style.top='50%';
		modalLogin.style.opacity='1';
	},100);
}
var closeModalLogin=() => {
	modalLogin.style.transition='linear .5s';
	modalLogin.style.top='0%';
	modalLogin.style.opacity='0';
	setTimeout(() => {
		modalWrapper.style.display='none';
	},500);
}
var openModalSignup=() => {
	modalLogin.style.transition='linear .5s';
	modalLogin.style.top='0%';
	modalLogin.style.opacity='0';
	modalSignup.style.display='block';
	setTimeout(() => {
		modalSignup.style.transition='linear .5s';
		modalSignup.style.top='50%';
		modalSignup.style.opacity='1';
	},500);
}
var closeModalSignup=() => {
	modalSignup.style.transition='linear .5s';
	modalSignup.style.top='0%';
	modalSignup.style.opacity='0';
	setTimeout(() => {
		modalSignup.style.display='none';
		modalWrapper.style.display='none';
	},500);
}
window.addEventListener('click',(event) => {
	if(event.target==modalWrapper)
	{
		closeModalLogin();
		closeModalSignup();
	}
});
var signup_formValidate=() => {
	var gender=document.forms['signup-form']['gender'];
	var password=document.forms['signup-form']['password'];
	var re_password=document.forms['signup-form']['re-enter-password'];
	if(gender.value=='null')
	{
		alert("Please select your gender.");
		return false;
	}
	if(password.value!==re_password.value)
	{
		alert("Password and Re-enter-password isn't matching.");
		return false;
	}
}