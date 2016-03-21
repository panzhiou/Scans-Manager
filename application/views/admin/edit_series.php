<div class="section">
<div class="row">
    <div class="col s12">
        <div class="card-panel">
        <?php echo validation_errors(); ?>
        <div class="row">
        <div class="container">
            <?php echo form_open_multipart('admin/series/update'); ?>
                <div class="row"><div class="input-field  col s1">
                    <input id="id" name="id" type="text" class="validate" value="<?=$serie['codma']; ?>" readonly>
                    <label class="active" for="id">Id</label>
                </div>
                <div class="input-field  col s11">
                    <input id="name" name="name" type="text" class="validate" value="<?=$serie['name']; ?>">
                    <label class="active" for="name"><?=$this->lang->line('name');?></label>
                </div></div>
                <div class="row"><div class="input-field  col s12">
                    <input id="author" name="author" type="text" class="validate" value="<?=$serie['author']; ?>">
                    <label class="active" for="author"><?=$this->lang->line('author');?></label>
                </div></div>
                <div class="row"><div class="input-field  col s12">
                    <input id="artist" name="artist" type="text" class="validate" value="<?=$serie['artist']; ?>">
                    <label class="active" for="artist"><?=$this->lang->line('artist');?></label>
                </div></div>
                <div class="row"><div class="input-field  col s12">
                    <textarea class="materialize-textarea" name="description"><?=$serie['description']; ?></textarea>
                    <label class="active" for="description"><?=$this->lang->line('description');?></label>
                </div></div>
                <div class="row"><div class="col s12">
                    <label><?=$this->lang->line('type');?></label>
                    <?php
                        $options = array(
                            'Manga'     => 'Manga',
                            'OneShot'   => 'One-Shot',
                            'Manhwa'    => 'Manhwa',
                            'Manhua'    => 'Manhua',
                        );
                        echo form_dropdown('type', $options, $serie['type'], ' class="browser-default"');
                     ?>
                </div></div>
                <div class="row"><div class="col s12">
                    <label><?=$this->lang->line('status');?></label>
                    <?php
                        $options = array(
                            '1'     => $this->lang->line('complete'),
                            '0'     => $this->lang->line('ongoing'),
                        );
                        echo form_dropdown('status', $options, $serie['status'], ' class="browser-default"');
                     ?>
                </div></div>
                <div class="row"><div class="col s12">
                    <input type="checkbox" name="adult" id="adult" value="1" <?php if($serie['adult'] == '1') { echo 'checked'; } ?>/>
                    <label for="adult"><?=$this->lang->line('adult');?></label>
                </div></div>
                <div class="row"><div class="col s12">
                    <input type="checkbox" name="hidden" id="hidden" value="1" <?php if($serie['hidden'] == '1') { echo 'checked'; } ?>/>
                    <label for="hidden"><?=$this->lang->line('hidden');?></label>
                </div></div>
                <div class="row"><div class="file-field input-field col s12">
                    <div class="btn">
                        <span><?=$this->lang->line('cover');?></span>
                        <input name="cover" type="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" value="<?=$serie['thumbail']?>">
                    </div>
                </div></div>
                <div class="row"><div class="input-field col s6">
                    <button class="btn waves-effect waves-light" type="submit"><?=$this->lang->line('submit');?></button>
                    <button type="reset" class="btn waves-effect waves-light"><?=$this->lang->line('reset');?></button>
                </div></div>   
            </form>
        </div><!-- /.container -->
        </div><!-- /.row -->
        </div><!-- /.card-panel -->
    </div><!-- /.col s12 -->            
</div> <!-- /.row -->
</div> <!-- /.section -->