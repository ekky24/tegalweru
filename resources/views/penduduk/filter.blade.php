<div class="filter form-inline">
		<div class="input-group form-group col-md-4">
	        <input type="text" class="form-control" placeholder="Search..." id="search_val_penduduk" value="{{ $search_term }}">
	        <span class="input-group-btn">
	            <button class="btn btn-default" type="button" id="filter_search_penduduk">
	                <i class="fa fa-search"></i>
	            </button>
	        </span>
	    </div>
	    <button class="btn btn-primary" id="btn-advance" data-toggle="modal" data-target="#modalAdvance">Advance</button>
	    <div class="modal fade" id="modalAdvance" role="dialog">
		    <div class="modal-dialog">
		    	<div class="modal-content">
		    	<div class="modal-header">
		    		<button type="button" class="close" data-dismiss="modal">&times;</button>
		    		<h4 class="modal-title">Advance Search</h4>
		    	</div>
		        <div class="modal-body">
		        	<form class="form-horizontal">
		        		<div class="form-group" style="width: 100%">
			          	<label class="control-label col-sm-4">Jenis Kelamin</label>
			          	<div class="col-sm-8">
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
						</div>
					    <div class="form-group" style="width: 100%">
					    	<label class="control-label col-sm-4">Pendidikan</label>
			          		<div class="col-sm-8">
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
					    </div><br>
					    <div class="form-group" style="width: 100%">
					    	<label class="control-label col-sm-4">Pekerjaan</label>
			          		<div class="col-sm-8">
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
					    </div><br>
					    <div class="form-group" style="width: 100%">
					    	<label class="control-label col-sm-4">Agama</label>
			          		<div class="col-sm-8">
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
					    </div><br>
					    <div class="form-group" style="width: 100%">
					    	<label class="control-label col-sm-4">Hubungan</label>
			          		<div class="col-sm-8">
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
					    <div class="form-group" style="width: 100%">
					    	<label class="control-label col-sm-4">Usia</label>
			          		<div class="col-sm-8">
			          			<select name="rt" id="filter_usia" class="form-control" style="width: 100%">
							    	<option value="none">-- Usia --</option>
							    	@if($usia_choose != "")
							    		@if($usia_choose == 0)
							    			<option value="0" selected>Kurang dari 10</option>
							    			<option value="1">10-19</option>
									    	<option value="2">20-29</option>
									    	<option value="3">30-39</option>
									    	<option value="4">40-49</option>
									    	<option value="5">50-59</option>
									    	<option value="6">60-69</option>
									    	<option value="7">Lebih dari 70</option>
							    		@elseif($usia_choose == 1)
							    			<option value="0">Kurang dari 10</option>
							    			<option value="1" selected>10-19</option>
							    			<option value="2">20-29</option>
									    	<option value="3">30-39</option>
									    	<option value="4">40-49</option>
									    	<option value="5">50-59</option>
									    	<option value="6">60-69</option>
									    	<option value="7">Lebih dari 70</option>
							    		@elseif($usia_choose == 2)
							    			<option value="0">Kurang dari 10</option>
							    			<option value="1">10-19</option>
							    			<option value="2" selected>20-29</option>
									    	<option value="3">30-39</option>
									    	<option value="4">40-49</option>
									    	<option value="5">50-59</option>
									    	<option value="6">60-69</option>
									    	<option value="7">Lebih dari 70</option>
							    		@elseif($usia_choose == 3)
							    			<option value="0">Kurang dari 10</option>
							    			<option value="1">10-19</option>
							    			<option value="2">20-29</option>
									    	<option value="3" selected>30-39</option>
									    	<option value="4">40-49</option>
									    	<option value="5">50-59</option>
									    	<option value="6">60-69</option>
									    	<option value="7">Lebih dari 70</option>
							    		@elseif($usia_choose == '4')
							    			<option value="0">Kurang dari 10</option>
							    			<option value="1">10-19</option>
							    			<option value="2">20-29</option>
									    	<option value="3">30-39</option>
									    	<option value="4" selected>40-49</option>
									    	<option value="5">50-59</option>
									    	<option value="6">60-69</option>
									    	<option value="7">Lebih dari 70</option>
							    		@elseif($usia_choose == 5)
							    			<option value="0">Kurang dari 10</option>
							    			<option value="1">10-19</option>
							    			<option value="2">20-29</option>
									    	<option value="3">30-39</option>
									    	<option value="4">40-49</option>
									    	<option value="5" selected>50-59</option>
									    	<option value="6">60-69</option>
									    	<option value="7">Lebih dari 70</option>
							    		@elseif($usia_choose == 6)
							    			<option value="0">Kurang dari 10</option>
							    			<option value="1">10-19</option>
							    			<option value="2">20-29</option>
									    	<option value="3">30-39</option>
									    	<option value="4">40-49</option>
									    	<option value="5">50-59</option>
									    	<option value="6" selected>60-69</option>
									    	<option value="7">Lebih dari 70</option>
							    		@elseif($usia_choose == 7)
							    			<option value="0">Kurang dari 10</option>
							    			<option value="1">10-19</option>
							    			<option value="2">20-29</option>
									    	<option value="3">30-39</option>
									    	<option value="4">40-49</option>
									    	<option value="5">50-59</option>
									    	<option value="6">60-69</option>
									    	<option value="7" selected>Lebih dari 70</option>
							    		@endif
							    	@else
							    		<option value="0">Kurang dari 10</option>
								    	<option value="1">10-19</option>
								    	<option value="2">20-29</option>
								    	<option value="3">30-39</option>
								    	<option value="4">40-49</option>
								    	<option value="5">50-59</option>
								    	<option value="6">60-69</option>
								    	<option value="7">Lebih dari 70</option>
							    	@endif
							    	
							    </select>
			          		</div>
					    </div>
		        	</form>
		        </div>
		        <div class="modal-footer">
		        	<button type="button" id="filter_reset" class="btn btn-default" data-dismiss="modal">Reset</button>
		          	<button type="button" id="filter_advance" class="btn btn-primary" data-dismiss="modal">Submit</button>
		        </div>
		      </div>
		      
			</div>
		</div>
	</div>