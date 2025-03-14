<script>
    alert("Please wait sometime, to reload server.");
</script>
<div class="toasts-top-right fixed">
    <div class="toast bg-{{ $type }} fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header"><strong class="mr-auto"> {{ $message }}</strong><button data-dismiss="toast"
                type="button" class="ml-2 mb-1 close" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
    </div>
</div>
