$(window.document).ready(function(){
	$('.btn-add').click(function(){
		let fileInput = $('.container-images .file-image:last').clone()
		let title = fileInput.find('label').text()
		let num = Number(title.split(' ')[1].replace(':', '')) + 1

		fileInput.find('input[type=file]').attr({
			id: `image${num}`,
			title: `Imagem ${num}`
		})
		fileInput.find('label').attr('for', `image${num}`).text(`Imagem ${num}`)

		$('.container-images').append(fileInput)
	})
})