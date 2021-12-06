@extends('layout')

@push('styles')
<style>
    .uk-padding {
        padding: 30px !important;
    }

    .uk-width-1-6 {
        font-family: 'Courier New', Courier, monospace;
    }
</style>
<link rel="stylesheet" href="{{ url('css/jquery.datetimepicker.min.css') }}" />
@endpush

@section('content')

@php
$i = 0;
@endphp
<center>
    <h1 style="color:#fff">مراقبة الشاشات</h1>
</center>
<div id="run" class="uk-child-width-expand@s uk-text-center uk-text-large button-container" uk-grid>
    @foreach ($screens as $screen)
    @php
    $day = today()->dayOfWeek;
    $Schedules = App\Schedule::select(
    'id',

    'instructor_name',
    'classification',
    'specialty',
    'subject_name',
    'start',
    'end',
    )->where([
    'hall' => $screen->hall,
    'day_index' => $day,
    ])->get();
    $current = null;
    $now = now();
    if(count($Schedules) > 0){
    foreach ($Schedules as $Schedule) {
    if($now >= $Schedule->start && $now <= $Schedule->end) {
        $current[] = $Schedule;
        }
        }
        }
        // dd($current[0]->instructor_name);
        @endphp
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
        @if($current !=null)
        <div class="uk-width-1-5 button" style="z-index: inherit">
            @if (isset($screen->hall))
            <div style="background-color: rgb(0, 255, 115);opacity:0.5;"
                class="uk-card uk-card-default uk-card-body uk-background-blend-screen ">
                <a style="color:black!important" class="uk-button uk-button-danger"
                    href="#modal-overflow-{{$current[0]->id}}" uk-toggle>المعلمين</a>
                <br><br>
                <div id="modal-overflow-{{$current[0]->id}}" uk-modal>
                    <div class="uk-modal-dialog">

                        <button class="uk-modal-close-default" type="button" uk-close></button>

                        <div class="uk-modal-header">
                            <h2 class="uk-modal-title">المعلمين</h2>
                        </div>
                        <div class="uk-modal-body" uk-overflow-auto>
                            @foreach ($current as $curr)
                            <div style="text-align: center;border: solid;">
                                <h2 style="background: #fff;color:black">{{$curr->instructor_name}}</h2>
                                <h3 style="background: #fff;color:black">{{$curr->classification}}</h3>
                                <h3 style="background: #fff;color:black">{{$curr->subject_name}}</h3>
                            </div>

                            @endforeach

                        </div>

                        <div class="uk-modal-footer uk-text-right">
                            <button class="uk-button uk-button-default uk-modal-close" type="button">خروج</button>
                        </div>

                    </div>
                </div>
                <center>
                    <h1 style="color: #fff">نشط</h1>
                </center>
                {{ $screen->id }}<br>{{ $screen->hall }}<br><span class="uk-text-small">{!! isset($screen->user) ?
                    $screen->user->section : '&nbsp;&nbsp;' !!}</span>
            </div>

            @else
            <div class="uk-card uk-card-default uk-card-body{{ isset($screen->user) ? ' background-selected' : '' }}">
                <center>
                    <h1 style="color: #fff">نشط</h1>
                </center>
                {{ $screen->id }}<br>{{ __('screens.free') }}<br><span class="uk-text-small">{!! isset($screen->user) ?
                    $screen->user->section : '&nbsp;&nbsp;' !!}</span>
            </div>

            @endif
        </div>

        @else
        <div class="uk-width-1-5 button"
            data-link="{{ $add_link ? route('screens.show', ['screen' => $screen]) : null }}" style="z-index: inherit">

            @if (isset($screen->hall))
            <div
                class="uk-card uk-card-default uk-card-body uk-background-muted{{ isset($screen->user) ? ' background-selected' : '' }}">

                {{ $screen->id }}<br>{{ $screen->hall }}<br><span class="uk-text-small">{!! isset($screen->user) ?
                    $screen->user->section : '&nbsp;&nbsp;' !!}</span>
            </div>
            @else

            <div class="uk-card uk-card-default uk-card-body{{ isset($screen->user) ? ' background-selected' : '' }}">

                {{ $screen->id }}<br>{{ __('screens.free') }}<br><span class="uk-text-small">{!! isset($screen->user) ?
                    $screen->user->section : '&nbsp;&nbsp;' !!}</span>
            </div>
            @endif
        </div>
        @endif
        @endforeach
</div>

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
<script>
    setInterval(function() {

$("#run").load(window.location.href + " #run");

}, 9000);
</script>
@endpush