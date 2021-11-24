<div class="uk-card uk-card-header">
    <div class="uk-card-body uk-padding-remove">
        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-divider uk-table-hover uk-padding-remove">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>المقرر</th>
                        <th>التخصص</th>
                        <th>الرقم المرجعي</th>
                        <th>نوع الشعبة</th>
                        <th>أيام</th>
                        <th class="uk-width-small">أوقات</th>
                        <th>قاعة</th>
                        <th>المدرب</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lectures as $row)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $row->subject_code }}</td>
                        <td>{{ $row->specialty }}</td>
                        <td>{{ $row->reference }}</td>
                        <td>{{ $row->classification }}</td>
                        <td>{{ __('schedules.days')[$row->day_index] }}</td>
                        <td>{{ $row->start->format('H:i').' - '.$row->end->format('H:i') }}</td>
                        <td>{{ $row->hall }}</td>
                        <td>{{ $row->instructor_name }}</td>
                        <td><a class="uk-button uk-button-text" href="{{ route('instructors.show', ['computer_id' => $row->instructor_id]) }}"><span style="color: #174F3F" uk-icon="user"></span></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
