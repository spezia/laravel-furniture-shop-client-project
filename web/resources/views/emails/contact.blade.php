<html>
    <body>
        <p>Hello Admin</p>
        <p>you got this message from contact form</p>
        <pre>
            <p>Name: {{ $data['name'] }}</p>
            <p>Email: {{ $data['email'] }}</p>
            <p>Phone: {{ $data['phone'] }}</p>
            <p>Message: {{ $data['message'] }}</p>
        </pre>

    </body>
</html>