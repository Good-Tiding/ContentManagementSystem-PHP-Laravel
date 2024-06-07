<script>

    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var alert = document.querySelector('.alert');
            if (alert) {
                alert.remove();
            }
        }, 8000); // 5 seconds in milliseconds
    });

</script>
