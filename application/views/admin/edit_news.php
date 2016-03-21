<br><div class="row">
    <div class="col s12">
    <?php echo validation_errors(); ?>
        <div class="card-panel">
        <div class="row">
        <div class="container">
        <?php echo form_open('admin/news/update'); ?>
            <div class="input-field col s1">
                <input readonly id="id" name="id" type="text" class="validate" value="<?=$new['codnews']; ?>">
                <label class="active" for="id">Id</label>
            </div>
            <div class="input-field col s11">
                <input id="title" name="title" type="text" class="validate" value="<?=$new['title']; ?>">
                <label class="active" for="title"><?=$this->lang->line('title');?></label>
            </div>
            <div class="input-field col s12">
                <textarea name="text" class="materialize-textarea" id="editor"><?=$new['text']; ?></textarea>
                <label class="active" for="text"><?=$this->lang->line('description');?></label>
            </div>
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light" type="submit" name="action"><?=$this->lang->line('submit');?></button>
                <button type="reset" class="btn waves-effect waves-light"><?=$this->lang->line('reset');?></button>
            </div>
            
        </form>
        </div><!-- /.container-->
        </div><!-- /.row-->
        </div><!-- /.card-panel-->
    </div><!-- /.col s12 -->            
</div> <!-- /.row -->