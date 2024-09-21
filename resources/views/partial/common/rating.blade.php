<?php
$score = round(($user_ratings->score*100)/20,1);
?>
<div>
    @for($x=1; $x <=5;$x++)
        @if($score > $x  )
        <span class="fa fa-star"></span>
        @elseif(floor($score)==$x && !fmod($score,1)*10  )
        <span class="fa fa-star"></span>
        @elseif(floor($score)+1==$x && fmod($score,1)*10 >0   )
        <span class="fa fa-star-half-o"></span>
        @else
        <span class="fa fa-star-o"></span>
        @endif
    @endfor
    <span class="text-sm underline ">{{ $score }}</span>
    <span class="text-sm ">({{ $user_ratings->count_positive + $user_ratings->count_negative }})</span>
</div>