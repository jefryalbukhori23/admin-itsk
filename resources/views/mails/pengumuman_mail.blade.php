<html>
    <div class="card">
        {{-- @if($mail_data['name'] == 'pendaftaran')
           <h2>{{$mail_data['title']}}</h2>
            <p>{{$mail_data['desc']}}</p>
            <ul>
                <li>{{$mail_data['mail']}}</li>
                <li>{!! $mail_data['pass'] !!}</li>
            </ul>
        @endif --}}
        {!! $mail_data['content'] !!}
    </div>
</html>
