var idUser = getCookie('userID');

function getCookie(name) {
    
    var cookieArr = document.cookie.split(";");
    
 
    for(var i = 0; i < cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split("=");
        
        
        if(name == cookiePair[0].trim()) {
            
            return decodeURIComponent(cookiePair[1]);
        }
    }
    
   
    return null;
}

function getDepartments(){
	axios({
		url: '../backend/api/departments.php?id='+document.getElementById('list-departments').value,
		method: 'get',
		responseType: 'json'
	}).then(res=>{
		res.data.forEach(department=>{
			document.getElementById('list-departments').innerHTML +=
				`<option id="nameDepartment" value="${department.categoryID}">${department.nameDepartment}</option>`;

		});
		
			
	}).catch(err=>{
		console.error(err);
	});
}
getDepartments();


function changeDepartment() {
	getProducts();
}


window.onload = function(){
	console.log('cargar informacion');
	getProducts();
}

var categoryProduct;
function getProducts() {	
	axios({
		url: '../backend/api/products.php?categoryID='+document.getElementById('list-departments').value,
		method: 'get',
		responseType: 'json'
	}).then(res=>{
		categoryProduct = res.data
		document.getElementById('products').innerHTML = '' 
		for (let i = 0; i < res.data.length; i++) {
			product = res.data[i];
			
		
			console.log(product);
			var estrellas = '';
				for(let j=0; j<product.calification; j++){
					estrellas += '<i class="fas fa-star"></i>';
				}
				for(let j=0; j<5-product.calification; j++){
					estrellas += '<i class="far fa-star"></i>';
				}
				document.getElementById('products').innerHTML += 
					`<div class="col-12" id="prod${i}">
					<div class="card my-3 mx-auto" style="max-width: 1000px;">
					<div class="row no-gutters">
					  <div class="col-md-4" style="background-color: #EAEDED;">
						<img src="${product.image}" data-toggle="modal" data-target="#productModal${i}" onclick="productsModal()" class="card-img" alt="...">
					  </div>
					  <div class="col-md-8">
						<div class="card-body">
						  <h5 class="card-title" data-toggle="modal" data-target="#productModal${i}" onclick="productsModal()">${product.name}</h5>
						  <div>
						  	${estrellas}
						  </div>
						  <div class="mt-5">
							<strong>${product.price}</strong>
						  </div>
						  <div id="deleteItem${i}" class="col-md-4 px-0" style="background-color: #EAEDED; text-align: end;">
						  	<i class="far fa-trash-alt ml-auto" style="color: red;" onclick="deleteProductCategory(${i})"></i>
						</div>
						</div>
					  </div>
					</div>
				  </div>
				  <hr>
					</div>
					`

					verifyPermission(i);
				
		};
	}).catch(err=>{
		console.error(err);
	});
	
}




function productsModal (i,k) {
	document.getElementById('products-modal').innerHTML = ''
	categoryProduct.forEach((prod,i) =>{
		var estrellas = '';
		for(let j=0; j<prod.calification; j++){
			estrellas += '<i class="fas fa-star"></i>';
		}
		for(let j=0; j<5-prod.calification; j++){
			estrellas += '<i class="far fa-star"></i>';
		}
		document.getElementById('products-modal').innerHTML += 
		`
		<div class="modal fade h-5" id="productModal${i}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				
				<div class="modal-body">
					<div class="row">
						<div class="col-12 col-md-6">
							<img src="${prod.image}" width=180px" alt="">
						</div>
						<div class="col-12 col-md-6">
							<div>
								<strong>${prod.name}</strong></br>
							<div>
							<div class="pt-2">
								<p><strong>Marca:</strong> ${prod.brand}</p></br>
							<div>
							<div>
								${estrellas}
							</div>
							<div class="mt-5">
								<strong>${prod.price}</strong>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="saveProduct(${i})"><i style="color:black;" class="fas fa-shopping-cart"></i> Agregar al carrito</button>
				</div>
			</div>
			</div>
		</div>`


	});
	
	
}

