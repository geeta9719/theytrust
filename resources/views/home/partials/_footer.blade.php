<!-- Latest compiled JavaScript -->
<script src="{{asset('front_components/js/jquery.js')}}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('front_components/js/css3-animate-it.js')}}"></script>
<script src="{{asset('front_components/js/slick.js')}}"></script>
<script src="{{asset('front_components/js/custom.js')}}"></script>


<script type="text/javascript">
var search;
$(document).ready(function(){
    
    search = function(){
        var term = $("#search").val();  
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
    $('.modal-signin').click(function(){
       $('#singin-modal').modal('show'); 
    });
    
});
</script>