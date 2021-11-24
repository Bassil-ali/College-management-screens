<form action="{{ route('timing.post') }}" method="post">
    @csrf
    <input type="hidden" name="morning" value="{{ $morning }}">
    <table class="uk-table">
        <thead>
            <tr>
                <th>{{ __('timing.lecture') }}</th>
                <th>{{ __('timing.start') }}</th>
                <th>{{ __('timing.end') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Timing::where('morning', $morning)->get() as $time)
            <tr>
                <td>{{ __('timing.lectures')[$loop->index] }}</td>
                <td>
                    @include('shared.timepicker', ['name' => 'start[]', 'selected' => $time->start])
                </td>
                <td>
                    @include('shared.timepicker', ['name' => 'end[]', 'selected' => $time->end])
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom" style="color: #ffffff">{{ __('app.save') }}</button>
                </td>
            </tr>
        </tfoot>
    </table>
</form>
