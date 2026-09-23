<h2>Company Invitation</h2>

<p>
    You have been invited to join
    <strong>{{ $invitation->company->name }}</strong>.
</p>

<p>
    Your role: <strong>{{ $invitation->role->name }}</strong>
</p>

<a href="{{ url('/register/invite/' . $invitation->token) }}">
    Accept Invitation
</a>