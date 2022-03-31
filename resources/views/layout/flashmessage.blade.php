@if($message = Session::get('success'))
<script type="text/javascript">
	toastr.success('<?php echo $message; ?>', { timeOut:5000})
</script>
<?php  Session::forget('success'); ?>
@endif

@if($message = Session::get('error'))
<script type="text/javascript">
	toastr.error('<?php echo $message; ?>', { timeOut:5000})
</script>
<?php  Session::forget('error'); ?>
@endif

@if($message = Session::get('warning'))
<script type="text/javascript">
	toastr.warning('<?php echo $message; ?>', { timeOut:5000})
</script>
<?php  Session::forget('warning'); ?>
@endif

@if($message = Session::get('info'))
<script type="text/javascript">
	toastr.info('<?php echo $message; ?>','Info Alert', { timeOut:5000})
</script>
<?php  Session::forget('info'); ?>
@endif
