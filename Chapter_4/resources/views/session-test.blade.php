<!DOCTYPE html>
<html>
<head>
    <title>Session Test</title>
</head>
<body>

    <h2>Case 1 (Value = "Radhe Radhe")</h2>
    <p>has(): {{ $has1 ? 'true' : 'false' }}</p>
    <p>exists(): {{ $exists1 ? 'true' : 'false' }}</p>

    <h2>Case 2 (Value = null)</h2>
    <p>has(): {{ $has2 ? 'true' : 'false' }}</p>
    <p>exists(): {{ $exists2 ? 'true' : 'false' }}</p>

</body>
</html>