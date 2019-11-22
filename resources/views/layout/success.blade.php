@if(session()->get( 'msg' ))
	<br><br><div class="alert layout_success" style="display: none;">
		<p class="msg">{{session()->get( 'msg' )}}</p>
	</div>
@endif