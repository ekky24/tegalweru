$(function() {
	$('.datepicker').datepicker({
	    format: 'dd-mm-yyyy',
	    autoclose: 'true'
	});

	var value;
	var options_nik = {
			url: "/penduduk_ajax_nik",
			requestDelay: 1000,
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
					time: 10,
				},
				onSelectItemEvent: function() {$('#nama_surat').val("");
					$(':focus').closest('div.col-md-4').next().children().val("");

					var value = $(':focus').getSelectedItemData().nama;
					$(':focus').closest('div.col-md-4').next().children().val(value);
				}
			}
		};

		var options_nik_kepala = {
			url: "/penduduk_ajax_nik_kepala",
			requestDelay: 1000,
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
					time: 10,
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
					time: 10,
				},
				onSelectItemEvent: function() {
					value = $('#kecamatan_form').getSelectedItemData().id;
				}
			}
		};


	/* SCRIPT ON SWEET ALERT 
	*************************************************************************
	*************************************************************************/
	if ($('.layout_error').length>0) {
		var msg = "";

		$('.item_error').each(function(i, item) {
		    msg += "<li>" + $(this).text() + "</li><br>";
		});

		swal({
			type: 'error',
			title: 'Gagal...',
			html: msg
		})
	}

	if ($('.layout_success').length>0) {
		var msg = "";

		msg = $('.msg').text()

		swal({
			type: 'success',
			title: 'Sukses',
			html: msg
		})
	}

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

	$('#rw_form').change(function() {
		$('#rt_form').empty();
		$('#rt_form').append('<option value="" selected disabled hidden>Pilih RT</option>');
		var data = "/rw_ajax/" + $(this).val();
		$.ajax({
		    url: data,
		    type:"GET",
		    success:function(msg){
		        $.each(msg, function(i, item) {
		        	$('#rt_form').append('<option value="' + item.id + '">RT ' + item.nama + '</option>');
		        });
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

	// when tambah anggota keluarga and tambah row button is clicked
	$('#tambah_pindah, #tambah_row_pindah').on('click', function() {
		$('#div_pindah').show();
		$('#div_pindah').append('<div class="form-group row">' + 
		        		'<div class="col-md-6">' + 
							'<input type="text" id="nik_form' + i + '" class="form-control nik_form_class" name="nik" placeholder="Masukkan NIK">' + 
						'</div>' + 
						'<div class="col-md-4 col-md-offset-2">' +
							'<button type="button" id="hapus_row" class="btn btn-danger">Hapus</button>' +
						'</div>' +
		        	'</div>');
		i++;
	});

	// when hapus row button is clicked
	$(document).on('click','#hapus_row', function(){
		$(this).closest('div.form-group').remove();
	});

	// kelurahan autocomplete
	//$('#kecamatan_form').easyAutocomplete(options_kecamatan);

	$('#btn_submit').click(function() {
		var list_nik = [];
		var no_kk = $('#no_kk_form').val();

		$('.nik_form_class').each(function(i, obj) {
			if ($(this).val() != "") {
				list_nik.push($(this).val());
			}
		});

		$('#form_kk').append('<input type="hidden" name="list_nik" value="' + list_nik + '">');
		$('#form_kk').append('<input type="hidden" name="no_kk" value="' + no_kk + '">');
	});

	$('#btn_submit_pindah').click(function() {
		var list_nik = [];
		
		$('.nik_form_class').each(function(i, obj) {
			if ($(this).val() != "") {
				list_nik.push($(this).val());
			}
		});

		$('#form_pindah_keluar').append('<input type="hidden" name="list_nik" value="' + list_nik + '">');
	});


	/* SCRIPT ON VIEW KK.EDIT 
	*************************************************************************
	*************************************************************************/
	var j = 0;
	var list_nik_lama = [];
	// when page is located at kk.edit
	if (window.location.href.indexOf("/kk/" + $('#no_kk_form').val() + "/edit") > -1) {
		$.ajax({
		    url: "/kk/" + $('#no_kk_form').val() + "/keluarga_ajax",
		    type:"GET",
		    success:function(msg){
		        $.each(msg, function(i, item) {
		        	list_nik_lama.push(item.id);
		        	$('#div_keluarga_edit').append('<div class="form-group row">' + 
		        		'<div class="col-md-4">' + 
							'<input type="text" value="' + item.id + '" id="nik_form' + j + '" class="form-control nik_form_class" name="nik" placeholder="Masukkan NIK">' + 
						'</div>' + 
						'<div class="col-md-4">' +
							'<input id="nama_form' + j + '" class="form-control" value="' + item.nama + '" placeholder="Nama Lengkap" type="text" name="nama" readonly>' +
						'</div>' +
						'<div class="col-md-4">' +
							'<button type="button" id="hapus_row" class="btn btn-danger">Hapus</button>' +
						'</div>' +
		        	'</div>');
					$('#nik_form' + j).easyAutocomplete(options_nik);
					j++;
		        });

		        if (list_nik_lama.length > 0) {
					$('#form_kk').append('<input type="hidden" name="list_nik_lama" value="' + list_nik_lama + '">');
				}
				else if (list_nik_lama.length == 0) {
					$('#form_kk').append('<input type="hidden" name="list_nik_lama" value="nothing">');
				}
		    },
		    dataType:"json"
		});
	}

	$('#tambah_row_edit').click(function() {
		$('#div_keluarga_edit').append('<div class="form-group row">' + 
		        		'<div class="col-md-4">' + 
							'<input type="text" id="nik_form' + j + '" class="form-control nik_form_class" name="nik" placeholder="Masukkan NIK">' + 
						'</div>' + 
						'<div class="col-md-4">' +
							'<input id="nama_form' + j + '" class="form-control" placeholder="Nama Lengkap" type="text" name="nama" readonly>' +
						'</div>' +
						'<div class="col-md-4">' +
							'<button type="button" id="hapus_row" class="btn btn-danger">Hapus</button>' +
						'</div>' +
		        	'</div>');
		$('#nik_form' + j).easyAutocomplete(options_nik);
		j++;
	});

	$('#btn_submit_edit').click(function() {
		var list_nik = [];
		var no_kk = $('#no_kk_form').val();

		$('.nik_form_class').each(function(i, obj) {
			list_nik.push($(this).val());
		});
		
		if (list_nik.length > 0) {
			$('#form_kk').append('<input type="hidden" name="list_nik" value="' + list_nik + '">');
		}
		else if (list_nik.length == 0) {
			$('#form_kk').append('<input type="hidden" name="list_nik" value="nothing">');
		}
		
		$('#form_kk').append('<input type="hidden" name="no_kk" value="' + no_kk + '">');
	});

	/* SCRIPT ON VIEW PENDUDUK.INSERT 
	******************************************************************************
	******************************************************************************/
		// code for autocomplete kota
  		var options = {
			url: "/penduduk_ajax_kota",
			requestDelay: 1000,
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
					time: 10,
				}
			}
		};

		$("#kota").easyAutocomplete(options);

	/* SCRIPT ON VIEW KK.FILTER 
	******************************************************************************
	******************************************************************************/
	var link = "";
	var countClick = 0;
	var temp_link = "?";

	function filter_kk(e) {
		e.preventDefault();
		countClick = 0;
		var target = $(e.target)

		if ($('#filter_rw').val() != "none") {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "rw=" + $('#filter_rw').val();
			countClick++;
		}
		if ($('#filter_rt').val() != "none") {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "rt=" + $('#filter_rt').val();
			countClick++;
		}
		if ($('#search_val').val() != "") {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "q=" + $('#search_val').val();
			countClick++;
		}
		if (target.is('.page-link')) {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "page=" + target.text();
			countClick++;
		}

		window.location.href = "/kk" + link;
	}

	$('#filter_rw, #filter_rt').change(filter_kk)
	$('#filter_search').click(filter_kk)


	/* SCRIPT ON VIEW PENDUDUK.FILTER 
	******************************************************************************
	******************************************************************************/
	var link = "";
	var countClick = 0;
	var temp_link = "?";

	function filter_penduduk(e) {
		e.preventDefault();
		countClick = 0;
		var target = $(e.target)

		if ($('#filter_jk').val() != "none") {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "jk=" + $('#filter_jk').val();
			countClick++;
		}
		if ($('#filter_pendidikan').val() != "none") {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "pendidikan=" + $('#filter_pendidikan').val();
			countClick++;
		}
		if ($('#filter_pekerjaan').val() != "none") {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "pekerjaan=" + $('#filter_pekerjaan').val();
			countClick++;
		}
		if ($('#filter_hubungan').val() != "none") {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "hubungan=" + $('#filter_hubungan').val();
			countClick++;
		}
		if ($('#filter_agama').val() != "none") {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "agama=" + $('#filter_agama').val();
			countClick++;
		}
		if ($('#filter_usia').val() != "none") {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "usia=" + $('#filter_usia').val();
			countClick++;
		}
		if ($('#search_val_penduduk').val() != "") {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "q=" + $('#search_val_penduduk').val();
			countClick++;
		}
		if (target.is('.page-link')) {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "page=" + target.text();
			countClick++;
		}

		window.location.href = "/penduduk" + link;
	}

	$('#filter_search_penduduk, #filter_advance').click(filter_penduduk);
	$('#filter_reset').click(function() {
		window.location.href = "/penduduk";
	});

	$('.page-link').click(function(e) {
		if (window.location.href.indexOf("/penduduk") > -1) {
			filter_penduduk(e)
		}
		else if (window.location.href.indexOf("/kk") > -1) {
			filter_kk(e)
		}
		else if (window.location.href.indexOf("/sku") > -1) {
			filter_kematian(e)
		}
		else if (window.location.href.indexOf("/sik") > -1) {
			filter_kematian(e)
		}
		else if (window.location.href.indexOf("/skk") > -1) {
			filter_kematian(e)
		}
		else if (window.location.href.indexOf("/skdom") > -1) {
			filter_kematian(e)
		}
		else if (window.location.href.indexOf("/skd") > -1) {
			filter_kematian(e)
		}
		else if (window.location.href.indexOf("/kematian") > -1) {
			filter_kematian(e)
		}
		else if (window.location.href.indexOf("/pindah_masuk") > -1) {
			filter_kematian(e)
		}
		else if (window.location.href.indexOf("/pindah_keluar") > -1) {
			filter_kematian(e)
		}
	})


	/* SCRIPT ON VIEW PENDUDUK.STAT 
	******************************************************************************
	******************************************************************************/
	
	function show_chart(ctx_name, dataLabel, dataCount, chart_type) {
		if (chart_type == "doughnut") {
			var myChart = new Chart(ctx_name, {
				    type: 'doughnut',
				    data: {
				        labels: dataLabel,
				        datasets: [{
				            data: dataCount,
				            backgroundColor: [
				                'rgba(255, 99, 132, 1)',
				                'rgba(54, 162, 235, 1)',
				                'rgba(255, 206, 86, 1)',
				                'rgba(75, 192, 192, 1)',
				                'rgba(153, 102, 255, 1)',
				                'rgba(255, 159, 64, 1)',
				                'rgba(30, 30, 30, 1)',
				                'rgba(95, 146, 99, 1)',
				                'rgba(120, 38, 203, 1)',
				                'rgba(59, 189, 255, 1)',
				                'rgba(208, 189, 255, 1)',
				                'rgba(208, 189, 37, 1)',
				                'rgba(208, 41, 57, 1)',
				                'rgba(41, 113, 74, 1)',
				                'rgba(225, 113, 106, 1)',
				                'rgba(67, 20, 196, 1)',
				                'rgba(230, 255, 56, 1)',
				                'rgba(248, 206, 196, 1)',
				                'rgba(55, 63, 134, 1)',
				                'rgba(114, 123, 86, 1)',
				                'rgba(114, 164, 190, 1)',
				                'rgba(24, 201, 134, 1)',
				                'rgba(139, 201, 255, 1)',
				                'rgba(139, 29, 172, 1)',
				                'rgba(139, 29, 105, 1)',
				                'rgba(139, 125, 105, 1)'
				            ]
				        }]
				    }
				});
		}
		else if (chart_type == "line") {
			var myLineChart = new Chart(ctx_name, {
			    type: 'line',
			    data: {
				    labels: dataLabel,
				    datasets: [{
				    	label:'Jumlah',
				        data: dataCount,
				        borderColor: [
				            'rgba(255, 99, 132, 1)'
				        ]
				    }]
				},
				options: {
			        scales: {
			            yAxes: [{
			                stacked: true
			            }]
			        }
			    }
			});
		}
		else {
			var myChart = new Chart(ctx_name, {
			    type: 'horizontalBar',
			    data: {
			        labels: dataLabel,
			        datasets: [{
			            label: 'Jumlah Penduduk',
			            data: dataCount,
			            backgroundColor: [
			                'rgba(255, 99, 132, 1)',
				                'rgba(54, 162, 235, 1)',
				                'rgba(255, 206, 86, 1)',
				                'rgba(75, 192, 192, 1)',
				                'rgba(153, 102, 255, 1)',
				                'rgba(255, 159, 64, 1)',
				                'rgba(30, 30, 30, 1)',
				                'rgba(95, 146, 99, 1)',
				                'rgba(120, 38, 203, 1)',
				                'rgba(59, 189, 255, 1)',
				                'rgba(208, 189, 255, 1)',
				                'rgba(208, 189, 37, 1)',
				                'rgba(208, 41, 57, 1)',
				                'rgba(41, 113, 74, 1)',
				                'rgba(225, 113, 106, 1)',
				                'rgba(67, 20, 196, 1)',
				                'rgba(230, 255, 56, 1)',
				                'rgba(248, 206, 196, 1)',
				                'rgba(55, 63, 134, 1)',
				                'rgba(114, 123, 86, 1)',
				                'rgba(114, 164, 190, 1)',
				                'rgba(24, 201, 134, 1)',
				                'rgba(139, 201, 255, 1)',
				                'rgba(139, 29, 172, 1)',
				                'rgba(139, 29, 105, 1)',
				                'rgba(139, 125, 105, 1)'
			            ]
			        }]
			    },
			    options: {
			        scales: {
			            yAxes: [{
			                ticks: {
			                    beginAtZero:true
			                }
			            }]
			        }
			    }
			});
		}
	}

	function stat_penduduk_ajax(url, ctx_name, stat_type, chart_type) {
		var dataCount = [];
		var dataLabel = [];
		var bulan_arr = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
		
		$.ajax({
		    url: url,
		    type:"GET",
		    success:function(msg){
		        $.each(msg, function(i, item) {
		        	dataCount.push(item.count);

		        	if (stat_type == "agama")
		        		dataLabel.push(item.get_agama.keterangan);
		        	else if (stat_type == "status_nikah")
		        		dataLabel.push(item.get_status_nikah.keterangan);
		        	else if (stat_type == "pendidikan")
		        		dataLabel.push(item.get_pendidikan.keterangan);
		        	else if (stat_type == "jenis_pekerjaan")
		        		dataLabel.push(item.get_jenis_pekerjaan.keterangan);
		        	else if (stat_type == "status_hubungan")
		        		dataLabel.push(item.get_status_hubungan.keterangan);
		        	else if (stat_type == "usia")
		        		dataLabel.push(item.nama);
		        	else if (stat_type == "rw_keluarga")
		        		dataLabel.push("RW " + item.get_rw.nama);
		        	else if (stat_type == "rt_keluarga")
		        		dataLabel.push("RT " + item.get_rt.nama + " RW " + item.get_rw.nama);
		        	else if (stat_type == "sktm_tahun")
		        		dataLabel.push(bulan_arr[item.month - 1]);
		        	else if (stat_type == "sktm_bulan")
		        		dataLabel.push("Minggu ke-" + item.week);
		        	else if (stat_type == "jk")
		        		dataLabel = ["Laki-Laki", "Perempuan"];
		        });

		        show_chart(ctx_name, dataLabel, dataCount, chart_type);
		    },
		    dataType:"json"
		});  
	}

	if (window.location.href.indexOf("/penduduk/stat") > -1) {
		var ctx_agama = document.getElementById("agama_chart").getContext('2d');
		var ctx_status_nikah = document.getElementById("status_nikah_chart").getContext('2d');
		var ctx_jk = document.getElementById("jk_chart").getContext('2d');
		var ctx_usia = document.getElementById("usia_chart").getContext('2d');
		var ctx_pendidikan = document.getElementById("pendidikan_chart").getContext('2d');
		var ctx_status_hubungan = document.getElementById("status_hubungan_chart").getContext('2d');

		stat_penduduk_ajax('/penduduk/stat_jk_ajax', ctx_jk, "jk", "doughnut");
		stat_penduduk_ajax('/penduduk/stat_usia_ajax', ctx_usia, "usia", "doughnut");
		stat_penduduk_ajax('/penduduk/stat_agama_ajax', ctx_agama, "agama", "doughnut");
		stat_penduduk_ajax('/penduduk/stat_status_nikah_ajax', ctx_status_nikah, "status_nikah", "doughnut");
		stat_penduduk_ajax('/penduduk/stat_pendidikan_ajax', ctx_pendidikan, "pendidikan", "bar");
		stat_penduduk_ajax('/penduduk/stat_status_hubungan_ajax', ctx_status_hubungan, "status_hubungan", "bar");
	}

	
	/* SCRIPT ON VIEW KK.STAT 
	******************************************************************************
	******************************************************************************/
	if (window.location.href.indexOf("/kk/stat") > -1) {
		var ctx_rw_keluarga = document.getElementById("rw_keluarga_chart").getContext('2d');
		var ctx_rt_keluarga = document.getElementById("rt_keluarga_chart").getContext('2d');

		stat_penduduk_ajax('/kk/stat_rt_keluarga_ajax', ctx_rt_keluarga, "rt_keluarga", "bar");
		stat_penduduk_ajax('/kk/stat_rw_keluarga_ajax', ctx_rw_keluarga, "rw_keluarga", "bar");
	}

	/* SCRIPT ON VIEW DASHBOARD 
	******************************************************************************
	******************************************************************************/
	if (document.getElementById("dashboard") != null) {
		var ctx_sik_bulan = document.getElementById("sik_dashboard_bulan").getContext('2d');
		var ctx_sik_tahun = document.getElementById("sik_dashboard_tahun").getContext('2d');
		var ctx_sku_bulan = document.getElementById("sku_dashboard_bulan").getContext('2d');
		var ctx_sku_tahun = document.getElementById("sku_dashboard_tahun").getContext('2d');
		var ctx_skk_bulan = document.getElementById("skk_dashboard_bulan").getContext('2d');
		var ctx_skk_tahun = document.getElementById("skk_dashboard_tahun").getContext('2d');
		var ctx_kematian_bulan = document.getElementById("kematian_dashboard_bulan").getContext('2d');
		var ctx_kematian_tahun = document.getElementById("kematian_dashboard_tahun").getContext('2d');
		var ctx_skd_bulan = document.getElementById("skd_dashboard_bulan").getContext('2d');
		var ctx_skd_tahun = document.getElementById("skd_dashboard_tahun").getContext('2d');
		var ctx_skdom_bulan = document.getElementById("skdom_dashboard_bulan").getContext('2d');
		var ctx_skdom_tahun = document.getElementById("skdom_dashboard_tahun").getContext('2d');

		stat_penduduk_ajax('/stat_sik_tahun', ctx_sik_tahun, "sktm_tahun", "line");
		stat_penduduk_ajax('/stat_sik_bulan', ctx_sik_bulan, "sktm_bulan", "line");
		stat_penduduk_ajax('/stat_sku_tahun', ctx_sku_tahun, "sktm_tahun", "line");
		stat_penduduk_ajax('/stat_sku_bulan', ctx_sku_bulan, "sktm_bulan", "line");
		stat_penduduk_ajax('/stat_skk_tahun', ctx_skk_tahun, "sktm_tahun", "line");
		stat_penduduk_ajax('/stat_skk_bulan', ctx_skk_bulan, "sktm_bulan", "line");
		stat_penduduk_ajax('/stat_kematian_tahun', ctx_kematian_tahun, "sktm_tahun", "line");
		stat_penduduk_ajax('/stat_kematian_bulan', ctx_kematian_bulan, "sktm_bulan", "line");
		stat_penduduk_ajax('/stat_skd_tahun', ctx_skd_tahun, "sktm_tahun", "line");
		stat_penduduk_ajax('/stat_skd_bulan', ctx_skd_bulan, "sktm_bulan", "line");
		stat_penduduk_ajax('/stat_skdom_tahun', ctx_skdom_tahun, "sktm_tahun", "line");
		stat_penduduk_ajax('/stat_skdom_bulan', ctx_skdom_bulan, "sktm_bulan", "line");

		$('#filter_tahun_sktm, #filter_bulan_sktm').on('change', function(e) {
			stat_penduduk_ajax('/stat_sik_tahun?tahun=' + $('#filter_tahun_sktm').val(), ctx_sik_tahun, "sktm_tahun", "line");
			stat_penduduk_ajax('/stat_sik_bulan?tahun=' + $('#filter_tahun_sktm').val() + '&bulan=' + $('#filter_bulan_sktm').val(), ctx_sik_bulan, "sktm_bulan", "line");
			stat_penduduk_ajax('/stat_sku_tahun?tahun=' + $('#filter_tahun_sktm').val(), ctx_sku_tahun, "sktm_tahun", "line");
			stat_penduduk_ajax('/stat_sku_bulan?tahun=' + $('#filter_tahun_sktm').val() + '&bulan=' + $('#filter_bulan_sktm').val(), ctx_sku_bulan, "sktm_bulan", "line");
			stat_penduduk_ajax('/stat_skk_tahun?tahun=' + $('#filter_tahun_sktm').val(), ctx_skk_tahun, "sktm_tahun", "line");
			stat_penduduk_ajax('/stat_skk_bulan?tahun=' + $('#filter_tahun_sktm').val() + '&bulan=' + $('#filter_bulan_sktm').val(), ctx_skk_bulan, "sktm_bulan", "line");
			stat_penduduk_ajax('/stat_kematian_tahun?tahun=' + $('#filter_tahun_sktm').val(), ctx_kematian_tahun, "sktm_tahun", "line");
			stat_penduduk_ajax('/stat_kematian_bulan?tahun=' + $('#filter_tahun_sktm').val() + '&bulan=' + $('#filter_bulan_sktm').val(), ctx_kematian_bulan, "sktm_bulan", "line");
			stat_penduduk_ajax('/stat_skd_tahun?tahun=' + $('#filter_tahun_sktm').val(), ctx_skd_tahun, "sktm_tahun", "line");
			stat_penduduk_ajax('/stat_skd_bulan?tahun=' + $('#filter_tahun_sktm').val() + '&bulan=' + $('#filter_bulan_sktm').val(), ctx_skd_bulan, "sktm_bulan", "line");
			stat_penduduk_ajax('/stat_skdom_tahun?tahun=' + $('#filter_tahun_sktm').val(), ctx_skdom_tahun, "sktm_tahun", "line");
			stat_penduduk_ajax('/stat_skdom_bulan?tahun=' + $('#filter_tahun_sktm').val() + '&bulan=' + $('#filter_bulan_sktm').val(), ctx_skdom_bulan, "sktm_bulan", "line");
		});
	}

	/* SCRIPT ON VIEW PENERBIT.SHOW_ALL 
	******************************************************************************
	******************************************************************************/
	$('#delete_penerbit, #hapus_kematian').on('click', function(e) {
		/*if(!confirm('Apakah anda yakin ingin menghapus data ini?')) {
			e.preventDefault();
		}*/
		e.preventDefault()
		swal({
		 	title: 'Apakah anda yakin?',
			text: "Anda akan menghapus data ini secara permanen.",
			type: 'warning',
		  	showCancelButton: true,
		  	confirmButtonColor: '#3085d6',
		  	cancelButtonColor: '#d33',
		  	confirmButtonText: 'Ya',
		  	cancelButtonText: 'Batal'
		}).then((result) => {
		  	if (result.value) {
		  		window.location = $(this).attr("href")
		  	}
		})
	});

	/* SCRIPT ON VIEW KEMATIAN.INSERT 
	******************************************************************************
	******************************************************************************/
	var options_nik_kematian = {
			url: "/penduduk_ajax_kematian",
			requestDelay: 1000,
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
					time: 10,
				},
				onSelectItemEvent: function() {
					$('#nama_kematian').val("");
					$('#jk_kematian').val("");
					$('#alamat_kematian').val("");

					var value_nama = $('#nik_kematian').getSelectedItemData().nama;
					var value_jk = $('#nik_kematian').getSelectedItemData().jk;
					var value_alamat = $('#nik_kematian').getSelectedItemData().get_kk.alamat;

					if (value_jk == "L") {
						$('#jk_kematian').val("LAKI-LAKI");
					}
					else {
						$('#jk_kematian').val("PEREMPUAN");
					}

					$('#nama_kematian').val(value_nama);
					$('#alamat_kematian').val(value_alamat);
				}
			}
		};

	$('#nik_kematian').easyAutocomplete(options_nik_kematian);

	/* SCRIPT ON VIEW KEMATIAN.FILTER AND PINDAH.FILTER
	******************************************************************************
	******************************************************************************/
	var link = "";
	var countClick = 0;
	var temp_link = "?";

	function filter_kematian(e) {
		e.preventDefault();
		countClick = 0;
		var target = $(e.target);

		if ($('#filter_tahun').val() != "none") {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "tahun=" + $('#filter_tahun').val();
			countClick++;
		}
		if ($('#filter_bulan').val() != "none") {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "bulan=" + $('#filter_bulan').val();
			countClick++;
		}
		if ($('#search_val_kematian').val() != "") {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "q=" + $('#search_val_kematian').val();
			countClick++;
		}
		if (target.is('.page-link')) {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "page=" + target.text();
			countClick++;
		}

		if (window.location.href.indexOf("/kematian") > -1) {
			window.location.href = "/kematian" + link;
		}
		else if (window.location.href.indexOf("/pindah_masuk") > -1) {
			window.location.href = "/pindah_masuk" + link;
		}
		else if (window.location.href.indexOf("/pindah_keluar") > -1) {
			window.location.href = "/pindah_keluar" + link;
		}
		else if (window.location.href.indexOf("/sik") > -1) {
			window.location.href = "/sik" + link;
		}	
		else if (window.location.href.indexOf("/skdom") > -1) {
			window.location.href = "/skdom" + link;
		}
		else if (window.location.href.indexOf("/sklp") > -1) {
			window.location.href = "/sklp" + link;
		}
		else if (window.location.href.indexOf("/skwn") > -1) {
			window.location.href = "/skwn" + link;
		}
		else if (window.location.href.indexOf("/skkb") > -1) {
			window.location.href = "/skkb" + link;
		}
		else if (window.location.href.indexOf("/skd") > -1) {
			window.location.href = "/skd" + link;
		}	
		else if (window.location.href.indexOf("/sku") > -1) {
			window.location.href = "/sku" + link;
		}	
		else if (window.location.href.indexOf("/skk") > -1) {
			window.location.href = "/skk" + link;
		}	
	}

	$('#filter_tahun, #filter_bulan').on('change', filter_kematian);
	$('#filter_search_kematian').click(filter_kematian);


	/* SCRIPT ON VIEW PINDAH.INSERT 
	******************************************************************************
	******************************************************************************/
	var options_nik_pindah = {
			url: "/penduduk_ajax_kematian",
			requestDelay: 1000,
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
					time: 10,
				},
				onSelectItemEvent: function() {
					$('#nama_form').val("");

					var value_nama = $('#nik_form').getSelectedItemData().nama;

					$('#nama_form').val(value_nama);
				}
			}
		};

	$('#nik_pindah').easyAutocomplete(options_nik_pindah);


	/* SCRIPT ON VIEW SURAT.INSERT 
	******************************************************************************
	******************************************************************************/
	var options_nik_surat = {
			url: "/penduduk_ajax_kematian",
			requestDelay: 1000,
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
					time: 10,
				},
				onSelectItemEvent: function() {
					$('#nama_surat').val("");
					$('#ttl_surat').val("");
					$('#jk_surat').val("");
					$('#kewarganegaraan_surat').val("");
					$('#agama_surat').val("");
					$('#alamat_surat').val("");

					if ($('#nik_surat').getSelectedItemData().get_kk != null) {
						var value_alamat = $('#nik_surat').getSelectedItemData().get_kk.alamat;
						$('#alamat_surat').val(value_alamat);
					}
					else {
						$('#alamat_surat').val("-");
					}

					var temp_tempat_lahir = $('#nik_surat').getSelectedItemData().get_tempat_lahir.nama;
					var value_tempat_lahir = temp_tempat_lahir.substr(temp_tempat_lahir.indexOf(" ") + 1);
					var arr_tgl_lahir = $('#nik_surat').getSelectedItemData().tgl_lahir.split('-');
					var value_tgl_lahir = arr_tgl_lahir[2] + '-' + arr_tgl_lahir[1] + '-' + arr_tgl_lahir[0];
					var value_ttl = value_tempat_lahir + ', ' + value_tgl_lahir;
					var value_nama = $('#nik_surat').getSelectedItemData().nama;
					var value_agama = $('#nik_surat').getSelectedItemData().get_agama.keterangan;
					var value_jk = $('#nik_surat').getSelectedItemData().jk;
					var value_kewarganegaraan = $('#nik_surat').getSelectedItemData().kewarganegaraan;

					if (value_jk == "L") {
						$('#jk_surat').val("LAKI-LAKI");
					}
					else {
						$('#jk_surat').val("PEREMPUAN");
					}

					$('#nama_surat').val(value_nama);
					$('#kewarganegaraan_surat').val(value_kewarganegaraan);
					$('#ttl_surat').val(value_ttl);
					$('#agama_surat').val(value_agama);
				}
			}
		};

	$('#nik_surat').easyAutocomplete(options_nik_surat);

	/* SCRIPT ON VIEW KELAHIRAN.INSERT (DATA AYAH) 
	******************************************************************************
	******************************************************************************/
	var options_nik_ayah = {
			url: "/penduduk_ajax_kematian",
			requestDelay: 1000,
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
					time: 10,
				},
				onSelectItemEvent: function() {
					$('#nama_ayah').val("");
					$('#ttl_ayah').val("");
					$('#jk_ayah').val("");
					$('#kewarganegaraan_ayah').val("");
					$('#agama_ayah').val("");
					$('#alamat_ayah').val("");

					if ($('#nik_ayah').getSelectedItemData().get_kk != null) {
						var value_alamat = $('#nik_ayah').getSelectedItemData().get_kk.alamat;
						$('#alamat_ayah').val(value_alamat);
					}
					else {
						$('#alamat_ayah').val("-");
					}

					var temp_tempat_lahir = $('#nik_ayah').getSelectedItemData().get_tempat_lahir.nama;
					var value_tempat_lahir = temp_tempat_lahir.substr(temp_tempat_lahir.indexOf(" ") + 1);
					var arr_tgl_lahir = $('#nik_ayah').getSelectedItemData().tgl_lahir.split('-');
					var value_tgl_lahir = arr_tgl_lahir[2] + '-' + arr_tgl_lahir[1] + '-' + arr_tgl_lahir[0];
					var value_ttl = value_tempat_lahir + ', ' + value_tgl_lahir;
					var value_nama = $('#nik_ayah').getSelectedItemData().nama;
					var value_agama = $('#nik_ayah').getSelectedItemData().get_agama.keterangan;
					var value_jk = $('#nik_ayah').getSelectedItemData().jk;
					var value_kewarganegaraan = $('#nik_ayah').getSelectedItemData().kewarganegaraan;

					if (value_jk == "L") {
						$('#jk_ayah').val("LAKI-LAKI");
					}
					else {
						$('#jk_ayah').val("PEREMPUAN");
					}

					$('#nama_ayah').val(value_nama);
					$('#kewarganegaraan_ayah').val(value_kewarganegaraan);
					$('#ttl_ayah').val(value_ttl);
					$('#agama_ayah').val(value_agama);
				}
			}
		};

	$('#nik_ayah').easyAutocomplete(options_nik_ayah);

	/* SCRIPT ON VIEW SURAT.INSERT 
	******************************************************************************
	******************************************************************************/
	var options_nik_pelapor = {
			url: "/penduduk_ajax_kematian",
			requestDelay: 1000,
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
					time: 10,
				},
				onSelectItemEvent: function() {
					$('#nama_pelapor').val("");
					$('#ttl_pelapor').val("");
					$('#jk_pelapor').val("");
					$('#kewarganegaraan_pelapor').val("");
					$('#agama_pelapor').val("");
					$('#alamat_pelapor').val("");

					if ($('#nik_pelapor').getSelectedItemData().get_kk != null) {
						var value_alamat = $('#nik_pelapor').getSelectedItemData().get_kk.alamat;
						$('#alamat_pelapor').val(value_alamat);
					}
					else {
						$('#alamat_pelapor').val("-");
					}

					var temp_tempat_lahir = $('#nik_pelapor').getSelectedItemData().get_tempat_lahir.nama;
					var value_tempat_lahir = temp_tempat_lahir.substr(temp_tempat_lahir.indexOf(" ") + 1);
					var arr_tgl_lahir = $('#nik_pelapor').getSelectedItemData().tgl_lahir.split('-');
					var value_tgl_lahir = arr_tgl_lahir[2] + '-' + arr_tgl_lahir[1] + '-' + arr_tgl_lahir[0];
					var value_ttl = value_tempat_lahir + ', ' + value_tgl_lahir;
					var value_nama = $('#nik_pelapor').getSelectedItemData().nama;
					var value_agama = $('#nik_pelapor').getSelectedItemData().get_agama.keterangan;
					var value_jk = $('#nik_pelapor').getSelectedItemData().jk;
					var value_kewarganegaraan = $('#nik_pelapor').getSelectedItemData().kewarganegaraan;

					if (value_jk == "L") {
						$('#jk_pelapor').val("LAKI-LAKI");
					}
					else {
						$('#jk_pelapor').val("PEREMPUAN");
					}

					$('#nama_pelapor').val(value_nama);
					$('#kewarganegaraan_pelapor').val(value_kewarganegaraan);
					$('#ttl_pelapor').val(value_ttl);
					$('#agama_pelapor').val(value_agama);
				}
			}
		};

	$('#nik_pelapor').easyAutocomplete(options_nik_pelapor);


	/* SCRIPT TO CUSTOMIZE DATEPICKER
	******************************************************************************
	******************************************************************************/
	$("#date_custom").change(function() {
		var arr_bln = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
		var date = new Date($(this).val());
		var tgl = date.getDate();
		var bln = arr_bln[date.getMonth()];
		var thn = date.getFullYear();
		var str = tgl + " " + bln + " " + thn;

		$('#date_dummy').val(str);
		$('#div_dummy').show();
		$(this).hide();
	});

	$("#button_dummy").click(function(e) {
		e.preventDefault();
		$('#div_dummy').hide();
		$("#date_custom").show();
	});

	$("#date_custom2").change(function() {
		var arr_bln = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
		var date = new Date($(this).val());
		var tgl = date.getDate();
		var bln = arr_bln[date.getMonth()];
		var thn = date.getFullYear();
		var str = tgl + " " + bln + " " + thn;

		$('#date_dummy2').val(str);
		$('#div_dummy2').show();
		$(this).hide();
	});

	$("#button_dummy2").click(function(e) {
		e.preventDefault();
		$('#div_dummy2').hide();
		$("#date_custom2").show();
	});

	/* SCRIPT ON PENDUDUK.INSERT
	******************************************************************************
	******************************************************************************/
	$("#agama_form").change(function() {
		selected_id = $("#agama_form").val();
		if(selected_id == 7) {
			$('#agama_optional').css('display', 'block');
		}
		else {
			$('#agama_optional').css('display', 'none');
		}
	});

	$("#cacat_form").change(function() {
		selected_id = $("#cacat_form").val();
		if(selected_id == 1) {
			$('#cacat_optional').css('display', 'block');
		}
		else {
			$('#cacat_optional').css('display', 'none');
		}
	});

	$('#pindah_satu_keluarga').change(function(){
    if($(this).is(':checked')) {
        $('#tambah_pindah').attr('disabled', 'true')
        $('#nomor_kk').removeAttr('disabled')
    } else {
        $('#nomor_kk').attr('disabled', 'true')
        $('#tambah_pindah').removeAttr('disabled')
    }
});
});