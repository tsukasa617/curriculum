<p>＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝<br>
    @if($first_client)
    【{{ $first_client }}様　取次案件一覧】<br><br>
    ＜直接紹介＞<br>
    {{ $matter }}<br>
    ・{{ $status_after }}<br>
    ・{{ $status_before }}→{{ $status_after }}<br><br>
    @elseif($second_client)
    【{{ $second_client }}様　取次案件一覧】<br><br>
    ＜二次店　{{ $second_client }}様　紹介＞<br>
    {{ $matter }}<br>
    ・{{ $status_after }}<br>
    ・{{ $status_before }}→{{ $status_after }}<br><br>
    @elseif($third_client)
    【{{ $third_client }}様　取次案件一覧】<br><br>
    ＜三次店　{{ $third_client }}様　紹介＞<br>
    {{ $matter }}<br>
    ・{{ $status_after }}<br>
    ・{{ $status_before }}→{{ $status_after }}<br><br>
    @endif
    ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
</p>