<div class="uk-card uk-card-header">
    <div class="uk-card-body uk-padding-remove">
        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-divider uk-table-hover uk-padding-remove">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>التاريخ</th>
                        <th>الوقت</th>
                        <th>البيان</th>

                        @if (Route::currentRouteName() == 'users.log')
                        <th>رقم الشاشة</th>
                        <th>رقم القاعة</th>
                        @endif

                       
                        <th>المستخدم</th>
                        <th>حذف</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $log->created_at->format('Y-m-d') }}</td>
                        <td>{{ $log->created_at->format('H:i') }}</td>
                        <td>{{ $log->message }}</td>

                        @if (Route::currentRouteName() == 'users.log')
                        <td>{{ isset($log->screen) ? $log->screen->id : '' }}</td>
                        <td>{{ isset($log->screen) ? $log->screen->hall : '' }}</td>
                        @endif

                       
                        <td>{{ $log->user->name }}</td>
                        <td uk-tooltip="{{ __('users.delete')}}"><a data-name="{{ $log->id}}"
                            data-delete="{{ $log->id }}"
                                href="{{ route('user.log.delete', ['id' => $log->id]) }}" class="uk-text-danger" 
                                uk-icon="icon: trash; ratio: 1.15"></a></td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
