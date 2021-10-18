var url  = $('meta[name="url"]').attr('content'),
	csrf = $('meta[name="token"]').attr('content');



$('body').on('click' , '.btn_agregarcarrito' , function(e) {
	e.preventDefault();
	let id 			= parseInt($(this).data('id')),
		cantidad 	= parseInt($(this).data('cantidad'));

		$.ajax({
			url 	 : url + '/agregarproducto',
			method   : 'POST',
			data     : {
				'_token' : csrf,
				id 		 : id,
				cantidad : cantidad
			},
            beforeSend  : function() {
                $('body').waitMe({
                    effect   : 'rotateplane'
                });
            },
			success  : function(r){
				if(!r.estado)
				{
					$('body').waitMe('hide');
					message_toast('error' , r.mensaje);
					return;
				}

				$('body').waitMe('hide');
				load_cantproductscart();
				total_carrito();
				cargar_toolbarcarrito();
				message_toast('success' , r.mensaje);
			},
			dataType : 'json'
		});
});


