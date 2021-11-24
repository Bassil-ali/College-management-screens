@extends('layout')

@push('styles')
<style>
    .uk-tooltip {
        font-size: 16px !important;
    }
</style>
@endpush

@section('content')
@if (auth()->user()->is_admin == 1)
    <div>
        <a class="uk-button uk-button-default" href="#add-user" uk-toggle style="color: #ffffff"><span
                uk-icon="plus"></span>&nbsp;&nbsp;{{ __('users.add-user') }}</a>
        @include('modals.add_user')
    </div>
@endif

<div id="table"></div>
@endsection

@push('scripts')
<script>
    function loadTable() {
        $.ajax({
            url: "{{ route('users.table') }}",
            method: 'GET',
            data: $('#add-user-form').serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('#table').html('<div class="uk-text-center"><span uk-spinner="ratio: 5.5"></span></div>');
            },
            success: function(data) {
                $('#table').html(data.html);
            },
            complete: function() {
                $('[data-edit]').click(function() {
                    var id = $(this).data('edit');
                    var route = $(this).data('route');
                    var name = $('#input-name-' + id).val();
                    var username = $('#input-username-' + id).val();

                    var section = $('#input-section-' + id).val();
                    var is_admin = $('#input-is_admin-' + id).prop('checked');

                    $.ajax({
                        url: route,
                        method: 'POST',
                        data: {
                            name: name,
                            username: username,
                            section: section,
                            is_admin: is_admin
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            $('.toggle-update').each(function() {
                                UIkit.toggle($(this)).toggle();
                            });
                        },
                        success: function(data) {
                            $('#span-name-' + id).text(data.name);
                            $('#span-username-' + id).text(data.username);
                            UIkit.notification({
                                message: '<span uk-icon=\'icon: check\'></span>&nbsp;' + data.message,
                                status: 'success',
                                pos: 'top-center',
                                timeout: 5000
                            });
                        },
                        complete: function() {
                            $('.toggle-update').each(function() {
                                UIkit.toggle($(this)).toggle();
                            });
                            $('.toggle-edit').each(function() {
                                UIkit.toggle($(this)).toggle();
                            });
                        }
                    });
                });

                $('[data-unlock]').click(function() {
                    var id = $(this).data('unlock');
                    var name = $(this).data('name');
                    var route = $(this).data('route');
                    var message = "{{ __('users.unlock-message') }}".replace('name', name);

                    UIkit.modal.confirm(message, modalOptions).then(function() {
                        $.ajax({
                            url: route,
                            method: 'PATCH',
                            data: {},
                            dataType: 'json',
                            success: function(data) {
                                UIkit.notification({
                                    message: '<span uk-icon=\'icon: check\'></span>&nbsp;' + data.message,
                                    status: 'success',
                                    pos: 'top-center',
                                    timeout: 5000
                                });
                            },
                            complete: function() {
                                $('.toggle-update').each(function() {
                                    UIkit.toggle($(this)).toggle();
                                });
                                $('.toggle-edit').each(function() {
                                    UIkit.toggle($(this)).toggle();
                                });
                            }
                        });
                    }, function () {});
                });

                $('[data-delete]').click(function() {
                    var id = $(this).data('delete');
                    var name = $(this).data('name');
                    var message = "{{ __('users.delete-message') }}".replace('name', name);
                    var route = $(this).data('route');

                    UIkit.modal.confirm(message, modalOptions).then(function() {
                        $.ajax({
                            url: route,
                            method: 'DELETE',
                            data: {},
                            dataType: 'json',
                            success: function(data) {
                                UIkit.notification({
                                    message: '<span uk-icon=\'icon: check\'></span>&nbsp;' + data.message,
                                    status: 'success',
                                    pos: 'top-center',
                                    timeout: 5000
                                });
                            },
                            complete: function() {
                                loadTable();
                            }
                        });
                    }, function () {});
                });
            }
        });
    }

    $(document).ready(function() {
        loadTable();
    });
</script>
@endpush
