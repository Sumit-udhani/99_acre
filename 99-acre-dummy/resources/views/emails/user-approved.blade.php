<div>
   <h2>Hello {{ $user->name }},</h2>

    <p>Good news! 🎉</p>

    <p>Your account has been approved by the admin.</p>

    <p>You can now log in and access your dashboard.</p>

    <p>
        <a href="{{ url('/login') }}">
            Click here to Login
        </a>
    </p>

    <br>

    <p>Regards,<br>29Acres Team</p>
</div>
