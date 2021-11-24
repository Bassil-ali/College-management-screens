<div class="uk-card uk-card-header">
    <div class="uk-card-body uk-padding-remove">
        <div class="uk-overflow-auto">
            <button class="uk-button uk-button-default add-content uk-inline" type="button" uk-toggle="target: .add-content">{{ __('announcements.add') }}</button>
            @include('screens._add', ['screen_id' => $screen->id])
        </div>
    </div>
</div>

<div class="uk-margin-top-remove">
    <table class="uk-table uk-table-hover ">
        <thead>
            <tr>
                <th class="uk-table-shrink"><label><input class="uk-checkbox" type="checkbox" id="all_mass_cmd"></label></th>
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
                <td><label><input class="uk-checkbox" type="checkbox" name="mass_cmd" value="{{ $announcement->id }}"></label></td>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ __('announcements.types')[$announcement->type] }}</td>
                <td>{{ $announcement->type == 'text' ? $announcement->value : '' }}</td>
                @if (isset($announcement->content_end))
                <td>{{ $announcement->content_end->format(__('announcements.format'))  }}</td>
                @else
                <td></td>
                @endif
                <td>
                    <button class="uk-button uk-button-text" uk-toggle="target: #edit-{{ $announcement->id }}" type="button"><span uk-icon="pencil"></span></button>
                    @include('modals.edit_announcement')
                </td>
                <td>
                    <form action="{{ route('announcements.change-active') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $announcement->id }}">
                        @if ($announcement->type == 'text' && !$announcement->is_active)
                        <button class="uk-button uk-button-text" type="button" uk-toggle="target: #activate-text"><span uk-icon="{{ $announcement->is_active ? 'check' : 'close' }}"></span></button>
                        @else
                        <button class="uk-button uk-button-text"><span uk-icon="{{ $announcement->is_active ? 'check' : 'close' }}"></span></button>
                        @endif
                    </form>

                    @include('modals.activate_text')
                </td>
                <td>
                    <button class="uk-button uk-button-text" uk-toggle="target: #modal-{{ $announcement->id }}"><span uk-icon="icon: search"></span></button>
                    @include('modals.announcement')
                </td>
                <td>
                    <button class="uk-button uk-button-text" data-delete="{{ $announcement->id }}" data-index="{{ $loop->index + 1 }}" type="button"><span uk-icon="trash"></span></button>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">
                    <div class="uk-form-horizontal">
                        <div class="uk-margin">
                            <label class="uk-form-label uk-padding-remove-horizontal" for="all_mass_select">{{ __('announcements.all_mass_cmd') }}</label>
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
                    <button id="run_cmd" class="uk-button uk-button-secondary" type="button">{{ __('announcements.run_cmd') }}</button>
                </td>
            </tr>
        </tfoot>
    </table>
</div>