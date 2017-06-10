<div class="panel panel-default" style="padding-top: 2rem;">
    <div class="panel-body">
        <div class="form-group">
            <label class="col-md-2 control-label" for="activity_category">Name<span class="asterisk">*</span></label>
            <div class="col-md-10">
                <input type="text" id="name_kotoba" class="form-control" name="kotoba" value="{{ old('kotoba', isset($kotoba->name) ? $kotoba->name : '') }}" placeholder="">
                <span class="help-block"></span>
            </div>
        </div>
        <div id = 'mean_parent'>
            <div class="form-group" id='mean0'>
                @foreach ($kotoba_imis as $kotoba_imi)
                    <label class="col-md-2 control-label">Mean<span class="asterisk">*</span></label>
                    <div class="col-md-10">
                        <input type="text" id="mean_kotoba_0" class="form-control" name="mean_kotoba[]" value="{{ old('mean_kotoba[]', $kotoba_imi->name) }}" placeholder="">
                        <span class="help-block"></span>
                    </div>
                @endforeach
            </div>
        </div>
        <input type="button" id="add_more" value="Add More" class="btn btn-primary pull-right">
    </div>
</div>
<input type="submit" method= "PUT" name="submit_kotoba_create" value="Create" class="btn btn-primary pull-center">

<script>
    $(document).ready(function(){
        var count = 1;
        $("#add_more").click(function(){
            var newInputDiv = $(document.createElement('div')).attr("id", "mean" + count);
            newInputDiv.attr("class", "form-group");
            newInputDiv.after().html('<label class="col-md-2 control-label">Mean</label><div class="col-md-10"><input type="text" id="mean_kotoba_' + count + '" class="form-control" name="mean_kotoba[]" value="" placeholder=""><span class="help-block"></span><button type="button" id="delete_mean" class="btn btn-danger pull-right">Delete</button>');
            newInputDiv.appendTo('#mean_parent');
            count++;
        });
        $("#add_kotoba").on('click', '#delete_mean', function () {
            console.log($(this));
            $(this).parent("div").parent("div").remove();
        });

    });
</script>