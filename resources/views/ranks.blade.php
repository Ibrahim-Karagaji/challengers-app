<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="{{ asset('css/ranks.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
</head>

<body>

    @extends('layout.layout')

    @section('content')
    <div class="leaderboard">

        @if($globalLeader)
        <div class="leader-card global">
            <h3>Global Leader</h3>
            <img class="leader-avatar" src="{{ $globalLeader->avatar ? asset('storage/' . $globalLeader->avatar) : asset('images/Anonymous-user.jpg') }}" alt="avatar">
            <p class="leader-name">{{ $globalLeader->userName }}</p>
            <p class="leader-points">{{ $globalLeader->total_points }} pts</p>
            <p>Last Exam: {{ $globalLeader->last_exam }}</p>
            <p>Last Date: {{ \Carbon\Carbon::parse($globalLeader->last_date)->format('d M Y H:i') }}</p>
        </div>
        @endif

        @foreach($categoryRanks as $category => $users)
        <div class="category-card">
            <h2>{{ strtoupper($category) }} Leaderboard</h2>
            @if($users->count())
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Points</th>
                        <th>Exam Order</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="user-cell">
                            <img class="user-avatar" src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/Anonymous-user.jpg') }}" alt="avatar">
                            <span>{{ $user->userName }}</span>
                        </td>
                        <td>{{ $user->total_points }}</td>
                        <td>{{ $user->exam_order }}</td>
                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No attempts yet</p>
            @endif
        </div>
        @endforeach

    </div>
    @endsection

</body>

</html>