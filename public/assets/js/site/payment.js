let brand

$(document).ready(function(){
	const SESSIONID = $('#sessionId').val()
	const AMOUNT = $('#amountPrice').val()
	const FORM = $('#formPayment')

	$('#typePayment').change(function(){
		let element = $(this)

		$('.card').removeClass('required').parent().parent().hide()
		$('.debit').parent().parent().hide()

		if(element.val() == 0){
			$('.card').addClass('required').parent().parent().show()
		}else if(element.val() == 1){
			$('.debit').parent().parent().show()
		}
	})

	// Setando o id da sessão
	PagSeguroDirectPayment.setSessionId(SESSIONID);

	// Capturando os métodos de pagamento
	getPaymentMethods(AMOUNT)

	// Obtendo a marca do cartão
	$('#cardNumber').keyup(function(){
		getBrand(this, AMOUNT)
	})

	// Validando o cartão
	FORM.submit(async function(){ 
		let form = this
		event.preventDefault()

		$('.alert').remove()

		if($('#typePayment').val() == 0){
			// Get card token and submit form
			getCardToken(this)
		}else{
			getSenderHash(this)
		}
	})
})

function createAlert(message, type = 'alert-danger'){
	return $('<div />').addClass(`alert ${type}`).html(message)
}

function getPaymentMethods(amount){
	PagSeguroDirectPayment.getPaymentMethods({
	    amount: amount,
	    success: function(response) {
	    	const url = 'https://stc.pagseguro.uol.com.br'

	    	// BOLETO
	    	$.each(response.paymentMethods.BOLETO.options, function(index, option){
	    		$('#bolet-method').append(`<img src="${url + option.images.SMALL.path}" class="m-1" title="${option.name}" />`)
	    	})

	    	// ONLINE DEBIT
	    	$.each(response.paymentMethods.ONLINE_DEBIT.options, function(index, option){
	    		$('#bank').append(`<option value="${option.name}">${option.name}</option>`)

	    		$('#online-debit-method').append(`<img src="${url + option.images.SMALL.path}" class="m-1" title="${option.name}" />`)
	    	})

	    	// CREDIT CARD
	    	$.each(response.paymentMethods.CREDIT_CARD.options, function(index, option){
	    		$('#credit-card-method').append(`<img src="${url + option.images.SMALL.path}" class="m-1" title="${option.name}" />`)
	    	})
	    },
	    error: function(response) {},
	    complete: function(response) {}
	})
}

function getBrand(element, amount){
	let value = $(element).val().replace(/[^0-9]/ig, '')

	$('#installments').html('')

	if(value.length >= 6){
		$('.alert').remove()

		PagSeguroDirectPayment.getBrand({
		    cardBin: value,
		    success: function(response) {
		    	brand = response.brand
		    	getInstallments(amount, brand.name)
		    },
		    error: function(response) {
		    	FORM.before(createAlert('O cartão informado é inválido!'))
		    },
		    complete: function(response) {}
		})
	}
}

function getInstallments(amount, brand, maxInst = 2){
	PagSeguroDirectPayment.getInstallments({
        amount: amount,
        maxInstallmentNoInterest: maxInst,
        brand: brand,
        success: function(response){
        	$('#installments').html('')

        	$.each(response.installments[brand], function(index, option){
        		$('#installments').append(`<option value="${option.quantity}x${option.installmentAmount}">${option.quantity} vezes de R$${Number(option.installmentAmount).toFixed(2)}</option>`)
        	})
       	},
        error: function(response) {},
        complete: function(response) {}
	})
}

function getCardToken(form){
	let data = new FormData(form)

	PagSeguroDirectPayment.createCardToken({
	   	cardNumber: data.get('cardNumber').replace(/[^0-9]/ig, ''), 				// Número do cartão de crédito
	   	brand: brand.name, 															// Bandeira do cartão
	   	cvv: data.get('cvv'), 														// CVV do cartão
	   	expirationMonth: data.get('month').padStart('0'), 							// Mês da expiração do cartão
	   	expirationYear: data.get('year'), 											// Ano da expiração do cartão, é necessário os 4 dígitos.
	   	success: function(response) {
	   		$('#cardToken').val(response.card.token)
	        getSenderHash(form)
	   	},
	   	error: function(response) {
	        createAlert('Os dados do cartão informado são inválidos!')
	   	},
	   	complete: function(response) {}
	})
}

function getSenderHash(form){
	PagSeguroDirectPayment.onSenderHashReady(function(response){
	    if(response.status == 'error') {
	    	createAlert('Ocorreu um erro ao processar os dados do pagamento!')
	        return
	    }

	    $('#senderHash').val(response.senderHash)

	    // Submit form
		let data = new FormData(form)

		$.ajax({
			url: form.action,
			method: form.method,
			data: data,
			processData: false,
			contentType: false,
			dataType: 'json',
			beforeSend: function(){
				$('.modalLoading').show(100)
			},
			complete: function(){
				$('.modalLoading').hide(100)
			}
		})
		.done(function(response){
			if(!response.result){
				$(form).before(createAlert(response.message))
			}else{
				$(form).before(createAlert(response.message, 'alert-success'))
				$(form).remove()
			}
		})
		.fail(function(response){
			createAlert('Ocorreu um erro ao processar os dados do pagamento!')
		})
	})
}