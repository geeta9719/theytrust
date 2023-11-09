<!-- Latest compiled JavaScript -->
<script src="{{asset('front_components/js/jquery.js')}}"></script>
<script src="{{asset('front_components/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front_components/js/css3-animate-it.js')}}"></script>

<script type="text/javascript">
var search;
$(document).ready(function(){
    search = function(){
        debugger;
        var term = $("#search").val();  
        console.log("ASdfasdf");
        if(term.length >= 3){
        
            $.ajax({
                url:"{{url('get-search-list')}}",
                type: "GET",
                data: { term: term, _token: '{{csrf_token()}}' },
                success: function(result){
                    console.log(result);
                    $(".srcbxc").html(result);
                    $(".srcbxc").show();
                }
            });
        }else{
             $(".srcbxc").hide();
        }
    }

    $("body").click(function(){
        $(".srcbxc").hide();
    });  
});
</script>