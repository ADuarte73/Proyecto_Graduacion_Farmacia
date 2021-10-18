var url 	= $('meta[name="url"]').attr('content'),
	token    = $('meta[name="token"]').attr('content');

function message_toast(type, message, title = '')
{
	switch(type)
	{
		case 'success':
			toastr.success(message , title, {
				"positionClass": "toast-top-center"
			});
			break;

		case 'info':
			toastr.info(message , title, {
				"positionClass": "toast-top-center"
			});
			break;

		case 'error':
			toastr.error(message , title, {
				"positionClass": "toast-top-center"
			});
			break;

		case 'warning':
			toastr.warning(message , title, {
				"positionClass": "toast-top-center"
			});
			break;
	}
}


function load_cantproductscart()
{
	$.ajax({
		url 		: url + '/cantidad_productos',
		method  	: 'POST',
		data 		: {
			'_token' : token
		},
		success		: function(r) {
			if(!r.estado) {
				message_toast(r.mensaje);
				return;
			}

			$('.cantidad_productos_carrito').html(r.cantidad);
		},
		dataType	: 'json'
	});

	return false;
}

load_cantproductscart();

function total_carrito()
{
	$.ajax({
		url 		: url + '/total_carrito',
		method  	: 'POST',
		data 		: {
			'_token' : token
		},
		success		: function(r) {
			if(!r.estado) {
				message_toast(r.mensaje);
				return;
			}

			$('.subtotal_carrito').html(r.total);
		},
		dataType	: 'json'
	});
}

total_carrito();


function cargar_toolbarcarrito()
{
	$.ajax({
		url 		: url + '/toolbarcarrito',
		method  	: 'POST',
		data 		: {
			'_token' : token
		},
		success		: function(r) {
			if(!r.estado) {
				message_toast(r.mensaje);
				return;
			}

			$('.wrapper_toobalcarrito').html(r.carrito);
		},
		dataType	: 'json'
	});
}

cargar_toolbarcarrito();


$('body').on('click' , '.btn_removerproducto' , function(e) {
	e.preventDefault();
	let id = $(this).data('id');

	$.ajax({
		url       : url + '/eliminar_producto',
		method    : 'POST', 
		data      : {
			'_token' : token,
			id       : id
		},
		beforeSend  : function() {
			$('body').waitMe({
				effect   : 'rotateplane'
			});
		},
		success   : function(r){
			if(!r.estado)
			{
				$('body').waitMe('hide');
				message_toast('error' , r.mensaje);
				return;
			}

			$('body').waitMe('hide');
			message_toast('success' , r.mensaje);
			load_cantproductscart();
			total_carrito();
			cargar_toolbarcarrito();
			cargar_carrito();
		},
		dataType  : 'json'
	});
});