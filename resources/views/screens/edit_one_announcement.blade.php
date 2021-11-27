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
<div style="background-color: #fff" class="uk-modal-body">
    <div class="uk-modal-header">
        <h2 class="uk-modal-title">تعديل اعلان متعدد</h2>
    </div>
    <form action="{{ route('announcements.update') }}" method="post" class="uk-form-horizontal uk-margin-large"
        enctype="multipart/form-data">
        @csrf
        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-text">النص</label>
            <div class="uk-form-controls">
                <input class="uk-input" id="form-horizontal-text" type="text" name="text[]" placeholder="النص">
            </div>
            <div id="new_chq"></div>
        </div>

        <a class="uk-button uk-button-primary add">اضافة نص اخر+</a>
        {{-- <button class="uk-button uk-button-danger remove">remove</button> --}}

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-select">اختر صوره</label>
            <div class=" uk-placeholder uk-text-center">
                <span uk-icon="icon: cloud-upload"></span>
                <span class="uk-text-middle">إرفاق الثنائيات بإسقاطها هنا </span>
                <div uk-form-custom>
                    <input type="file" name="image[]" value="" multiple>
                    <span class="uk-link">اختر من هنا</span>
                </div>
            </div>
            <progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>
            <div id="new_chq_image"></div>
        </div>
        <a class="uk-button uk-button-primary add-image">اضافة صوره جديدة</a>

        <div class="uk-margin">
            <label class="uk-form-label" for="form-horizontal-select">اختر فديو</label>
            <div class="js-upload uk-placeholder uk-text-center">
                <span uk-icon="icon: cloud-upload"></span>
                <span class="uk-text-middle">إرفاق الثنائيات بإسقاطها هنا </span>
                <div uk-form-custom>
                    <input type="file" name="vedio[]" value="" multiple>
                    <span class="uk-link">اختر من هنا</span>
                </div>
            </div>
            <progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>
            <div id="new_chq_vedio"></div>
        </div>
        <a class="uk-button uk-button-primary add-vedio">اضافة فديو جديد</a>
        <div uk-grid>
            <div class="uk-width-1-2">
                <label class="uk-form-label uk-padding-small my-color" style="color: ">{{
                    __('screens.from')
                    }}</label>
                <div class="">
                    <input type="text" name="content_start" id="begin" class="uk-input datetimepicker"
                        autocomplete="off"
                        value="{{ isset($announcement->content_start) ? $announcement->content_start->format('Y-m-d h:i') : '' }}">
                </div>
            </div>

            <div class="uk-width-1-2">
                <label class="uk-form-label uk-padding-small my-color" style="color: ">{{
                    __('screens.to')
                    }}</label>
                <div class="">
                    <input type="text" name="content_end" id="end" class="uk-input datetimepicker" autocomplete="off"
                        value="{{ isset($announcement->content_end) ? $announcement->content_end->format('Y-m-d h:i') : '' }}">
                </div>
            </div>
        </div>
        <input type="hidden" value="1" id="total_chq">
        <input type="hidden" name="id" value="{{$announcement->id}}">
        <input type="hidden" value="multi_type" name="type">
</div>
<div class="uk-modal-footer uk-text-right">
    <button class="uk-button uk-button-default uk-modal-close" type="button">الغاء</button>
    <button class="uk-button uk-button-primary" type="submit">تعديل</button>
</div>
</form>
</div>

@endsection

@push('scripts')
<script src="{{ url('js/jquery-ui.min.js') }}"></script>
<script src="{{ url('js/jquery.datetimepicker.full.js') }}"></script>
<script src="{{ url('js/rainbow-custom.min.js') }}"></script>
<script>
    $('.add').on('click', add);
                $('.add-image').on('click', add_image);
                $('.add-vedio').on('click', add_vedio);
            $('.remove').on('click', remove);
            
            function add() {
            var new_chq_no = parseInt($('#total_chq').val()) + 1;
            var new_input = `<br> 
            <div class="uk-form-controls">
                <input class="uk-input" id='new_" + new_chq_no + "' type="text" name="text[]" placeholder="النص">
            </div>`;
            $('#new_chq').append(new_input);
                        

            $('#total_chq').val(new_chq_no);
            }
            function add_image() {
            var new_chq_no = parseInt($('#total_chq').val()) + 1;
            var new_input = `<br>
            <label class="uk-form-label" for="form-horizontal-select">اختر صوره</label>
            <div class=" uk-placeholder uk-text-center">
                <span uk-icon="icon: cloud-upload"></span>
                <span class="uk-text-middle">إرفاق الثنائيات بإسقاطها هنا </span>
                <div uk-form-custom>
                    <input type="file" name="image[]" value="" multiple>
                    <span class="uk-link">اختر من هنا</span>
                </div>
            </div>`;
            $('#new_chq_image').append(new_input);
            $('#total_chq').val(new_chq_no);
            }
            function add_vedio() {
            var new_chq_no = parseInt($('#total_chq').val()) + 1;
            var new_input = `<br>
            <label class="uk-form-label" for="form-horizontal-select">اختر فديو</label>
            <div class="js-upload uk-placeholder uk-text-center">
                <span uk-icon="icon: cloud-upload"></span>
                <span class="uk-text-middle">إرفاق الثنائيات بإسقاطها هنا </span>
                <div uk-form-custom>
                    <input type="file" name="vedio[]" value="" multiple>
                    <span class="uk-link">اختر من هنا</span>
                </div>
            </div>`;
            $('#new_chq_vedio').append(new_input);              
            
            $('#total_chq').val(new_chq_no);
            }
            
            function remove() {
            var last_chq_no = $('#total_chq').val();
            
            if (last_chq_no > 1) {
            $('#new_' + last_chq_no).remove();
            $('#total_chq').val(last_chq_no - 1);
            }
            }
</script>
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