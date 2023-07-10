
@if (session()->exists('normal-message'))
<script>
    notifyNormal('{{session('title')}}', '{{session('normal-message')}}');
</script>
@elseif (session()->exists('success-message'))
<script>
    notifySuccess('{{session('title')}}', '{{session('success-message')}}');
</script>
@elseif (session()->exists('error-message'))
<script>
    notifyError('{{session('title')}}', '{{session('error-message')}}');
</script>
@elseif (session()->exists('warning-message'))
<script>
    notifyWarning('{{session('title')}}', '{{session('warning-message')}}');
</script>
@elseif (session()->exists('info-message'))
<script>
    notifyInfo('{{session('title')}}', '{{session('info-message')}}');
</script>
@endif
