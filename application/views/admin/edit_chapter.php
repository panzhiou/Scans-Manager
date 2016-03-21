<br><div class="row">
    <div class="col s12">
        <?php echo validation_errors(); ?>
        <div class="card-panel">
        <div class="row">
        <div class="container">        
        <?php echo form_open_multipart('admin/chapter/add'); ?>
            <div class="input-field col s1">
                <input readonly id="id" name="id" type="text" class="validate" value="<?=$chapter['codch']; ?>">
                <label class="active" for="id">Id</label>
            </div>
            <div class="col s11">
                <label><?=$this->lang->line('series');?></label>
                    <?php $options = array(); 
                    foreach($mangas as $manga)  { 
                        $options[$manga['codma']] = $manga['name'];
                     } 
                        echo form_dropdown('codma', $options, $chapter['codma'], ' class="browser-default"');
                     ?>
            </div>
            <div class="input-field col s12">
                <input id="chapter" name="chapter" type="text" class="validate" value="<?=$chapter['chapter']; ?>">
                <label class="active" for="chapter"><?=$this->lang->line('chapter');?></label>
            </div>
            <div class="input-field col s12">
                <input id="name" name="name" type="text" class="validate" value="<?=$chapter['name']; ?>">
                <label class="active" for="name"><?=$this->lang->line('name');?></label>
            </div>
                <div class="row"><div class="col s12">
                    <label><?=$this->lang->line('language');?></label>
                    <?php
                        $options = array(
                            'es'  => $this->lang->line('lang_es'),
                            'us'    => $this->lang->line('lang_en'),
                        );
                        echo form_dropdown('language', $options, $chapter['language'], ' class="browser-default"');
                     ?>
                </div></div>
                <!-- Download links -->
                <div class="row"><div class="input-field col s6">
                    <input id="link1" name="link1" type="text" class="validate" value="<?=$chapter['download1']; ?>">
                    <label class="active" for="link1">Link 1</label>
                </div>
                <div class="input-field col s6">
                    <input id="link2" name="link2" type="text" class="validate" value="<?=$chapter['download2']; ?>">
                    <label class="active" for="link2">Link 2</label>
                </div></div>    
                <div class="row"><div class="file-field input-field">
                    <div class="btn">
                        <span><?=$this->lang->line('file');?></span>
                        <input name="userfile" type="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div></div>   
                <div class="row"><div class="input-field col s6">
                    <button class="btn waves-effect waves-light" type="submit"><?=$this->lang->line('submit');?></button>
                    <button type="reset" class="btn waves-effect waves-light"><?=$this->lang->line('reset');?></button>
                </div></div>   
        </form>
        </div><!-- /.container-->
        </div><!-- /.row-->
        </div><!-- /.card-panel-->
    </div><!-- /.col s12 -->            
</div> <!-- /.row -->