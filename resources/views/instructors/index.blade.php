@extends('layout')

@push('styles')

@endpush

@section('content')
<div class="uk-overflow-auto">
    <table class="uk-table uk-table-divider uk-table-hover uk-width-1-1">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('instructors.id') }}</th>
                <th>{{ __('instructors.name') }}</th>
                <th>{{ __('instructors.section')}}</th>
                <th>{{ __('instructors.phone') }}</th>
                <th>{{ __('instructors.email') }}</th>
                <th>{{ __('instructors.edit')}}</th>
                <th>حذف</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($instructors as $instructor)
            <tr>
                {{-- <td>{{ ( $loop->index + 1) + ($instructors->count()) }}</td> --}}
                <td>{{ ($loop->index + 1) + ($instructors->perPage() * ($instructors->currentPage() - 1) ) }}</td>
                <td>{{ $instructor->computer_id }}</td>
                <td>{{ $instructor->name }}</td>
                <td>{{ $instructor->section}}</td>
                <td>{{ $instructor->phone }}</td>
                <td>{{ $instructor->email }}</td>
                @if (auth()->user()->is_admin == 1)
                <td>
                    <a style="background-color: #161718;" class="uk-button uk-button-text" href="{{ route('instructors.show', ['computer_id' => $instructor->computer_id]) }}"><span style="color: #ff0040;margin:20px;border-radius:3%" uk-icon="user">تعديل واضافة صوره</span></a>
                </td>
                <td>
                    <a style="background-color: #161718;" class="uk-button uk-button-text"
                        href="{{ route('instructors.delete', ['computer_id' => $instructor->computer_id]) }}"><span
                            style="color: #ff0040;margin:20px;border-radius:3%" uk-icon="user">  حذف</span></a>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="uk-text-center">
    {{ $instructors->links('shared.pagination') }}
</div>
@endsection

@push('scripts')
@endpush
