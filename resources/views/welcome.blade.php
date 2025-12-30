<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Artisan Terminal</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Laravel Artisan Terminal</h2>
    <input type="text" id="command" placeholder="Enter artisan command (e.g., migrate, cache:clear)" style="width: 100%;" />
    <button onclick="executeCommand()">Run</button>
    <pre id="output"></pre>

    <script>
        function executeCommand() {
            var command = $('#command').val();
            $.post('/artisan-terminal', { command: command, _token: '{{ csrf_token() }}' }, function(response) {
                $('#output').text(response.output);
            }).fail(function(response) {
                $('#output').text("Error: " + response.responseJSON.error);
            });
        }
    </script>
</body>
</html>
