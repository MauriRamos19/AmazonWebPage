function register(){
	axios({
		url: '../backend/api/register.php',
		method: 'post',
		responseType: 'json',
		data: {
			name: document.getElementById('user-name').value,
			email: document.getElementById('user-email').value,
			password: document.getElementById('user-password').value,
			permission: document.getElementById('user-type').value
		}
	}).then(res=>{
		console.log(res);
		if(res.data.resultID==1)
            window.location.href = "login.html";
		document.getElementById('user-name').value = '';
		document.getElementById('user-email').value = '';
		document.getElementById('user-password').value = '';
    }).catch(err=>{
		console.error(err);
	});
}


