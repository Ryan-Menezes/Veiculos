let ajaxLoad = null
let ajaxLoadForm = null
let ajaxLoadConfirm = null

$(window.document).ready(function(){
	$('*').delegate('.load-ajax-click', 'click', load)
	$('*').delegate('.load-ajax-form-submit', 'submit', loadForm)
	$('*').delegate('.load-ajax-form-submit .alert', 'click', function(){
		$(this).remove()
		return
	})
	$('*').delegate('.load-ajax-enter', 'change', load)
	$('*').delegate('.load-ajax-confirm', 'click', loadConfirm)
	$('*').delegate('.message-box', 'click', function(){
		$(this).remove()
		return
	})
	$('.autoclick').trigger('click')
})

function load(){
	let url 				= this.dataset.url
	let token 				= this.dataset.token
	let container 			= this.dataset.container
	let removeElement 		= this.dataset.removeelement
	let messagebox			= (this.dataset.messagebox 	!== undefined && this.dataset.messagebox == 'true')		? true							: false
	let method 				= (this.dataset.method 		!== undefined && this.dataset.method.length 	> 0) 	? this.dataset.method 			: 'POST'
	let data 				= (this.dataset.data 		!== undefined && this.dataset.data.length 		> 0) 	? JSON.parse(this.dataset.data) : Object.create({})
	let append 				= (this.dataset.append 		!== undefined && this.dataset.append == 'false') 		? false							: true
	let remove 				= (this.dataset.remove 		!== undefined && this.dataset.remove == 'false') 		? false 						: true
	let loading 			= (this.dataset.loading 	!== undefined && this.dataset.loading == 'false') 		? false							: true

	if(url !== undefined && method !== undefined){
		let classC = null;
		let content = null
		let element = this
		data._token = token

		if(ajaxLoad === null){
			if($(this).hasClass('load-ajax-enter')) url += `/${$(this).val()}`

			ajaxLoad = $.ajax({
				url: url,
				method: method,
				data: data,
				beforeSend: function(){
					if(loading){
						classC = $(element).attr('class')
						content = $(element).html()

						$(element).removeClass(classC)
						$(element).addClass('load')
						$(element).empty()
					}else if(!append && container !== undefined){
						if($(container).prop("tagName") != 'TBODY'){
							$(container).html($('<div/>').addClass('load'))
						}else{
							$(container)
								.html($('<tr/>')
								.append(
									$('<td>')
										.attr('colspan', '500')
										.append($('<div/>')
													.addClass('loading')
													.append($('<div/>')
														.addClass('load')
													)
												)
										)
								)
						}
					}

					if($(container).hasClass('dialog-ui')) $(container).dialog('open');
				},
				complete: function(){
					if(!remove){
						if(loading){
							$(element).removeClass('load')
							$(element).addClass(classC)
							$(element).html(content)
						}
					}else{
						$(element).remove()
					}

					if(removeElement !== undefined) $(removeElement).remove()
					ajaxLoad = null
				}
			})
			.done(function(result){
				if(!messagebox){
					if(append){
						$(container).append(result)
					}else{
						$(container).html(result)
					}
				}else{
					result = JSON.parse(result);

					$('.message-box').remove()
					$('body').append($('<div/>').addClass('message-box').html(result.message))
				}
			})
			.fail(function(){
				if(!messagebox){
					if(append){
						$(container).append($('<div/>').addClass('alert alert-danger').text('FALHA AO CARREGAR O CONTEÚDO!'))
					}else{
						$(container).html($('<div/>').addClass('alert alert-danger').text('FALHA AO CARREGAR O CONTEÚDO!'))
					}
				}
			})
		}
	}

	return
}

function loadForm(){
	event.preventDefault()

	let url 				= this.action
	let method 				= this.method
	let data 				= new FormData(this)
	let element 			= this

	if(ajaxLoadForm === null){
		ajaxLoadForm = $.ajax({
			url: url,
			method: method,
			data: data,
			processData: false,
			contentType: false,
			dataType: 'json',
			beforeSend: function(){
				$(element).children('.alert').remove()
				$(element).children(':submit').hide()
				$(element).append($('<div/>').addClass('load'))
			},
			complete: function(){
				ajaxLoadForm = null
				$(element).children(':submit').show()
				$(element).children('.load').remove()
				$('#search').trigger('change')
			}
		})
		.done(function(result){
			if(result.success){
				$(element).prepend($('<div/>').addClass('alert alert-success').html(result.message))

				if($(element).hasClass('clear-form'))
					$(element).trigger("reset")
			}else{
				$(element).prepend($('<div/>').addClass('alert alert-danger').html(result.message))
			}
		})
		.fail(function(){
			$(element).prepend($('<div/>').addClass('alert alert-danger').text('FALHA AO EXECUTAR O FORMULÁRIO!'))
		})
	}

	return
}

function loadConfirm(){
	let url 				= this.dataset.url
	let token 				= this.dataset.token
	let container 			= this.dataset.container
	let method 				= (this.dataset.method 	!== undefined && this.dataset.method.length 	> 0) 	? this.dataset.method 			: 'POST'
	let _method 			= (this.dataset._method !== undefined && this.dataset._method.length 	> 0) 	? this.dataset._method 			: method
	let data 				= (this.dataset.data 	!== undefined && this.dataset.data.length 		> 0) 	? JSON.parse(this.dataset.data) : Object.create({})	
	let html 				= $(container).html()

	$(container).dialog({
		autoOpen: true,
		width: 500,
		height: 'auto',
		minWidth: 500,
		close: function(){
			$(container).html(html)
			$('.ui-dialog-buttonpane').show()
		},
		buttons: {
			Cancelar: function(){
				$(this).dialog('close')
			},
			Sim: function(){
				if(url !== undefined && method !== undefined && container !== null && token !== null){
					let element = this
					data._token = token
					data._method = _method

					if(ajaxLoadConfirm === null){
						ajaxLoadConfirm = $.ajax({
							url: url,
							method: method,
							data: data,
							dataType: 'json',
							beforeSend: function(){
								$('.ui-dialog-buttonpane').hide()
								$(container).html($('<div/>').addClass('load'))
							},
							complete: function(){
								$(container).children('.load').remove()
								ajaxLoadConfirm = null
								$('#search').trigger('change')
							}
						})
						.done(function(result){
							if(result.success){
								$(container).html($('<div/>').addClass('alert alert-success').text(result.message))
							}else{
								$(container).html($('<div/>').addClass('alert alert-danger').text(result.message))
							}
						})
						.fail(function(){
							$(container).html($('<div/>').addClass('alert alert-danger').text('FALHA AO ENVIAR RESPOSTA!'))
						})
					}
				}
			}
		}
	})

	return
}