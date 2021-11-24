<div class="uk-card uk-card-body" style="height: 600px">
    <div class="uk-inline uk-width-1-1 uk-height-1-1" uk-toggle="target: .uk-overlay; mode: hover">
        <iframe id="snapshot" src="" frameborder="0" class="uk-width-1-1 uk-height-1-1"></iframe>
        <div class="uk-overlay uk-overlay-default uk-position-center" style="cursor: pointer" onclick="openSnapshot('{{ route('monitor', ['id' => $screen->id]) }}')" hidden>
            <span uk-overlay-icon></span>
        </div>
    </div>
</div>
