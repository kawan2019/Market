@extends('layout.nav')
@section('content')

<div class="row m-3 justify-content-center">
    <div class="col-lg-4 col-12 text-center">
        <canvas width="320" height="240" id="webcodecam-canvas"></canvas>
        <button title="Play" style="background-color:#025091;" class="btn rounded-0 text-white border-white m-2" id="play" type="button" data-toggle="tooltip">Play</button><br>
        <span class="notify text-center mt-3 mb-3 text-white"></span>
        <br>
        <select class="form-control" id="camera-select"></select>
    </div>
    <div class="col-lg-4 col-12 text-center ">
        <div class=" text-center p-2 text-darker shadow bg-white">
            <br>
            <img src="{{asset('assets/img/drug.svg')}}" width="70" alt="">
            <br>
            <div class="row mt-3 mb-1 ml--2 mr--2" style="background-color: #f7f7f7">
                <div class="col"><small>Paracetol</small></div>
                <div class="col"><small>3</small></div>
                <div class="col"><small>20000</small></div>
            </div>
            <span class="btn btn-darker mt-3">Totall : 20,000IQD</span>
        </div>
        <a href="#" class="btn btn-danger mt-3">Check Out </a>
    </div>
    <div class="tb"></div>

</div>



<script type="text/javascript" src="{{asset('assets/lib/qrcodelib.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/lib/webcodecamjs.js')}}"></script>
<script> 
function sound(sound){
        var obj = document.createElement("audio");
        obj.src = "assets/audio/"+ sound +".mp3";
        obj.play();
    }
    function table(){
        $.post('viewtb',{_token : '{{csrf_token()}}'} , function(responce){
            $(".tb").html(responce);
        })
    }
    function undo(sold_id){
        $.post('undo',{
            sold_id : sold_id,
            _token : '{{csrf_token()}}'}
        ,function(responce){
            if (responce === "success") {
                table();
            }else{
                table();
            }
        });
    }
(function(undefined) {
    "use strict";
    function Q(el) {
        if (typeof el === "string") {
            var els = document.querySelectorAll(el);
            return typeof els === "undefined" ? undefined : els.length > 1 ? els : els[0];
        }
        return el;
    }
    

    var play = Q("#play"),
    args = {
        resultFunction: function(res) {
            var id = res.code;
            $.post('sale',{
                id:id,
                _token : '{{csrf_token()}}'
            },function(responce){
                if (responce === "success") {
                    $(".notify").html(id);
                    table();
                }else{
                    sound("fail");
                    $(".notify").html(responce);
                }
            })
        }
        
    };
    var decoder = new WebCodeCamJS("#webcodecam-canvas").buildSelectMenu("#camera-select", "environment|back").init(args);
    play.addEventListener("click", function() {
        decoder.play();
    }, false);
  
    document.querySelector("#camera-select").addEventListener("change", function() {
        if (decoder.isInitialized()) {
            decoder.stop().play();
        }
    });
}).call(window.Page = window.Page || {});
</script>
@endsection