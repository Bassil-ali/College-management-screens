@if ($errors->any())
    <div class="uk-alert-danger" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <ul>
            @foreach ($errors->all() as $error)
                <li style="direction: rtl">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
