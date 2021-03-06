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
				onSelectItemEvent: function() {$('#nama_surat').val("");
					$(':focus').closest('div.col-md-4').next().children().val("");

					var value = $(':focus').getSelectedItemData().nama;
					$(':focus').closest('div.col-md-4').next().children().val(value);
				}
			}
		};

		var options_nik_kepala = {
			url: "/penduduk_ajax_nik_kepala",
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

	/* SCRIPT ON VIEW KK.FILTER 
	******************************************************************************
	******************************************************************************/

	$('#filter_rw').change(function() {
		if ($(this).val() == "none") {
			window.location.href = "/kk";
		}
		else {
			window.location.href = "/kk?rw=" + $(this).val();
		}
	
	});

	$('#filter_rt').change(function() {
		if ($(this).val() == "none") {
			window.location.href = "/kk?rw=" + $('#filter_rw').val();
		}
		else {
			window.location.href = "/kk?rw=" + $('#filter_rw').val() + "&rt=" + $(this).val();
		}
	
	});

	$('#filter_search').click(function() {
		if ($('#filter_rt').val() != "none") {
			window.location.href = "/kk?rw=" + $('#filter_rw').val() + "&rt=" + $('#filter_rt').val() +
			"&q=" + $('#search_val').val();
		}
		else if ($('#filter_rw').val() != "none") {
			window.location.href = "/kk?rw=" + $('#filter_rw').val() + "&q=" + $('#search_val').val();
		}
		else {
			window.location.href = "/kk?q=" + $('#search_val').val();
		}
	});


	/* SCRIPT ON VIEW PENDUDUK.FILTER 
	******************************************************************************
	******************************************************************************/
	var link = "";
	var countClick = 0;
	var temp_link = "?";

	function filter_penduduk() {
		countClick = 0;

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
		if ($('#search_val_penduduk').val() != "") {
			if (countClick > 0) {
				temp_link = "&";
			}
			link += temp_link + "q=" + $('#search_val_penduduk').val();
			countClick++;
		}

		window.location.href = "/penduduk" + link;
	}

	$('#filter_jk, #filter_pendidikan, #filter_pekerjaan, #filter_hubungan, #filter_agama').on('change', filter_penduduk);
	$('#filter_search_penduduk').click(filter_penduduk);


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
		        	else if (stat_type == "kewarganegaraan")
		        		dataLabel = ["WNA", "WNI"];
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
		var ctx_kewarganegaraan = document.getElementById("kewarganegaraan_chart").getContext('2d');
		var ctx_pendidikan = document.getElementById("pendidikan_chart").getContext('2d');
		var ctx_jenis_pekerjaan = document.getElementById("jenis_pekerjaan_chart").getContext('2d');
		var ctx_status_hubungan = document.getElementById("status_hubungan_chart").getContext('2d');

		stat_penduduk_ajax('/penduduk/stat_jk_ajax', ctx_jk, "jk", "doughnut");
		stat_penduduk_ajax('/penduduk/stat_usia_ajax', ctx_usia, "usia", "doughnut");
		stat_penduduk_ajax('/penduduk/stat_agama_ajax', ctx_agama, "agama", "doughnut");
		stat_penduduk_ajax('/penduduk/stat_status_nikah_ajax', ctx_status_nikah, "status_nikah", "doughnut");
		stat_penduduk_ajax('/penduduk/stat_kewarganegaraan_ajax', ctx_kewarganegaraan, "kewarganegaraan", "doughnut");
		stat_penduduk_ajax('/penduduk/stat_pendidikan_ajax', ctx_pendidikan, "pendidikan", "bar");
		stat_penduduk_ajax('/penduduk/stat_jenis_pekerjaan_ajax', ctx_jenis_pekerjaan, "jenis_pekerjaan", "bar");
		stat_penduduk_ajax('/penduduk/stat_status_hubungan_ajax', ctx_status_hubungan, "status_hubungan", "bar");
	}

	
	/* SCRIPT ON VIEW KK.STAT 
	******************************************************************************
	******************************************************************************/
	if (window.location.href.indexOf("/kk/stat") > -1) {
		var ctx_rw_keluarga = document.getElementById("rw_keluarga_chart").getContext('2d');
		var ctx_rt_keluarga = document.getElementById("rt_keluarga_chart").getContext('2d');

		stat_penduduk_ajax('/kk/stat_rt_keluarga_ajax', ctx_rt_keluarga, "rt_keluarga", "doughnut");
		stat_penduduk_ajax('/kk/stat_rw_keluarga_ajax', ctx_rw_keluarga, "rw_keluarga", "doughnut");
	}

	/* SCRIPT ON VIEW DASHBOARD 
	******************************************************************************
	******************************************************************************/
	if (document.getElementById("dashboard") != null) {
		var ctx_sktm_bulan = document.getElementById("sktm_dashboard_bulan").getContext('2d');
		var ctx_sktm_tahun = document.getElementById("sktm_dashboard_tahun").getContext('2d');
		var ctx_sku_bulan = document.getElementById("sku_dashboard_bulan").getContext('2d');
		var ctx_sku_tahun = document.getElementById("sku_dashboard_tahun").getContext('2d');
		var ctx_skk_bulan = document.getElementById("skk_dashboard_bulan").getContext('2d');
		var ctx_skk_tahun = document.getElementById("skk_dashboard_tahun").getContext('2d');
		var ctx_skkl_bulan = document.getElementById("skkl_dashboard_bulan").getContext('2d');
		var ctx_skkl_tahun = document.getElementById("skkl_dashboard_tahun").getContext('2d');
		var ctx_skd_bulan = document.getElementById("skd_dashboard_bulan").getContext('2d');
		var ctx_skd_tahun = document.getElementById("skd_dashboard_tahun").getContext('2d');
		var ctx_skwn_bulan = document.getElementById("skwn_dashboard_bulan").getContext('2d');
		var ctx_skwn_tahun = document.getElementById("skwn_dashboard_tahun").getContext('2d');
		var ctx_sklp_bulan = document.getElementById("sklp_dashboard_bulan").getContext('2d');
		var ctx_sklp_tahun = document.getElementById("sklp_dashboard_tahun").getContext('2d');

		stat_penduduk_ajax('/stat_sktm_tahun', ctx_sktm_tahun, "sktm_tahun", "line");
		stat_penduduk_ajax('/stat_sktm_bulan', ctx_sktm_bulan, "sktm_bulan", "line");
		stat_penduduk_ajax('/stat_sku_tahun', ctx_sku_tahun, "sktm_tahun", "line");
		stat_penduduk_ajax('/stat_sku_bulan', ctx_sku_bulan, "sktm_bulan", "line");
		stat_penduduk_ajax('/stat_skk_tahun', ctx_skk_tahun, "sktm_tahun", "line");
		stat_penduduk_ajax('/stat_skk_bulan', ctx_skk_bulan, "sktm_bulan", "line");
		stat_penduduk_ajax('/stat_skkl_tahun', ctx_skkl_tahun, "sktm_tahun", "line");
		stat_penduduk_ajax('/stat_skkl_bulan', ctx_skkl_bulan, "sktm_bulan", "line");
		stat_penduduk_ajax('/stat_skd_tahun', ctx_skd_tahun, "sktm_tahun", "line");
		stat_penduduk_ajax('/stat_skd_bulan', ctx_skd_bulan, "sktm_bulan", "line");
		stat_penduduk_ajax('/stat_skwn_tahun', ctx_skwn_tahun, "sktm_tahun", "line");
		stat_penduduk_ajax('/stat_skwn_bulan', ctx_skwn_bulan, "sktm_bulan", "line");
		stat_penduduk_ajax('/stat_sklp_tahun', ctx_sklp_tahun, "sktm_tahun", "line");
		stat_penduduk_ajax('/stat_sklp_bulan', ctx_sklp_bulan, "sktm_bulan", "line");

		$('#filter_tahun_sktm, #filter_bulan_sktm').on('change', function(e) {
			stat_penduduk_ajax('/stat_sktm_tahun?tahun=' + $('#filter_tahun_sktm').val(), ctx_sktm_tahun, "sktm_tahun", "line");
			stat_penduduk_ajax('/stat_sktm_bulan?tahun=' + $('#filter_tahun_sktm').val() + '&bulan=' + $('#filter_bulan_sktm').val(), ctx_sktm_bulan, "sktm_bulan", "line");
			stat_penduduk_ajax('/stat_sku_tahun?tahun=' + $('#filter_tahun_sktm').val(), ctx_sku_tahun, "sktm_tahun", "line");
			stat_penduduk_ajax('/stat_sku_bulan?tahun=' + $('#filter_tahun_sktm').val() + '&bulan=' + $('#filter_bulan_sktm').val(), ctx_sku_bulan, "sktm_bulan", "line");
			stat_penduduk_ajax('/stat_skk_tahun?tahun=' + $('#filter_tahun_sktm').val(), ctx_skk_tahun, "sktm_tahun", "line");
			stat_penduduk_ajax('/stat_skk_bulan?tahun=' + $('#filter_tahun_sktm').val() + '&bulan=' + $('#filter_bulan_sktm').val(), ctx_skk_bulan, "sktm_bulan", "line");
			stat_penduduk_ajax('/stat_skkl_tahun?tahun=' + $('#filter_tahun_sktm').val(), ctx_skkl_tahun, "sktm_tahun", "line");
			stat_penduduk_ajax('/stat_skkl_bulan?tahun=' + $('#filter_tahun_sktm').val() + '&bulan=' + $('#filter_bulan_sktm').val(), ctx_skkl_bulan, "sktm_bulan", "line");
			stat_penduduk_ajax('/stat_skd_tahun?tahun=' + $('#filter_tahun_sktm').val(), ctx_skd_tahun, "sktm_tahun", "line");
			stat_penduduk_ajax('/stat_skd_bulan?tahun=' + $('#filter_tahun_sktm').val() + '&bulan=' + $('#filter_bulan_sktm').val(), ctx_skd_bulan, "sktm_bulan", "line");
			stat_penduduk_ajax('/stat_skwn_tahun?tahun=' + $('#filter_tahun_sktm').val(), ctx_skwn_tahun, "sktm_tahun", "line");
			stat_penduduk_ajax('/stat_skwn_bulan?tahun=' + $('#filter_tahun_sktm').val() + '&bulan=' + $('#filter_bulan_sktm').val(), ctx_skwn_bulan, "sktm_bulan", "line");
			stat_penduduk_ajax('/stat_sklp_tahun?tahun=' + $('#filter_tahun_sktm').val(), ctx_sklp_tahun, "sktm_tahun", "line");
			stat_penduduk_ajax('/stat_sklp_bulan?tahun=' + $('#filter_tahun_sktm').val() + '&bulan=' + $('#filter_bulan_sktm').val(), ctx_sklp_bulan, "sktm_bulan", "line");
		});
	}

	/* SCRIPT ON VIEW PENERBIT.SHOW_ALL 
	******************************************************************************
	******************************************************************************/
	$('#delete_penerbit, #hapus_kematian').on('click', function(e) {
		if(!confirm('Apakah anda yakin ingin menghapus data ini?')) {
			e.preventDefault();
		}
	});

	/* SCRIPT ON VIEW KEMATIAN.INSERT 
	******************************************************************************
	******************************************************************************/
	var options_nik_kematian = {
			url: "/penduduk_ajax_kematian",
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
					$('#nama_kematian').val("");
					$('#jk_kematian').val("");
					$('#no_kk_kematian').val("");

					var value_nama = $('#nik_kematian').getSelectedItemData().nama;
					var value_jk = $('#nik_kematian').getSelectedItemData().jk;
					var value_no_kk = $('#nik_kematian').getSelectedItemData().kk_id;

					$('#nama_kematian').val(value_nama);
					$('#jk_kematian').val(value_jk);
					$('#no_kk_kematian').val(value_no_kk);
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

	function filter_kematian() {
		countClick = 0;

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

		if (window.location.href.indexOf("/kematian") > -1) {
			window.location.href = "/kematian" + link;
		}
		else if (window.location.href.indexOf("/pindah") > -1) {
			window.location.href = "/pindah" + link;
		}
		else if (window.location.href.indexOf("/sktm") > -1) {
			window.location.href = "/sktm" + link;
		}	
		else if (window.location.href.indexOf("/skkl") > -1) {
			window.location.href = "/skkl" + link;
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
					$('#nama_pindah').val("");
					$('#jk_pindah').val("");

					var value_nama = $('#nik_pindah').getSelectedItemData().nama;
					var value_jk = $('#nik_pindah').getSelectedItemData().jk;

					$('#nama_pindah').val(value_nama);
					$('#jk_pindah').val(value_jk);
				}
			}
		};

	$('#nik_pindah').easyAutocomplete(options_nik_pindah);


	/* SCRIPT ON VIEW SURAT.INSERT 
	******************************************************************************
	******************************************************************************/
	var options_nik_surat = {
			url: "/penduduk_ajax_kematian",
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
					$('#nama_surat').val("");
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

					var value_nama = $('#nik_surat').getSelectedItemData().nama;
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
				}
			}
		};

	$('#nik_surat').easyAutocomplete(options_nik_surat);


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
});