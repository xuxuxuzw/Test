<!-- CSRF Token，如果单独页面的话就要加上 -->
{{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
{{--<title>扫码登录</title>--}}
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div id="app">
    <main class="py-4">
        <web-login></web-login>
    </main>
</div>
<script src="{{ asset('js/app.js') }}"></script>
