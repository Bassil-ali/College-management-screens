@if(auth()->user()->is_admin == 1)
<div class="uk-card uk-margin-medium-bottom uk-text-center uk-padding global">
    <button class="uk-button uk-button-default uk-margin-small-right uk-text-large uk-width-1-2 uk-padding"
        type="button" uk-toggle="target: .global; animation: uk-animation-fade">{{ $button }}</button>
</div>
<div class="uk-card uk-margin-medium-bottom uk-text-center uk-padding global">
    <a class="uk-button uk-button-default uk-margin-small-right uk-text-large uk-width-1-2 uk-padding"
        href="#modal-sections" uk-toggle>اضافة اعلان متعدد</a>
</div>

<div id="modal-sections" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">اضافة اعلان متعدد</h2>
        </div>
        <div class="uk-modal-body">
            <form action="{{route('announcements.global')}}" method="post" class="uk-form-horizontal uk-margin-large"
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
                        <label class="uk-form-label uk-padding-small my-color" style="color: ">{{ __('screens.from')
                            }}</label>
                        <div class="">
                            <input type="text" name="content_start" id="begin" class="uk-input datetimepicker"
                                autocomplete="off"
                                value="{{ isset($announcement->content_start) ? $announcement->content_start->format('Y-m-d h:i') : '' }}">
                        </div>
                    </div>

                    <div class="uk-width-1-2">
                        <label class="uk-form-label uk-padding-small my-color" style="color: ">{{ __('screens.to')
                            }}</label>
                        <div class="">
                            <input type="text" name="content_end" id="end" class="uk-input datetimepicker"
                                autocomplete="off"
                                value="{{ isset($announcement->content_end) ? $announcement->content_end->format('Y-m-d h:i') : '' }}">
                        </div>
                    </div>
                </div>
                <input type="hidden" value="1" id="total_chq">
                <input type="hidden" value="multi_type" name="type">
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">الغاء</button>
            <button class="uk-button uk-button-primary" type="submit">حفظ</button>
        </div>
        </form>
    </div>
</div>
<div class="uk-card uk-margin-medium-bottom uk-text-center uk-padding global">
    <a href="{{route('All.Announcement')}}"
        class="uk-button uk-button-default uk-margin-small-right uk-text-large uk-width-1-2 uk-padding" type="button"
        animation: uk-animation-fade>عرض وتعديل كافة الاعلانات</a>
</div>
@endif
<form id="global" action="{{ route('announcements.global') }}" method="POST"
    class="uk-card uk-card-default uk-width-1-1 uk-margin-medium-bottom uk-box-shadow-large global"
    enctype="multipart/form-data" hidden>
    <div class="uk-card-header">
        {{ $button }}
        <button type="button" class="uk-close-large uk-align-left"
            uk-toggle="target: .global; animation: uk-animation-fade" uk-close></button>
    </div>

    <div class="uk-padding uk-card-body">
        @include('screens._form', ['screen_id' => 0, 'color' => '#314039'])
    </div>

    <div class="uk-card-footer uk-text-left">
        <button class="uk-button uk-button-default uk-modal-close" type="button"
            uk-toggle="target: .global; animation: uk-animation-fade">{{ __('app.cancel') }}</button>
        <button class="uk-button uk-button-primary" type="submit">{{ __('app.save') }}</button>
    </div>
</form>
@push('scripts')
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