<body>
    <p>
        Hi, you have a new customer support notification:
    </p>
    <p>
        Name: {{ $data['name'] }} and Email: {{ $data['email'] }}
    </p>
    <p>
        {{ $data['message'] }}
    </p>
</body>