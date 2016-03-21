<div class="section">
<div class="row">
    <div class="col s12">
        <div class="card-panel">
        <div class="row">
        <div class="container">
        <?php echo form_open('admin/news/add'); ?>
            <div class="input-field col s12">
                <input id="title" name="title" type="text" class="validate">
                <label for="title"><?=$this->lang->line('title');?></label>
            </div>
            <div class="input-field col s12">
                <textarea name="text" class="materialize-textarea" id="editor"></textarea>
                <label for="text"><?=$this->lang->line('description');?></label>
            </div>
            <div class="input-field col s12">
                <button class="btn cyan waves-effect waves-light" type="submit" name="action"><?=$this->lang->line('submit');?><i class="mdi-content-send right"></i></button>
                <button type="reset" class="btn cyan waves-effect waves-light"><?=$this->lang->line('reset');?></button>
            </div>
        </form>
        </div><!-- /.container-->
        </div><!-- /.row-->
        </div><!-- /.card-panel-->
    </div><!-- /.col s12 -->            
</div> <!-- /.row -->
</div> <!-- /.section -->
            
