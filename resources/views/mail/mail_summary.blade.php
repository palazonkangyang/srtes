<div style="width:500px; margin:0 auto; border:1px solid black; padding:20px;">

  @for($i = 0; $i < count($feedback['questions']); $i++)

  <div style="font-family: Arial, sans-serif; font-size:13px; line-height:22px;">
    <p>Q: $feedback['questions'][$i]</p>
    <p>A: $feedback['answers'][$i]</p>
  </div>

  @endfor

</div>
