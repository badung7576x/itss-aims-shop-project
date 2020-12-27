@foreach($propertyTypes as $proType)
    <div class="form-group">
        <label for="">{{$proType->property_name}}</label>
        <input type="text" class="form-control" name="properties[{{$proType->id}}]" value="{{$oldDatas[$proType->id] ?? ""}}" placeholder="">
    </div>
@endforeach
