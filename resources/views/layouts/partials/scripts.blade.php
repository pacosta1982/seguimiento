<!--Load JQuery-->
<script src="{{asset('js/jquery.min.js')}}"></script>
<!-- Load bootstrap JS -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- Load metismenu JS -->
<script src="{{asset('js/plugins/metismenu/jquery.metisMenu.js')}}"></script>
<!-- Load block UI JS -->
<script src="{{asset('js/plugins/blockui-master/jquery-ui.js')}}"></script>
<script src="{{asset('js/plugins/blockui-master/jquery.blockUI.js')}}"></script>
<!-- Load custom Mouldifi JS functions -->
<script src="{{asset('js/functions.js')}}"></script>

<script type="text/javascript">

    $(document).ready(function() {
        var li=$('ul > li > a[href="{{Request::url()}}"]');
        li.parent().attr("class","active");
        li.parent().parent().attr("class","nav");
        li.parent().parent().parent().attr("class","has-sub active");
    });

</script>