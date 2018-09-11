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
</head>
<script type="text/javascript">
  (function() {
    var apiKey = "e6320fdca2ac4b4c421ddee72433eea5";
    var scriptTag = document.createElement('script');
    scriptTag.src = 'http://{{ $generalHost }}/api/v1/' + apiKey;
    window.onload = function(ev) {
      document.querySelector('head').appendChild(scriptTag);
    }
  })();
</script>

<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  _paq.push(['trackAllContentImpressions']);
  _paq.push(['trackContentInteraction']);

  (function() {
    var u="{{ $matomoHost }}";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>


<body>
<div class="adv-vertical-popup"></div>
<div class="adv-horizontal-popup"></div>
<div class="adv-vertical-inline"></div>
<div class="adv-horizontal-inline"></div>

</body>

</html>