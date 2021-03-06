@extends('turtle::layouts.modal')

@section('title', 'Edit User')
@section('content')
    <form method="POST" action="{{ route('users.edit', $user->id) }}" novalidate>
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="modal-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" id="name" class="form-control" value="{{ $user->name }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
            </div>

            <div class="form-group">
                <label for="timezone">Timezone</label>
                <select name="timezone" id="timezone" class="form-control">
                    @foreach (timezones() as $timezone)
                        <option value="{{ $timezone['identifier'] }}"{{ $timezone['identifier'] == $user->timezone ? ' selected' : '' }}>{{ $timezone['label'] }}</option>
                    @endforeach
                </select>
            </div>

            @if(config('turtle.allow.billing'))
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="hidden" name="billable" value="0">
                        <input type="checkbox" name="billable" id="billable" class="form-check-input" value="1"{{ $user->billable ? ' checked' : '' }}>
                        Billable
                    </label>
                </div>
            @endif

            <div class="form-group">
                <div>
                    <label>Roles</label>
                    <button type="button" class="btn btn-light btn-xs ml-1" data-check-all="roles[]">Check All</button>
                    <button type="button" class="btn btn-light btn-xs" data-check-none="roles[]">Check None</button>
                </div>
                @foreach ($roles as $role)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="roles[]" class="form-check-input" value="{{ $role->id }}"{{ $user->roles->contains('id', $role->id) ? ' checked' : '' }}>
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Edit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </form>
@endsection