@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">

<h1 class="text-3xl font-bold mb-6">My Events</h1>

<table class="w-full border">
    <thead>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Location</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($events as $event)
        <tr>
            <td>{{ $event->title }}</td>
            <td>{{ $event->date }}</td>
            <td>{{ $event->location }}</td>
            <td>
                <a href="#">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection