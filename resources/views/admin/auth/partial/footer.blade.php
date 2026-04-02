<script src={{ asset('assets/lib/jquery/jquery.js') }}></script>
<script src={{ asset('assets/lib/popper.js/popper.js') }}></script>
<script src={{ asset('assets/lib/bootstrap/bootstrap.js') }}></script>
<script src={{ asset('assets/lib/select2/js/select2.min.js') }}></script>

<script>
    $(function() {
        'use strict';

        $('.select2').select2({
            minimumResultsForSearch: Infinity
        });
    });
</script>
</body>

</html>
