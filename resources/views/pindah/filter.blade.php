<?php
	use Carbon\Carbon;

	$now = Carbon::now();
	$year = $now->year;

	$diff = $year - 2018;
	$count_year = 2018;
?>

<div class="filter form-inline">
		<div class="input-group form-group col-md-offset-3 col-md-3">
	        <input type="text" class="form-control" placeholder="Search..." id="search_val_kematian" value="{{ $search_term }}">
	        <span class="input-group-btn">
	            <button class="btn btn-default" type="button" id="filter_search_kematian">
	                <i class="fa fa-search"></i>
	            </button>
	        </span>
	    </div>
	    <div class="form-group col-md-3">
	    	<select name="rw" id="filter_tahun" class="form-control" style="width: 100%">
		    	<option value="none">-- Seluruh Tahun --</option>
		    	<?php
		    		do { 
		    			$diff = $year - $count_year;
		    		?>
		    		
		    			@if($tahun_choose == $count_year)
		    				<option value="{{ $count_year }}" selected>{{ $count_year }}</option>
		    			@else
		    				<option value="{{ $count_year }}">{{ $count_year }}</option>
		    			@endif
		    			<?php
		    				$count_year = $count_year + 1;
		    		} while ($diff != 0);
		    	?>
		    </select>
	    </div>
	    <div class="form-group col-md-3">
	    	<select name="rt" id="filter_bulan" class="form-control" style="width: 100%">
		    	<option value="none">-- Seluruh Bulan --</option>
		    	@if($bulan_choose == 1)
		    		<option value="1" selected>Januari</option>
		    	@else
		    		<option value="1">Januari</option>
		    	@endif
		    	@if($bulan_choose == 2)
		    		<option value="2" selected>Februari</option>
		    	@else
		    		<option value="2">Februari</option>
		    	@endif
		    	@if($bulan_choose == 3)
		    		<option value="3" selected>Maret</option>
		    	@else
		    		<option value="3">Maret</option>
		    	@endif
		    	@if($bulan_choose == 4)
		    		<option value="4" selected>April</option>
		    	@else
		    		<option value="4">April</option>
		    	@endif
		    	@if($bulan_choose == 5)
		    		<option value="5" selected>Mei</option>
		    	@else
		    		<option value="5">Mei</option>
		    	@endif
		    	@if($bulan_choose == 6)
		    		<option value="6" selected>Juni</option>
		    	@else
		    		<option value="6">Juni</option>
		    	@endif
		    	@if($bulan_choose == 7)
		    		<option value="7" selected>Juli</option>
		    	@else
		    		<option value="7">Juli</option>
		    	@endif
		    	@if($bulan_choose == 8)
		    		<option value="8" selected>Agustus</option>
		    	@else
		    		<option value="8">Agustus</option>
		    	@endif
		    	@if($bulan_choose == 9)
		    		<option value="9" selected>September</option>
		    	@else
		    		<option value="9">September</option>
		    	@endif
		    	@if($bulan_choose == 10)
		    		<option value="10" selected>Oktober</option>
		    	@else
		    		<option value="10">Oktober</option>
		    	@endif
		    	@if($bulan_choose == 11)
		    		<option value="11" selected>November</option>
		    	@else
		    		<option value="11">November</option>
		    	@endif
		    	@if($bulan_choose == 12)
		    		<option value="12" selected>Desember</option>
		    	@else
		    		<option value="12">Desember</option>
		    	@endif
		    </select>
	    </div>
	</div>