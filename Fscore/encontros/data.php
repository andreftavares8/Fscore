
<?php




$html_date ='
<div class="container">
    <form class="form-group"  action"?m='.$module.'" method="POST" id="form-data-encontros">
        <div class="col-sm-10">
            <div class="input-group date data_formato"   data-date-format="yyyy-mm-dd">
                <input type="text" class="form-control" name="data" style="display:none" >
                <button type="submit" style="display:none"  id="button-submit-encontro"></button>
                <span class="input-group-addon">
                    <span class="far fa-calendar"></span>
                    
                </span>
            </div>
        </div>
    </form>
</div>';
echo $html_date;
?>