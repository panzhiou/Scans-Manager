<div class="row">
    <div class="col s12">
        <table class="bordered">
            <thead>
                <tr>
                    <th data-field="name"><?=$this->lang->line('name');?></th>
                    <th data-field="date"><?=$this->lang->line('date');?></th>
                    <th data-field="id"><?=$this->lang->line('edit');?></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($series as $serie): ?>
                <tr>
                    <td><?=$serie['name'];?></td>
                    <td><?=$serie['created'];?></td>
                    <td class="center"><a href="series/edit/<?=$serie['codma'];?>"><?=$this->lang->line('edit');?></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div><!-- /.col s12 -->
</div><!-- /.row -->