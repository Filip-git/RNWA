<h1 class="heading">Proizvodi</h1>
<a href="products_create" class="button-link">Novi proizvod</a>

<?php
/** @var $data */
//print_r($data);
?>

<div style="overflow-x:auto;">
    <table class="data-table">
        <tr>
            <th>ID</th>
            <th>Naziv</th>
            <th>Dobavljač</th>
            <th>Kategorija</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($data['products'] as $row): ?>
            <tr>
                <td><?php echo $row->ProductID ?></td>
                <td><?php echo $row->ProductName ?></td>
                <td><?php echo $row->CompanyName ?></td>
                <td><?php echo $row->CategoryName ?></td>
                <td><a href="products_edit?ProductID=<?php echo $row->ProductID ?>" class="edit-btn"> Edit</a>
                </td>
                <td>
                    <form action="products_delete" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="ProductID" value="<?= $row->ProductID ?>">
                        <input type="submit" value="Delete" class="delete-btn">
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>



