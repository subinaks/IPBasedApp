<!DOCTYPE html>
<html>
<head>
    <title>Prompt for Previous Session</title>
</head>
<body>
    <h1>Another session is in progress!</h1>
    <p>Please close the previous session to continue.</p>
    <form action="{{ route('close-previous-session') }}" method="post">
        @csrf
        <button type="submit">Close Previous Session</button>
    </form>
</body>
</html>
