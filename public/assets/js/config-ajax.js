$(window.document).ready(function(){
	$('*').delegate('.load-ajax-click', 'click', load)
	$('.autoclick').trigger('click')
})


function load(){
	let method = (this.dataset.method !== undefined && this.dataset.method.length > 0) ? this.dataset.method : 'POST'
	let url = this.dataset.url
	let token = this.dataset.token
	let data = (this.dataset.data !== undefined && this.dataset.data.length > 0) ? JSON.parse(this.dataset.data) : Object.create({})
	let container = this.dataset.container
	let append = (this.dataset.append !== undefined && this.dataset.append.length > 0) ? this.dataset.append : true
	let remove = (this.dataset.remove !== undefined && this.dataset.remove.length > 0) ? this.dataset.remove : true
	let removeElement = this.dataset.removeelement

	if(url !== undefined && method !== undefined && container !== null && token !== null){
		let classC = null;
		let content = null
		let element = this
		data._token = token

		$.ajax({
			method: method,
			url: url,
			data: data,
			beforeSend: function(){
				classC = $(element).attr('class')
				content = $(element).html()

				$(element).removeClass(classC)
				$(element).addClass('load')
				$(element).empty()
			},
			complete: function(){
				if(!remove){
					$(element).removeClass('load')
					$(element).addClass(element)
					$(element).html(content)
				}else{
					$(element).remove()
				}

				if(removeElement !== undefined) $(removeElement).remove()
			}
		})
		.done(function(result){
			if(append) 
				$(container).append(result)
			else
				$(container).html(result)
		})
	}
	}