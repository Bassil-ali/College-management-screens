<div class="uk-overflow-auto">
    <br><br>
    <table id="myTable" class="dd">
        <thead>
            <tr>
                <th>#</th>
                <th>المقرر</th>
                <th>التخصص</th>
                <th>الرقم المرجعي</th>
                <th>نوع الشعبة</th>
                <th>أيام</th>
                <th>أوقات</th>
                <th>قاعة</th>
                <th>المدرب</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
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
                <td style="background-color: #070707"><a  class="uk-button uk-button-text" href="{{ route('instructors.show', ['computer_id' => $row->instructor_id]) }}"><span style="color: #e00000" uk-icon="user">عرض</span></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
