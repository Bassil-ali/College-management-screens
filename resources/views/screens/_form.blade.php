@php
    if(!isset($color)) {
        $color = '#ffffff !important';
    }
@endphp

<div class="uk-margin">
    <label class="uk-form-label" for="type" style="color: {{ $color }}">{{ __('announcements.type') }}</label>
    <div class="uk-form-controls">
        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
            @foreach (__('announcements.types') as $key => $value)
            <label style="color: {{ $color }}">
                <input class="uk-radio" type="radio" name="type" value="{{ $key }}" {{ $key == 'text' ? 'checked' : '' }}> {{ $value }}
            </label>
            @endforeach
        </div>
    </div>
</div>

<div class="toggle-text">
    <div class="uk-margin">
        <label class="uk-form-label" for="value" style="color: {{ $color }}">{{ __('announcements.value') }}</label>
        <textarea name="text" class="uk-textarea" rows="3" placeholder="{{ __('announcements.value') }}">{{ isset($announcement->value) ? $announcement->value : '' }}</textarea>
    </div>
</div>

<div uk-grid>
    <div class="uk-width-1-2">
        <label class="uk-form-label uk-padding-small my-color" style="color: {{ $color }}">{{ __('screens.from') }}</label>
        <div class="uk-form-controls">
            <input type="text" name="content_start" id="begin" class="uk-input datetimepicker"
                   autocomplete="off" value="{{ isset($announcement->content_start) ? $announcement->content_start->format('Y-m-d h:i') : '' }}">
        </div>
    </div>

    <div class="uk-width-1-2">
        <label class="uk-form-label uk-padding-small my-color" style="color: {{ $color }}">{{ __('screens.to') }}</label>
        <div class="uk-form-controls">
            <input type="text" name="content_end" id="end" class="uk-input datetimepicker"
                   autocomplete="off" value="{{ isset($announcement->content_end) ? $announcement->content_end->format('Y-m-d h:i') : '' }}">
        </div>
    </div>
</div>
<div class="toggle-else" style="display: none;">
    <div class="uk-margin">
        <label class="uk-form-label" for="value" style="color: {{ $color }}">{{ __('announcements.value') }}</label>
        <div uk-form-custom>
            <input type="file" name="content">
            <button class="uk-button uk-button-secondary" type="button" tabindex="-1">{{ __('schedules.select-file') }}</button>
        </div>
        <span id="file-name" class="uk-margin-small-right uk-text-secondary" disabled></span>
    </div>
</div>

<input type="hidden" name="screen_id" value="{{ $screen_id }}">
@csrf

@push('scripts')
<script>
    $(document).ready(function() {
        var datetimepickerOptions = {
            format: 'H:i Y-m-d',
            i18n: {
                ar: {
                    months: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمير', 'أكتوبر', 'نوفمبر', 'ديسمبر'],
                    dayOfWeekShort: ['ن', 'ث', 'ع', 'خ', 'ج', 'س', 'ح'],
                    dayOfWeek: ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد']
                }
            },
            rtl: true,
            // hours12: true,
            parentID: 'body',
            weekends: [
                'الجمعة', 'السبت'
            ],
        };

        $.datetimepicker.setLocale('ar');
       	$('.datetimepicker').datetimepicker(datetimepickerOptions);
    });

    $('[name="type"]').change(function () {
        $('.toggle-text').toggle($(this).val() === 'text');
        $('.toggle-else').toggle($(this).val() !== 'text');
    });

    $('[name="content"]').change(function() {
        $("#file-name").text($(this).val());
    });
</script>
@endpush