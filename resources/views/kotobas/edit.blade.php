@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {!! Form::open( array('route' => ['kotobas.update', 'id' => $kotoba->id], 'id' => 'add_kotoba', 'class' => 'form-horizontal', 'method' => 'put', 'files' => 'true')) !!}
            <div class="panel panel-default" style="padding-top: 2rem;">
    <div class="panel-body">
        <div class="form-group">
            <label class="col-md-2 control-label" for="activity_category">Name<span class="asterisk">*</span></label>
            <div class="col-md-10">
                <input type="text" id="name_kotoba" class="form-control" name="kotoba" value="{{ old('kotoba', isset($kotoba->name) ? $kotoba->name : '') }}" placeholder="">
                <span class="help-block"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label" for="activity_category">Phonetic<span class="asterisk">*</span></label>
            <div class="col-md-10">
                <input type="text" id="phonetic_kotoba" class="form-control" name="phonetic"  value="{{ old('phonetic', isset($kotoba->phonetic) ? $kotoba->phonetic : '') }}" placeholder="">
                <span class="help-block"></span>
            </div>
        </div>
        <div id = 'mean_parent'>
            @foreach ($kotoba_imis as $index => $kotoba_imi)
            <div class="form-group" id={{'mean' . $index}}>
                <label class="col-md-2 control-label">Mean<span class="asterisk">*</span></label>
                <div class="col-md-9">
                    <input type="text" id="mean_kotoba_0" class="form-control" name="mean_kotoba[]" value="{{ old('mean_kotoba[]', $kotoba_imi->mean) }}" placeholder="">
                </div>
              <div class="col-md-1">
                <button type="button" id="delete_mean" class="btn btn-danger pull-right">Delete</button>
              </div>
            </div>
            @endforeach
        </div>
        <input type="button" id="add_more" value="Add More" class="btn btn-primary pull-right">
    </div>
</div>
<input type="submit" method= "PUT" name="submit_kotoba_edit" value="Update" class="btn btn-primary pull-center">
<button type="button" class="btn btn-default pull-center">Back</button>
        {!! Form::close() !!}
    </div>
</div>

<script>
    $(document).ready(function(){
        var meanCount = $("#mean_parent")[0].childElementCount;
        if (meanCount == 1) {
          $("#delete_mean").attr('disabled','disabled');
        }
        $("#add_more").click(function(){
            var newInputDiv = $(document.createElement('div')).attr("id", `mean${meanCount}`);
            newInputDiv.attr("class", "form-group");
            newInputDiv.after().html(`
              <label class="col-md-2 control-label">Mean<span class="asterisk">*</span></label>
              <div class="col-md-9">
                <input type="text" id="mean_kotoba_${meanCount}" class="form-control" name="mean_kotoba[]" value="" placeholder="">
              </div>
              <div class="col-md-1">
                <button type="button" id="delete_mean" class="btn btn-danger pull-right">Delete</button>
              </div>
            `);
            newInputDiv.appendTo('#mean_parent');
            meanCount++;
            if (meanCount > 1) {
              $("#delete_mean").removeAttr('disabled');
            }
        });
        $("#add_kotoba").on('click', '#delete_mean', function () {
            $(this).parent("div").parent("div").remove();
            meanCount--;
            if (meanCount == 1) {
              $("#delete_mean").attr('disabled','disabled');
            }
        });

    });
</script>
@endsection
