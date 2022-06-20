<h1 class="heading">Dobavljači</h1>
<a href="suppliers_create" class="button-link">Novi dobavljač</a>

<?php
/** @var $data */
//print_r($data);
?>

<div style="overflow-x:auto;">
    <table class="data-table">
        <tr>
      
            <th>ID</th>
            <th>Naziv kompanije</th>
            <th>Grad</th>
            <th>Zemlja</th>
            <th>Broj telefona</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($data['suppliers'] as $row): ?>
            <tr>
                <td><?php echo $row->SupplierID ?></td>
                <td><?php echo $row->CompanyName ?></td>
                <td><?php echo $row->City ?></td>
                <td><?php echo $row->Country ?></td>
                <td><?php echo $row->Phone ?></td>
                <td><a href="suppliers_edit?SupplierID=<?php echo $row->SupplierID ?>" class="edit-btn"> Edit</a>
                </td>
                <td>
                    <form action="suppliers_delete" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="SupplierID" value="<?= $row->SupplierID ?>">
                        <input type="submit" value="Delete" class="delete-btn">
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>