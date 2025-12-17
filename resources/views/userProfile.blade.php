<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/userProfile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">

    <title>user profile</title>
</head>

<body>
    @extends('layout.layout')

    @section('content')
    <div class="profile-container">
        <div class="user-info">
            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/Anonymous-user.jpg') }}"
                alt="avatar" class="avatar">
            <div class="info">
                <h2>{{ $user->userName }}</h2>
                <p>{{ $user->email }}</p>
                <button id="editProfileBtn">Edit Profile</button>
            </div>
        </div>

        <div class="user-exams">
            <h3>Your Exam Results</h3>
            @if($exams->count())
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Exam Order</th>
                        <th>Total Points</th>
                        <th>Last Attempt</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exams as $index => $exam)
                    <tr>
                        <td><span>#:</span> {{ $index + 1 }} </td>
                        <td><span>category:</span> {{ ucfirst($exam->category) }} </td>
                        <td><span>question order:</span> {{ $exam->exam_order }} </td>
                        <td><span>points:</span> {{ $exam->total_points }} </td>
                        <td><span>date:</span> {{ \Carbon\Carbon::parse($exam->last_attempt)->format('d M Y H:i') }} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No exams found.</p>
            @endif
        </div>
    </div>

    <div id="editProfileModal" class="modal">
        <form id="updateProfileForm" enctype="multipart/form-data">
            @csrf
            <label for="userName">Username:</label>
            <input type="text" name="userName" value="{{ $user->userName }}" required>

            <label for="avatar">Avatar:</label>
            <input type="file" name="avatar" accept="image/*">

            <button type="submit">Update Profile</button>
            <button type="button" id="closeModal">Cancel</button>
        </form>
    </div>

    <script>
        const modal = document.getElementById('editProfileModal');
        const editBtn = document.getElementById('editProfileBtn');
        const closeBtn = document.getElementById('closeModal');
        const updateForm = document.getElementById('updateProfileForm');

        editBtn.addEventListener('click', () => modal.style.display = 'block');
        closeBtn.addEventListener('click', () => modal.style.display = 'none');

        updateForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(updateForm);
            formData.append('_method', 'PUT');

            try {
                const response = await fetch("{{ route('user.update') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.ok) {
                    const userNameElem = document.querySelector('.user-info .info h2');
                    const avatarElem = document.querySelector('.user-info .avatar');

                    userNameElem.textContent = data.user.userName;

                    if (data.user.avatar) {
                        avatarElem.src = "{{ asset('storage') }}/" + data.user.avatar + "?t=" + new Date().getTime();
                    }

                    alert("Profile updated successfully!");
                    modal.style.display = 'none';
                } else {
                    alert("Update failed: " + (data.message || 'Unknown error'));
                }
            } catch (error) {
                console.error(error);
                alert("An error occurred while updating.");
            }
        });
    </script>

    @endsection

</body>

</html>