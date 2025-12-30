<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Reminder</title>
    <style>
        /* Reset styles for email clients */
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f5f5f5;
        }

        /* Container for email content */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }

        /* Header styling */
        .email-header {
            background-color: #2c5aa0;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }

        /* Body content styling */
        .email-body {
            padding: 30px;
        }

        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .meeting-details {
            background-color: #f9f9f9;
            border-left: 4px solid #2c5aa0;
            padding: 15px;
            margin: 20px 0;
        }

        .meeting-time {
            font-weight: bold;
            color: #2c5aa0;
            font-size: 16px;
        }

        .meeting-content {
            margin-top: 10px;
        }

        .closing {
            margin-top: 30px;
        }

        .signature {
            margin-top: 20px;
            color: #666666;
        }

        /* Footer styling */
        .email-footer {
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #777777;
        }

        /* Responsive adjustments */
        @media screen and (max-width: 600px) {
            .email-body {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Meeting Reminder</h1>
        </div>

        <div class="email-body">
            <p class="greeting">Hello {{ $employee->name }},</p>

            <p>This is a friendly reminder about your upcoming meeting.</p>

            <div class="meeting-details">
                <p><span class="meeting-time">{{ date('h:i A', strtotime($followup->time)) }}</span></p>
                <p class="meeting-content">Regarding: {{ $followup->content }}</p>
            </div>

            <p>Please ensure you're prepared and available at the scheduled time.</p>

            <p class="closing">Thank you!</p>

            <p class="signature">Best regards,<br>Sales Team</p>
        </div>

        <div class="email-footer">
            <p>This is an automated reminder. Please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} Tech Alphonic. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
