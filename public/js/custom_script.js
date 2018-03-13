$(function() {
	var value;
	var options_nik = {
			url: "/penduduk_ajax_nik",
			requestDelay: 300,
			getValue: "id",
			template: {
				type: "description",
				fields: {
					description: "nama"
				}
			},
			list: {
				match: {
					enabled: true
				},
				showAnimation: {
					type: "slide",
					time: 200,
				},
				hideAnimation: {
					type: "slide",
					time: 200,
				},
				onSelectItemEvent: function() {
					var value = $(':focus').getSelectedItemData().nama;
					$(':focus').closest('div.col-md-4').next().children().val(value);
				}
			}
		};

		var options_nik_umum = {
			url: "/penduduk_ajax_nik",
			requestDelay: 300,
			getValue: "id",
			template: {
				type: "description",
				fields: {
					description: "nama"
				}
			},
			list: {
				match: {
					enabled: true
				},
				showAnimation: {
					type: "slide",
					time: 200,
				},
				hideAnimation: {
					type: "slide",
					time: 200,
				}
			}
		};

		var options_kecamatan = {
			url: "/kecamatan_ajax",
			requestDelay: 400,
			getValue: "nama",
			template: {
				type: "description",
				fields: {
					description: "id"
				}
			},
			list: {
				maxNumberOfElements: 10,
				match: {
					enabled: true
				},
				showAnimation: {
					type: "slide",
					time: 200,
				},
				hideAnimation: {
					type: "slide",
					time: 200,
				},
				onSelectItemEvent: function() {
					value = $('#kecamatan_form').getSelectedItemData().id;
				}
			}
		};

	/* SCRIPT ON VIEW KK.INSERT 
	*************************************************************************
	*************************************************************************/
	var i = 0;

	// when kecamatan field is done
	$('#kecamatan_form').focusout(function(){
		// link ajax
		var data = "/kecamatan_ajax_hasil/" + value;

    	$.ajax({
		    url: data,
		    type:"GET",
		    success:function(msg){
		        $('#kota').val(msg['kota_send'].nama);
		        $('#provinsi').val(msg['provinsi_send'].nama);
		    },
		    dataType:"json"
		});          
	});

	// when tambah anggota keluarga and tambah row button is clicked
	$('#tambah_keluarga, #tambah_row').on('click', function() {
		$('#div_keluarga').show();
		$('#div_keluarga').append('<div class="form-group row">' + 
		        		'<div class="col-md-4">' + 
							'<input type="text" id="nik_form' + i + '" class="form-control nik_form_class" name="nik" placeholder="Masukkan NIK">' + 
						'</div>' + 
						'<div class="col-md-4">' +
							'<input id="nama_form' + i + '" class="form-control" placeholder="Nama Lengkap" type="text" name="nama" readonly>' +
						'</div>' +
						'<div class="col-md-4">' +
							'<button type="button" id="hapus_row" class="btn btn-danger">Hapus</button>' +
						'</div>' +
		        	'</div>');
		$('#nik_form' + i).easyAutocomplete(options_nik);
		i++;
	});

	// when hapus row button is clicked
	$(document).on('click','#hapus_row', function(){
		$(this).closest('div.form-group').remove();
	});

	// nik autocomplete
	$('#nik_umum_form').easyAutocomplete(options_nik_umum);

	// kelurahan autocomplete
	$('#kecamatan_form').easyAutocomplete(options_kecamatan);

	$('#btn_submit').click(function() {
		var list_nik = [];
		var no_kk = $('#no_kk_form').val();

		$('.nik_form_class').each(function(i, obj) {
			list_nik.push($(this).val());
		});

		$('#form_kk').append('<input type="hidden" name="list_nik" value="' + list_nik + '">');
		$('#form_kk').append('<input type="hidden" name="no_kk" value="' + no_kk + '">');
	});



	/* SCRIPT ON VIEW PENDUDUK.INSERT 
	******************************************************************************
	******************************************************************************/

	// if page is penduduk.insert
	if (window.location.href.indexOf('penduduk/insert') > -1) {
		// code for autocomplete kota
  		var options = {
			url: "/penduduk_ajax_kota",
			requestDelay: 300,
			getValue: "nama",
			list: {
				match: {
					enabled: true
				},
				showAnimation: {
					type: "slide",
					time: 200,
				},
				hideAnimation: {
					type: "slide",
					time: 200,
				}
			}
		};

		$("#kota").easyAutocomplete(options);
	}
});