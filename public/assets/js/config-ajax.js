let ajaxLoad = null
let ajaxLoadForm = null

$(window.document).ready(function(){
	$('*').delegate('.load-ajax-click', 'click', load)
	$('*').delegate('.load-ajax-form-submit', 'submit', loadForm)
	$('.autoclick').trigger('click')
})

function load(){
	let url 			= this.dataset.url
	let token 			= this.dataset.token
	let container 		= this.dataset.container
	let removeElement 	= this.dataset.removeelement
	let method 			= (this.dataset.method 	!== undefined && this.dataset.method.length 	> 0) 	? this.dataset.method 			: 'POST'
	let data 			= (this.dataset.data 	!== undefined && this.dataset.data.length 		> 0) 	? JSON.parse(this.dataset.data) : Object.create({})
	let append 			= (this.dataset.append 	!== undefined && this.dataset.append == 'false') 		? false							: true
	let remove 			= (this.dataset.remove 	!== undefined && this.dataset.remove == 'false') 		? false 						: true
	let loading 		= (this.dataset.loading !== undefined && this.dataset.loading == 'false') 		? false							: true

	if(url !== undefined && method !== undefined && container !== null && token !== null){
		let classC = null;
		let content = null
		let element = this
		data._token = token

		if(ajaxLoad === null){
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
					}else if(!append){
						$(container).html($('<div/>').addClass('load'))
					}

					if($(container).hasClass('dialog-ui')) $(container).dialog('open');
				},
				complete: function(){
					if(!remove){
						if(loading){
							$(element).removeClass('load')
							$(element).addClass(element)
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
				if(append) 
					$(container).append(result)
				else
					$(container).html(result)
			})
			.fail(function(){
				if(append) 
					$(container).append($('<div/>').addClass('alert alert-danger').text('FALHA AO CARREGAR O CONTEÚDO!'))
				else
					$(container).html($('<div/>').addClass('alert alert-danger').text('FALHA AO CARREGAR O CONTEÚDO!'))
			})
		}
	}
}

function loadForm(){
	event.preventDefault()

	let url = this.action
	let method = this.method
	let data = new FormData(this)

	if(ajaxLoadForm === null){
		ajaxLoadForm = $.ajax({
			url: url,
			method: method,
			data: data,
			complete: function(){
				ajaxLoadForm = null
			}
		})
		.done(function(result){
			result = JSON.parse(result)

			if(result.result)
				$(this).prepend($('<div/>').addClass('alert alert-success').text(result.message))
			else
				$(this).prepend($('<div/>').addClass('alert alert-danger').text(result.message))
		})
		.fail(function(){
			$(this).prepend($('<div/>').addClass('alert alert-danger').text('FALHA AO EXECUTAR O FORMULÁRIO!'))
		})
	}
}