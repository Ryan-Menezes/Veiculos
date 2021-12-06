$(document).ready(function(){
	const SESSIONID = $('#sessionId').val()
	const AMOUNT = $('#amountPrice').val()

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
	PagSeguroDirectPayment.getPaymentMethods({
	    amount: AMOUNT,
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
	});
})