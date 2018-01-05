<div style="width:1000px; border:1px solid black; padding:20px;">

  <p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
		Dear {{$receiver_name}},
	</p>

	<p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
    Below are Summary of Questionnaire Answers. This form is submitted by {{ $sender_name }} ({{ $sender_email }}).
	</p><br />

  @for($i = 0; $i < count($feedback['questions']); $i++)

    @if($feedback['answer_input_type'][$i] != 5)

    <div style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
      <h4>Q: {{ $feedback['questions'][$i] }}</h4>
      <p>A: {{ $feedback['answers'][$i] }}</p>
    </div>

    @else

    <div style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
      <h4>Q: {{ $feedback['questions'][$i] }}</h4>

      @for($j = 0; $j < count($feedback['answers'][$i]); $j++)
      <p>{{ $feedback['description_title'][$i][$j] }} : {{ $feedback['answers'][$i][$j] }}</p>
      @endfor
    </div>

    @endif

  @endfor

  <br /><br />
  <p style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
		Approval Management System<br />Singapore Red Cross
	</p>

</div>
