


function login(){
	axios({
		url: '../backend/api/login.php',
		method: 'post',
		responseType: 'json',
		data: {
			email: document.getElementById('email').value,
			password: document.getElementById('password').value,
			permission: document.getElementById('user-type').value
		}
	}).then(res=>{
        console.log(res);
        
        if(res.data.resultID==1){
            window.location.href = "index.php";
        }else{
            document.getElementById('error').style.display = 'block';
            document.getElementById('error').innerHTML = res.data.message;
        }
        
    }).catch(err=>{
		console.error(err);
	});
}