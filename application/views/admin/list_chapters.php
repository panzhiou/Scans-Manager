<div class="row">
    <div class="col s12">
        <table class="bordered">
            <thead>
                <tr>
                    <th data-field="name"><?=$this->lang->line('chapter');?></th>
                    <th data-field="date"><?=$this->lang->line('name');?></th>
                    <th data-field="id"><?=$this->lang->line('action');?></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($chapters as $chapter): ?>
                <tr>
                    <td><?=$chapter['chapter'];?></td>
                    <?php foreach ($mangas as $manga): 
                    if($manga['codma'] == $chapter['codma']) {?>
                    <td><?=$manga['name'];?></td>
                    <?php } endforeach; ?>
                    <td class="center"><a href="chapter/edit/<?=$chapter['codch'];?>"><?=$this->lang->line('edit');?></a> | <a href="chapter/remove/<?=$chapter['codch'];?>"><?=$this->lang->line('delete');?></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div><!-- /.col s12 -->
</div><!-- /.row -->