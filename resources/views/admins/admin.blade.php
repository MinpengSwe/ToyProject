@extends('layouts.master')

@section('content')
    <table>
        <thead>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>User</th>
        <th>Manager</th>
        <th>Admin</th>
        <th></th>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <form action="{{route('assignRole')}}" method="post">
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->email}}<input type="hidden" name="email" value="{{$user->email}}"></td>
                    <td><input type="checkbox" {{$user->hasRole('user') ? 'checked' : ''}} name="role_user"></td>
                    <td><input type="checkbox" {{$user->hasRole('manager') ? 'checked' : ''}} name="role_manager"></td>
                    <td><input type="checkbox" {{$user->hasRole('admin') ? 'checked' : ''}} name="role_admin"></td>
                    {{csrf_field()}}
                    <td><button type="submit">Assign Roles</button></td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection