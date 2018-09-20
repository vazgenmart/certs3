<div class="table">
    <table id="table">
        <thead id="tr1">
        <?php
        $certs = new \common\models\Protocol();
        $attrs = $certs->attributeLabels();
        foreach ($attrs as $c):?>
        <?php if($c == 'ID') continue;?>
            <th><?= $c ?></th>
        <?php endforeach; ?>
        </thead>
        <?php foreach ($res as $item): ?>
            <tr id="tr2">
                <td><?= implode(', ',$item->sds);?></td>
                <td><?= $item->number_protocol;?></td>
                <td><?= $item->issue_date;?></td>
                <td><?= $item->testing_laboratory_info;?></td>
                <td><?= $item->product_information;?></td>
                <td><?= $item->manufacturer_information;?></td>
                <td><?= $item->applicant_information;?></td>
                <td><?= $item->is_valid ? 'ДА' : 'НЕТ';?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>