var productsLength;
function products(){
	axios({
		url: '../backend/api/products.json',
		method:'get',
		responseType:'json'
	}).then(res=>{
		console.log(err)
		productsLength = res.data.length;
	}).catch(err=>{
		console.error(err);
	});
}


function addProduct(){
	axios({
		url: '../backend/api/productsCategory.php?id='+idUser,
		method: 'post',
		responseType: 'json',
		data: {
			productID: productsLength,
			categoryID: document.getElementById('list-departments').value, 
			name: document.getElementById('productName').value,
			brand: document.getElementById('productBrand').value,
			image: document.getElementById('productImage').value,
			price: document.getElementById('productPrice').value,
			calification: document.getElementById('productCalification').value
		}
	}).then(res=>{
		console.log(res);
		getProducts();
		$('#modalAdd').modal('hide');
	}).catch(err=>{
		console.error(err);
	});
}


function deleteProductCategory(i){
	axios({
		url: '../backend/api/productsCategory.php',
		method: 'delete',
		responseType: 'json',
		data: {
			index: i,
			userID: idUser,
			categoryID: document.getElementById('list-departments').value
		}
	}).then(res=>{
		console.log(res);
		getProducts();
	}).catch(err=>{
		console.error(err);
	});
}


function saveProduct(i) {

	var prod = categoryProduct[i];
	axios({
		method: 'post',
		url: '../backend/api/products.php?id='+idUser,
		responseType: 'json',
		data: {
			productID: prod.productID,
			categoryID:	prod.categoryID,
			name: prod.name,
			brand:	prod.brand,
			image:	prod.image,
			price:	prod.price,
			calification:	prod.calification
		}
	}).then(res=>{
		showCarModal();
		$(`#productModal${i}`).modal('hide');
	}).catch(err=>{
		console.error(err);
	});
}
	



var produc;
function showCarModal () {
	//var prod = categoryProduct[i]
	document.getElementById('productsUser').innerHTML = '';
	axios({
		url: '../backend/api/car.php?id='+idUser,
		method:'get',
		responseType: 'json'
	}).then(res=>{
		produc = res.data;
		var count = 1;
		for (let i = 0; i < res.data.length; i++) {
			
				var prod = res.data[i];
				document.getElementById('productsUser').innerHTML +=
				`<div class="col-12">
					<div class="row">
						<div class="col-3">
							${count}${'.'}
						</div>
						<div class="col-3">
						 	${prod.name}
						</div>
						<div class="col-3">
							${prod.brand}
						</div>
						<div class="col-3">
							${prod.price}
						</div>
					</div>
					<hr>
				</div>`
				
			
			count+=1;

			
			
		}

		document.getElementById('footerModal').innerHTML =
		`<input id="indexDelete" type="number" min="1" placeholder="">
		<button type="button" class="btn btn-danger" onclick="deleteProduct()">Eliminar</button>
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>`
		
		
	}).catch(err=>{
		console.error(err);
	});
		
	
}

showCarModal();


function deleteProduct () {
	var i = document.getElementById('indexDelete').value-1
	var prod = produc[i];
	axios({
		method: 'delete',
		url: '../backend/api/products.php?id='+idUser,
		responseType: 'json',
		data: {
			productID:prod.productID,
			categoryID:prod.categoryID,
			name:prod.name,
			brand:prod.brand,
			image:prod.image,
			price:prod.price,
			calification:prod.calification
		}
	}).then(res=>{
		showCarModal();
	}).catch(err=>{

	});
	$('productsUser').modal('hide');
}


function verifyPermission(i){
	document.getElementById('account').style.display = 'none';
	document.getElementById(`deleteItem${i}`).style.display = 'none';
	if(getCookie('permission')=='administrator'){
		document.getElementById('account').style.display = 'block';
		document.getElementById(`deleteItem${i}`).style.display = 'block';
	}

}

verifyPermission();





