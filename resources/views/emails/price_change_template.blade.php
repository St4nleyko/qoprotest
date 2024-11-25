<!DOCTYPE html>
<html>

<body>
<h1>Hello, {{ $user->name }}</h1>
<p>The price of {{ $currency->name }} ({{ $currency->symbol }}) has changed.</p>
<p>From €{{ number_format($oldPrice, 10) }} To: €{{ number_format($newPrice, 10) }}</p>

</body>
</html>
