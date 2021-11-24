<li>
    <h1 class="uk-heading-divider uk-text-center uk-margin-large-top">{{ __('schedules.days')[today()->dayOfWeek] }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ today()->format('Y/m/d') }}</h1>
    <div class="uk-margin-top" uk-grid>
        <div class="uk-width-expand">
            <table class="uk-table uk-table-striped uk-text-large uk-table-large uk-table-divider uk-text-secondary">
                <thead>
                    <tr>
                        <th><h3>#</h3></th>
                        <th><h3>المقرر</h3></th>
                        <th><h3>التخصص</h3></th>
                        <th><h3>نوع الشعبة</h3></th>
                        <th class="uk-width-small"><h3>أوقات</h3></th>
                        <th><h3>المدرب</h3></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lectures as $row)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $row->subject_code }}</td>
                        <td>{{ $row->specialty }}</td>
                        <td>{{ $row->classification }}</td>
                        <td>{{ $row->start->format('H:i').' - '.$row->end->format('H:i') }}</td>
                        <td style="padding-right: 20px !important">{{ $row->instructor_name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</li>
