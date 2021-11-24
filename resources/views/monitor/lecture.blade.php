<li>
    <div class="uk-text-center uk-text-large uk-padding-large uk-margin-large-top uk-margin-large-bottom">
        <h1>{{ hindi($lecture->subject_code).' - '.hindi($lecture->subject_name) }}</h1>
        <h1>{{ $lecture->classification }}</h1>
        <h1>{{ $lecture->instructor_name }}</h1>
        <h2>{{ hindi($lecture->start->format('h:i')).' - '.hindi($lecture->end->format('h:i')) }}</h2>
    </div>
</li>
