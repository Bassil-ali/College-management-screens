<div id="modal-{{ $announcement->id }}" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <div>
            @switch($announcement->type)
                @case('photo')
                    <img data-src="{{ url('content/'.$announcement->value) }}" width="800" alt="" uk-img>
                    @break
                @case('video')
                    <video src="{{ url('content/'.$announcement->value) }}" controls playsinline uk-video="autoplay: inview; automute: true"></video>
                    @break
                @case('pdf')
                    <embed src="{{ url('content/'.$announcement->value) }}" type="application/pdf" width="100%" height="600px" />
                    @break
                @default
                <div class="text-center" style="background: #ffffff !important">
                    <h1 class="uk-heading-divider" style="background: #ffffff !important">{{ $announcement->value }}</h1>

                    <table class="uk-table uk-text-small">
                        <thead>
                            <tr>
                                <th class="uk-padding-remove-vertical" style="color: #000000 !important">{{ __('announcements.from') }}</th>
                                <th class="uk-padding-remove-vertical" style="color: #000000 !important">{{ __('announcements.to') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="uk-padding-remove-vertical" style="color: #000000 !important">{{ $announcement->content_start->format(__('announcements.format')) }}</td>
                                <td class="uk-padding-remove-vertical" style="color: #000000 !important">{{ $announcement->content_end->format(__('announcements.format')) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endswitch
        </div>
        <div class="uk-text-left">
            <button class="uk-button uk-button-secondary uk-modal-close" style="color: #ffffff !important" type="button">{{ __('app.close') }}</button>
        </div>
    </div>
</div>
