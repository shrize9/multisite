@extends('layout')

@section('content')
<style>
    .region{
        font-size: 10pt;
    }
    .selected{
        font-weight: 700;
    }
</style>
<div class="row">
    <h4 class="col-12">Выбор города:</h4>
</div>
<div class="row">
    <input class="form-control col-6" type="text" id="search_city" placeholder="Введите название города"/>
</div>
<div class="row">
    @foreach($regions as $region)
    <div class="col-3">
        <a class="btn btn-link region {{$currentRegionId==$region->id ? 'selected':''}}" href="/{{$region->slug}}">{{$region->name}}</a>
    </div>
    @endforeach
</div>

<script>
    $(document).ready(function(){
        $("#search_city").keyup(function(){
            if($("#search_city").val()==""){
                $(".region").parent().show();
                return;
            }
            
            $(".region").parent().hide();
            $(".region").each(function(index, el){
                if($(el).text().toLowerCase().includes($("#search_city").val().toLowerCase())){
                    $(el).parent().show();
                }
            });
        });
    })
</script>    
@endsection