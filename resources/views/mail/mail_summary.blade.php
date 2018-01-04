<div style="width:500px; margin:0 auto; border:1px solid black; padding:20px;">

  @for($i = 0; $i < count($feedback['questions']); $i++)

    @if($feedback['answer_input_type'][$i] != 5)

    <div style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
      <p>Q: {{ $feedback['questions'][$i] }}</p>
      <p>A: {{ $feedback['answers'][$i] }}</p>
    </div>

    @else

    <div style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
      <p>Q: {{ $feedback['questions'][$i] }}</p>

      @for($j = 0; $j < count($feedback['answers'][$i]); $j++)
      <p>{{ $feedback['description_title'][$i][$j] }} : {{ $feedback['answers'][$i][$j] }}</p>
      @endfor
    </div>

    @endif

  @endfor

</div>
