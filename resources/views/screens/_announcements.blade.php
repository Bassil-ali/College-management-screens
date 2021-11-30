<div class="uk-card uk-card-header">
    <div class="uk-card-body uk-padding-remove">
        <div class="uk-overflow-auto">
            <button class="uk-button uk-button-default add-content uk-inline" type="button"
                uk-toggle="target: .add-content">{{ __('announcements.add') }}</button>
            @include('screens._add', ['screen_id' => $screen->id])
        </div>
    </div>
</div>

<div class="uk-margin-top-remove">
    <table class="uk-table uk-table-hover ">
        <thead>
            <tr>
                <th class="uk-table-shrink"><label><input class="uk-checkbox" type="checkbox" id="all_mass_cmd"></label>
                </th>
                <th class="uk-table-shrink">#</th>
                <th>{{ __('announcements.type') }}</th>
                <th class="uk-text-truncate">{{ __('announcements.value') }}</th>
                <th class="uk-text-truncate">{{ __('announcements.to') }}</th>
                <th class="uk-table-shrink">{{ __('announcements.edit') }}</th>
                <th class="uk-table-shrink">{{ __('announcements.is_active') }}</th>
                <th class="uk-table-shrink">{{ __('announcements.view') }}</th>
                <th class="uk-table-shrink">{{ __('announcements.trash') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($screen->announcements as $announcement)
            <tr>
                <td><label><input class="uk-checkbox" type="checkbox" name="mass_cmd"
                            value="{{ $announcement->id }}"></label></td>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ __('announcements.types')[$announcement->type] }}</td>
               @if($announcement->type == 'multi_type')
                <td>{{__('announcements.types')[$announcement->type]}}</td>
                @else
                <td>{{ $announcement->type == 'text' ? $announcement->value : 'ملف' }}</td>
                @endif
                @if (isset($announcement->content_end))
                <td>{{ $announcement->content_end->format(__('announcements.format')) }}</td>
                @else
                <td></td>
                @endif
                @if($announcement->type == 'multi_type')
                <td>
                    <a class="uk-button uk-button-text" href="{{route('edit.one.Announcement',['id' => $announcement->id])}}" uk-toggle><span
                            uk-icon="pencil"></span></a>


                </td>


                @else
                <td>
                    <button class="uk-button uk-button-text" uk-toggle="target: #edit-{{ $announcement->id }}"
                        type="button"><span uk-icon="pencil"></span></button>
                    @include('modals.edit_announcement')
                </td>
                @endif
                <td>
                    <form action="{{ route('announcements.change-active') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $announcement->id }}">
                        @if ($announcement->type == 'text' && !$announcement->is_active)
                        <button class="uk-button uk-button-text" type="button" uk-toggle="target: #activate-text"><span
                                uk-icon="{{ $announcement->is_active ? 'check' : 'close' }}"></span></button>
                        @else
                        <button class="uk-button uk-button-text"><span
                                uk-icon="{{ $announcement->is_active ? 'check' : 'close' }}"></span></button>
                        @endif
                    </form>

                    @include('modals.activate_text')
                </td>
                <td>
                    <button class="uk-button uk-button-text" uk-toggle="target: #modal-{{ $announcement->id }}"><span
                            uk-icon="icon: search"></span></button>
                    @include('modals.announcement')
                </td>
                <td>
                    <button class="uk-button uk-button-text" data-delete="{{ $announcement->id }}"
                        data-index="{{ $loop->index + 1 }}" type="button"><span uk-icon="trash"></span></button>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">
                    <div class="uk-form-horizontal">
                        <div class="uk-margin">
                            <label class="uk-form-label uk-padding-remove-horizontal" for="all_mass_select">{{
                                __('announcements.all_mass_cmd') }}</label>
                            <div class="uk-form-controls">
                                <select class="uk-select" id="all_mass_select" name="all_mass_select">
                                    <option value="0"></option>
                                    @foreach (__('announcements.mass_cmd') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </td>
                <td colspan="4">
                    <button id="run_cmd" class="uk-button uk-button-secondary" type="button">{{
                        __('announcements.run_cmd') }}</button>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
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