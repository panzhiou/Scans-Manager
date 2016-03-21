<div class="row">
    <div class="col s12">
        <table id="data-table-simple" class="responsive-table display" cellspacing="0">
            <thead>
                <tr>
                    <th data-field="name"><?=$this->lang->line('name');?></th>
                    <th data-field="date"><?=$this->lang->line('date');?></th>
                    <th data-field="id"><?=$this->lang->line('action');?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($news as $news_item): ?>
                <tr>
                    <td><?=$news_item['title'];?></td>
                    <td><?=$news_item['created'];?></td>
                    <td class="center"><a href="news/edit/<?=$news_item['codnews'];?>"><?=$this->lang->line('edit');?></a> | <a href="news/remove/<?=$news_item['codnews'];?>"><?=$this->lang->line('delete');?></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div><!-- /.col s12 -->
</div><!-- /.row -->
