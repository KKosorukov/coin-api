<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Barlow:400,500,600" rel="stylesheet">

    <link rel="manifest" href="site.webmanifest">
    <script src="/code" async defer></script>
</head>
<script type="text/javascript">
  (function() {
    var apiKey = "{{ $apiKey }}";
    var scriptTag = document.createElement('script');
    scriptTag.src = location.protocol + '//' + location.host + '/api/v1/' + apiKey;
    window.onload = function(ev) {
      document.querySelector('head').appendChild(scriptTag);
    }
  })();
</script>

<body>
{!! $content !!}
</body>

</html>