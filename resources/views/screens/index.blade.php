@extends('layout')

@push('styles')
<style>
    .uk-padding { padding: 30px !important; }
    .uk-width-1-6 { font-family: 'Courier New', Courier, monospace; }
</style>
<link rel="stylesheet" href="{{ url('css/jquery.datetimepicker.min.css') }}" />
@endpush

@section('content')

@include('shared.validation')
@include('modals.add_screen')
@include('screens._global')

@php
    $i = 0;
@endphp

@while ($i < $screens->count())
    <div class="uk-child-width-expand@s uk-text-center uk-text-large button-container" uk-grid>
        @foreach ($screens->skip($i)->take(5) as $screen)

        @php
            $add_link = false;
            if (Auth::user()->is_admin) {
                $add_link = true;
            } else {
                if (isset($screen->user)) {
                    if ($screen->user->id == Auth::user()->id) {
                        $add_link = true;
                    }
                }
            }
        @endphp

        <div class="uk-width-1-5 button" data-link="{{ $add_link ? route('screens.show', ['screen' => $screen]) : null }}" style="z-index: inherit">
            @if (isset($screen->hall))
                <div class="uk-card uk-card-default uk-card-body uk-background-muted{{ isset($screen->user) ? ' background-selected' : '' }}">
                    {{ $screen->id }}<br>{{ $screen->hall }}<br><span class="uk-text-small">{!! isset($screen->user) ? $screen->user->section : '&nbsp;&nbsp;' !!}</span>
                </div>
            @else
                <div class="uk-card uk-card-default uk-card-body{{ isset($screen->user) ? ' background-selected' : '' }}">
                    {{ $screen->id }}<br>{{ __('screens.free') }}<br><span class="uk-text-small">{!! isset($screen->user) ? $screen->user->section : '&nbsp;&nbsp;' !!}</span>
                </div>
            @endif
        </div>
        @endforeach
    </div>

    @php
        $i += 5;
    @endphp
@endwhile

@endsection

@push('scripts')
<script src="{{ url('js/jquery-ui.min.js') }}"></script>
<script src="{{ url('js/jquery.datetimepicker.full.js') }}"></script>
<script src="{{ url('js/rainbow-custom.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var datetimepickerOptions = {
            format: 'H:i Y-m-d',
            i18n: {
                ar: {
                    months: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمير', 'أكتوبر', 'نوفمبر', 'ديسمبر'],
                    dayOfWeekShort: ['ن', 'ث', 'ع', 'خ', 'ج', 'س', 'ح'],
                    dayOfWeek: ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت']
                }
            },
            rtl: true,
            dayOfWeekStart: 7,
            weekends: [
                'الجمعة', 'السبت'
            ],
        };

        $.datetimepicker.setLocale('ar');
       	$('.datetimepicker').datetimepicker(datetimepickerOptions);
    });

    $('[name="type"]').change(function () {
        $('.content-text').prop('hidden', $(this).val() !== 'text');
        $('#content-file').prop('hidden', $(this).val() === 'text');
    });

    $('[name="content"]').change(function() {
        $("#file-name").text($(this).val());
    });

    UIkit.util.on('#global', 'hidden', function () {
        document.getElementById('begin').value = '';
        document.getElementById('end').value = '';
        document.getElementById('announcement_text').value = '';
    });
</script>
@endpush
