@if( $check == 'inoffice_1')

<<<<<<< HEAD
<div style="width:500px; margin:0 auto; border:1px solid black; padding:20px;">
<p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">Dear {{$to_name}},</p>

<br />
<p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">{{ $name_submitted }} will be out of the office starting {{ $date }}.</p>
<p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">If you need immediate assistance during his/her absence, please email {{$name_submitted_email}}. Otherwise he will respond to your request as soon as possible upon her/his return. </p>
<p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;"> Click <a href="{{ $app_link }}" target="_blank">here</a> for the application details.</p>
<br />

<p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
Approval Management System<br />
Singapore Red Cross
</p>
</div>

@elseif( $check == 'inoffice_0')

<div style="width:500px; margin:0 auto; border:1px solid black; padding:20px;">
<p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">Dear {{$to_name}},</p>

<br />
<p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">{{ $name_submitted }} is now back in the office {{ $date }}.</p>
<p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;"> Click <a href="{{ $app_link }}" target="_blank">here</a> for the application details.</p>
<br />

<p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
Approval Management System<br />
Singapore Red Cross
</p>
</div>

@endif
=======
  <div style="width:500px; margin:0 auto; border:1px solid black; padding:20px;">

    <p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
      Dear {{$to_name}},
    </p>

    <br />
    <p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
      {{ $name_submitted }} will be out of the office starting {{ $date }}.
    </p>
    <p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
      If you need immediate assistance during his/her absence, please email
      {{$name_submitted_email}}. Otherwise he will respond to your request as soon as possible
      upon her/his return.
    </p>
    <p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
      Click <a href="{{ $app_link }}" target="_blank">here</a> for the application details.
    </p>
    <br />

    <p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
      Approval Management System<br />
      Singapore Red Cross
    </p>
  </div>

@elseif( $check == 'inoffice_0')

  <div style="width:500px; margin:0 auto; border:1px solid black; padding:20px;">

    <p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
      Dear {{$to_name}},
    </p>

    <br />
    <p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
      {{ $name_submitted }} is now back in the office {{ $date }}.
    </p>
    <p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
      Click <a href="{{ $app_link }}" target="_blank">here</a> for the application details.
    </p>
    <br />

    <p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
      Approval Management System<br />
      Singapore Red Cross
    </p>
  </div>

@endif
>>>>>>> master
