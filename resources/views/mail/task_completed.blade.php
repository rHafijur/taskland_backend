<!DOCTYPE html>
<html>

<head>
    <title>Task Completion Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        p {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Task Completion Notification</h1>
        <p>Dear {{ $receiver->name }},</p>
        <p>This email is to inform you that <b>{{ $task->createdBy->name }}</b> has successfully completed the task
            titled
            "{{ $task->title }}" from the "{{ $task->project->title }}" project.</p>
        <p>Thank you,</p>
        {{-- <p>{{ $senderName }}</p>
        <p>{{ $senderPosition }}</p>
        <p>{{ $companyName }}</p> --}}
    </div>
</body>

</html>
