<body>
    <p>
        Hi, you have a new potential client, here you can see their data and preferences:
    </p>
    <p>
        Email Client: {{ $client }}
    </p>
    <p>
        Preferences:
        <ul>
            @foreach ($categories as $category)
            <li>
                {{ $category->name }}
            </li>
            @endforeach
        </ul>
    </p>
</body>