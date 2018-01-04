<div style="width:1000px; border:1px solid black; padding:20px;">

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

</div>
