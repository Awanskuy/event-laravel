@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>User Management</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="align-middle">{{ $user->id }}</td>
                    <td class="align-middle fw-bold">{{ $user->name }}</td>
                    <td class="align-middle">{{ $user->email }}</td>
                    <td class="align-middle">
                        <span class="badge @if($user->role == 'admin') bg-danger @elseif($user->role == 'organizer') bg-primary @else bg-secondary @endif">
                            {{ strtoupper($user->role) }}
                        </span>
                    </td>
                    <td class="align-middle">{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">
    {{ $users->links('pagination::bootstrap-5') }}
</div>
@endsection
