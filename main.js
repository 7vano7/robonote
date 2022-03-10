$(document).ready(function(){
	$('.fa-fonticons').click(function(){
		let name = $('.record').val();

		if(name.length == 0) {
			$('.input-img').hide();
			alert('Please enter a name');
			return false;
		}

		if($('.icons-list').css('display') == 'none'){
			$('.icons-list').show('slow');
		} else {
		$('.icons-list').hide('slow');
		}
	});

	$('.icon-img').click(function() {
		let name = $(this).data('name');
		$('.record').data('id', name);
		$('.record').css('padding-left', '40px');
		$('.input-img').attr('src', 'icons/'+name);
		$('.input-img').show();
		$('.icons-list').hide('slow');
		return false;
	});

	$('.btn-submit').click(function() {
		sendData();
		return false;
	});

	$('body').on('keypress', function (e) {
		if(e.which === 13){
			sendData();
			return false;
		}
	});

	$('.record').on('keypress', function() {
		let value = $('.record').val();
		if(value.length == 0) {
			$('.input-img').hide();
			$('.record').css('padding-left', '10px');
		}
	})


	function sendData() {
		let name = $('.record').val();
		let icon = $('.record').data('id');
		if(name.length == 0) {
			alert('Please enter a name');
			return false;
		}
		if(icon.length == 0) {
			alert('Please choose an icon');
			return false;
		}

		$.ajax({
            url: '',
            data: {name:name, icon:'/'+icon},
            method: 'POST',
            success: function (result) {
                if(result.status == 'success') {
                	let td_1 = '<td class="number">'+result.number+'</td>';
                	let td_2 = '<td class="table-text"><img src="icons/'+icon+'" class="img" /> <span class="">'+name+'</span></td>';
                	let td_3 = '<td class="number"><a href="" data-id="'+result.number+'"><i class="fa fa-trash"></i></a></td>';
                    $('.table').append('<tr>'+td_1+td_2+td_3+'</tr>');
                    $('.input-img').hide();
					$('.record').css('padding-left', '10px');
					$('.record').val('');

                } else {
                    alert('Error');
                }
            },
            error: function () {
                alert('Error');
            }
        });
        return false;
	};

	$('.fa-trash').click(function(){
		let id = $(this).data('id');
		let tr = $(this).parents('tr').first();
		$.ajax({
            url: '',
            data: {delete:id},
            method: 'POST',
            success: function (result) {
            	console.log(result);
                if(result.status == 'success') {
                	tr.remove();
                } else {
                    alert('Error');
                }
            },
            error: function () {
                alert('Error');
            }
        });
        return false;
	});
});