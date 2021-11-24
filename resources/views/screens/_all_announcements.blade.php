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
<div class="uk-margin-top-remove">
    <table class="uk-table uk-table-hover ">
        <thead>
            <tr>
               <th>#</th>
                <th>{{ __('announcements.type') }}</th>
                <th class="uk-text-truncate">{{ __('announcements.value') }}</th>
                <th class="uk-text-truncate">{{ __('announcements.to') }}</th>
                <th class="uk-table-shrink">{{ __('announcements.edit') }}</th>
                <th class="uk-table-shrink">{{ __('announcements.view') }}</th>
                <th class="uk-table-shrink">{{ __('announcements.trash') }}</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i=1;
            @endphp
            @foreach ($announcements as $announcement)
            <tr>
                <td>{{$i++}}</td>
                <td>{{ __('announcements.types')[$announcement->type] }}</td>
                <td>{{ $announcement->type == 'text' ? $announcement->value : 'ملف' }}</td>
                @if (isset($announcement->content_end))
                <td>{{ $announcement->content_end->format(__('announcements.format')) }}</td>
                @else
                <td></td>
                @endif
                <td>
                    <button class="uk-button uk-button-text" uk-toggle="target: #edit-{{ $announcement->announcements_number }}"
                        type="button"><span uk-icon="pencil"></span></button>
                   <form id="edit-{{  $announcement->announcements_number }}" action="{{ route('updateAllannouncement') }}" method="post"
                    enctype="multipart/form-data" uk-modal>
                    <div class="uk-modal-dialog">
                        <button class="uk-modal-close-default" type="button" uk-close></button>
                        <div class="uk-modal-header">
                            <h2 class="uk-modal-title">{{ __('announcements.edit') }}</h2>
                        </div>
                        <div class="uk-modal-body">
                            @csrf
                            <input type="hidden" name="announcements_number" value="{{$announcement->announcements_number}}">
                            <input type="hidden" name="id" value="{{ $announcement->id }}">
                            @include('screens._form', ['screen_id' => $announcement->screen->id, 'color' => '#343E39 !important'])
                        </div>
                        <div class="uk-modal-footer uk-text-left">
                            <button class="uk-button uk-button-default uk-modal-close" type="button">{{ __('app.cancel') }}</button>
                            <button class="uk-button uk-button-primary" type="submit">{{ __('app.save') }}</button>
                        </div>
                    </div>
                </form>
                </td>
               
                <td>
                    <button class="uk-button uk-button-text" uk-toggle="target: #modal-{{ $announcement->id }}"><span
                            uk-icon="icon: search"></span></button>
                    @include('modals.announcement')
                </td>
                <td>
                    <a href="{{route('All.Announcement.delete',['id' => $announcement->announcements_number])}}" class="uk-button uk-button-text"
                        data-index="{{ $i }}" type="button"><span uk-icon="trash"></span></a>
                </td>
            </tr>
            @endforeach
        </tbody>
        
    </table>
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
@endpush