<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" language="javascript"></script>

<script>
    $(document).ready(function() {
        $('#dashmodalProduto').on('show.bs.modal', function() {
            $('.close_pagination').css({display:"none" });
        });

        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    });
</script>