<form class="uk-modal-full" id="screens-{{ $user->id }}" action="{{ route('users.screens', ['user' => $user]) }}" method="POST" uk-modal>
    @csrf
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>

        <div class="uk-modal-header">
            <h2 class="uk-modal-title">{{ __('users.screens') }}</h2>
        </div>

        <div class="uk-modal-body">
            @php
                $i = 0;
            @endphp

            @while ($i < App\Screen::count())
                <div class="uk-child-width-expand@s uk-text-center" uk-grid>
                    @foreach (App\Screen::all()->skip($i)->take(5) as $screen)
                    <div class="uk-width-1-5" data-link="{{ route('screens.show', ['screen' => $screen]) }}">
                        @if (isset($screen->hall))
                            <div class="uk-card uk-card-default uk-card-body">{{ $screen->id }}<br>{{ $screen->hall }}<br>{{ isset($screen->user) ? $screen->user->name : '' }}<br><label><input name="screen[]" value="{{ $screen->id }}" class="uk-checkbox" type="checkbox" {{ $user->screens->contains($screen) ? 'checked' : '' }}> {{ __('users.select') }}</label></div>
                        @else
                            <div class="uk-card uk-card-body uk-background-muted">{{ $screen->id }}<br>{{ __('screens.free') }}<br>{{ isset($screen->user) ? $screen->user->name : '' }}<br><label><input name="screen[]" value="{{ $screen->id }}" class="uk-checkbox" type="checkbox" {{ $user->screens->contains($screen) ? 'checked' : '' }}> {{ __('users.select') }}</label></div>
                        @endif
                    </div>
                    @endforeach
                </div>

                @php
                    $i += 6;
                @endphp
            @endwhile
        </div>

        <div class="uk-modal-footer uk-text-left" uk-sticky="bottom: true">
            <button class="uk-button uk-button-default uk-modal-close" type="button">{{ __('app.cancel') }}</button>
            <button class="uk-button uk-button-primary" type="submit">{{ __('app.save') }}</button>
        </div>
    </div>
</form>
