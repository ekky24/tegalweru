<?php $rt_choose_filter = "" ?>

<div class="filter form-inline">
		<div class="input-group form-group col-md-offset-3 col-md-3">
	        <input type="text" class="form-control" placeholder="Search..." id="search_val" value="{{ $q }}">
	        <span class="input-group-btn">
	            <button class="btn btn-default" type="button" id="filter_search">
	                <i class="fa fa-search"></i>
	            </button>
	        </span>
	    </div>
	    <div class="form-group col-md-3">
	    	<select name="rw" id="filter_rw" class="form-control" style="width: 100%">
		    	<option value="none">-- Seluruh RW --</option>
		    	@if($rw_choose != "")
		    		@foreach($rw as $row)
		    			@if($row->id == $rw_choose)
		    				<option value="{{ $row->id }}" selected>{{ 'RW ' . $row->nama }}</option>
		    			@else
		    				<option value="{{ $row->id }}">{{ 'RW ' . $row->nama }}</option>
		    			@endif
		    		@endforeach
		    	@else
		    		@foreach($rw as $row)
			    		<option value="{{ $row->id }}">{{ 'RW ' . $row->nama }}</option>
			    	@endforeach
		    	@endif
		    </select>
	    </div>
	    <div class="form-group col-md-3">
	    	<select name="rt" id="filter_rt" class="form-control" style="width: 100%">
		    	<option value="none">-- Seluruh RT --</option>
		    	@if($rt_choose != "")
		    		@foreach($rt as $row)
		    			@if($row->id == $rt_choose)
		    				<option value="{{ $row->id }}" selected>{{ 'RT ' . $row->nama }}</option>
		    			@else
		    				<option value="{{ $row->id }}">{{ 'RT ' . $row->nama }}</option>
		    			@endif
		    		@endforeach
		    	@else
		    		@if($rt != "")
			    		@foreach($rt as $row)
				    		<option value="{{ $row->id }}">{{ 'RT ' . $row->nama }}</option>
				    	@endforeach
				    @endif
		    	@endif
		    </select>
	    </div>
	</div>