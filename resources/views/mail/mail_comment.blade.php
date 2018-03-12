<div style="width:500px; margin:0 auto; border:1px solid black; padding:20px;">
	<p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
		Dear {{$receiver_name}},
	</p>
	<br />
	@if($sender_name)
	<p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
		{{ $sender_name }} added comment in case #{{$case_number}}. To check comment please click <a href="{{ $url }}" target="_blank">here</a>.
	</p>
	@else 
	<p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
		You added comment in case #{{$case_number}}. To check comment please click <a href="{{ $url }}" target="_blank">here</a>.
	</p>
	@endif
	<br />
	<p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
		Approval Management System<br />Singapore Red Cross
	</p>
</div>

