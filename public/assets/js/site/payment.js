let brand

$(document).ready(function(){
	const SESSIONID = $('#sessionId').val()
	const AMOUNT = $('#amountPrice').val()
	const FORM = $('#formPayment')

	$('#typePayment').change(function(){
		let element = $(this)

		$('.card').addClass('required').parent().show()
		if(element.val() == 2){
			$('.card').removeClass('required').parent().hide()
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
		event.preventDefault()
		$('.alert').remove()

		// Get card token
		await getCardToken(new FormData(this))

		// if(!Boolean($('div.alert').length)){
		// 	$(this).trigger('submit')
		// }
	})
})

function createAlert(message, type = 'alert-danger'){
	return $('<div />').addClass(`alert ${type}`).text(message)
}

function getPaymentMethods(amount){
	PagSeguroDirectPayment.getPaymentMethods({
	    amount: amount,
	    success: function(response) {
	    	let html = ''
	    	let images = []
	    	let url = 'https://stc.pagseguro.uol.com.br'

	    	// BOLETO
	    	$.each(response.paymentMethods.BOLETO.options, function(index, option){
	    		html += `<img src="${url + option.images.SMALL.path}" class="m-1" title="${option.name}" />`
	    	})

	    	// ONLINE DEBIT
	    	$.each(response.paymentMethods.ONLINE_DEBIT.options, function(index, option){
	    		html += `<img src="${url + option.images.SMALL.path}" class="m-1" title="${option.name}" />`
	    	})

	    	// CREDIT CARD
	    	$.each(response.paymentMethods.CREDIT_CARD.options, function(index, option){
	    		html += `<img src="${url + option.images.SMALL.path}" class="m-1" title="${option.name}" />`
	    	})

	        $('#paymentMethods').html(html)
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

async function getCardToken(data){
	await PagSeguroDirectPayment.createCardToken({
	   	cardNumber: data.get('cardNumber').replace(/[^0-9]/ig, ''), 				// Número do cartão de crédito
	   	brand: brand.name, 															// Bandeira do cartão
	   	cvv: data.get('cvv'), 														// CVV do cartão
	   	expirationMonth: data.get('month').padStart('0'), 							// Mês da expiração do cartão
	   	expirationYear: data.get('year'), 											// Ano da expiração do cartão, é necessário os 4 dígitos.
	   	success: function(response) {
	   		$('#cardToken').val(response.card.token)
	        getSenderHash()
	   	},
	   	error: function(response) {
	        createAlert('Os dados do cartão informado são inválidos!')
	   	},
	   	complete: function(response) {}
	})
}

async function getSenderHash(form){
	await PagSeguroDirectPayment.onSenderHashReady(function(response){
	    if(response.status == 'error') {
	    	createAlert('Ocorreu um erro ao processar os dados do cartão!')
	        return
	    }

	    $('#senderHash').val(response.senderHash)
	})
}