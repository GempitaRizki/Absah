<!DOCTYPE html>
<html>
<head>
    <title>Aktivitas Pengguna</title>
</head>
<body>
    <img src="{{ public_path('assets/img/logo/Absah-Logo.png') }}" style="max-width: 200px; margin-bottom: 20px;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Message</th>
                <th>IP</th>
                <th>Browser</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity->id }}</td>
                    <td>{{ $activity->type }}</td>
                    <td>{{ $activity->message }}</td>
                    <td>{{ $activity->ip }}</td>
                    <td>{{ $activity->user_agent }}</td>
                    <td>{{ $activity->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
