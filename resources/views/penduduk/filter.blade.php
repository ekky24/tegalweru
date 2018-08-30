<div class="filter form-inline">
		<div class="input-group form-group col-md-2">
	        <input type="text" class="form-control" placeholder="Search..." id="search_val_penduduk" value="{{ $search_term }}">
	        <span class="input-group-btn">
	            <button class="btn btn-default" type="button" id="filter_search_penduduk">
	                <i class="fa fa-search"></i>
	            </button>
	        </span>
	    </div>
	    <div class="form-group col-md-2">
	    	<select name="rw" id="filter_jk" class="form-control" style="width: 100%">
		    	<option value="none">Jenis Kelamin</option>
		    	@if($jk_choose != "")
		    		@if($jk_choose == 'L')
		    			<option value="L" selected>Laki-Laki</option>
		    			<option value="P">Perempuan</option>
		    		@else
		    			<option value="L">Laki-Laki</option>
		    			<option value="P" selected>Perempuan</option>
		    		@endif
		    	@else
		    		<option value="L">Laki-Laki</option>
		    		<option value="P">Perempuan</option>
		    	@endif
		    </select>
	    </div>
	    <div class="form-group col-md-2">
	    	<select name="rt" id="filter_pendidikan" class="form-control" style="width: 100%">
		    	<option value="none">-- Pendidikan --</option>
		    	@if($pendidikan_choose != "")
		    		@foreach($pendidikan as $row)
		    			@if($row->id == $pendidikan_choose)
		    				<option value="{{ $row->id }}" selected>{{ $row->keterangan }}</option>
		    			@else
		    				<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
		    			@endif
		    		@endforeach
		    	@else
		    		@foreach($pendidikan as $row)
			    		<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
			    	@endforeach
		    	@endif
		    </select>
	    </div>
	    <div class="form-group col-md-2">
	    	<select name="rt" id="filter_pekerjaan" class="form-control" style="width: 100%">
		    	<option value="none">-- Pekerjaan --</option>
		    	@if($pekerjaan_choose != "")
		    		@foreach($pekerjaan as $row)
		    			@if($row->id == $pekerjaan_choose)
		    				<option value="{{ $row->id }}" selected>{{ $row->keterangan }}</option>
		    			@else
		    				<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
		    			@endif
		    		@endforeach
		    	@else
		    		@foreach($pekerjaan as $row)
			    		<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
			    	@endforeach
		    	@endif
		    </select>
	    </div>
	    <div class="form-group col-md-2">
	    	<select name="rt" id="filter_agama" class="form-control" style="width: 100%">
		    	<option value="none">-- Agama --</option>
		    	@if($agama_choose != "")
		    		@foreach($agama as $row)
		    			@if($row->id == $agama_choose)
		    				<option value="{{ $row->id }}" selected>{{ $row->keterangan }}</option>
		    			@else
		    				<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
		    			@endif
		    		@endforeach
		    	@else
		    		@foreach($agama as $row)
			    		<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
			    	@endforeach
		    	@endif
		    </select>
	    </div>
	    <div class="form-group col-md-2">
	    	<select name="rt" id="filter_hubungan" class="form-control" style="width: 100%">
		    	<option value="none">-- Hubungan --</option>
		    	@if($hubungan_choose != "")
		    		@foreach($hubungan as $row)
		    			@if($row->id == $hubungan_choose)
		    				<option value="{{ $row->id }}" selected>{{ $row->keterangan }}</option>
		    			@else
		    				<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
		    			@endif
		    		@endforeach
		    	@else
		    		@foreach($hubungan as $row)
			    		<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
			    	@endforeach
		    	@endif
		    </select>
	    </div>
	</div>