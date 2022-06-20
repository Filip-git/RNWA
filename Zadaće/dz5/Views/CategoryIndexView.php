<h1 class="heading">Kategorije</h1>
<a href="categories_create" class="button-link">Nova kategorija</a>

<?php
/** @var $data */
//print_r($data);
?>

<div style="overflow-x:auto;">
    <table class="data-table">
        <tr>
      
            <th>ID</th>
            <th>Naziv</th>
            <th>Opis</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($data['categories'] as $row): ?>
            <tr>
                <td><?php echo $row->CategoryID ?></td>
                <td><?php echo $row->CategoryName ?></td>
                <td><?php echo $row->Description ?></td>
                <td><a href="categories_edit?CategoryID=<?php echo $row->CategoryID ?>" class="edit-btn"> Edit</a>
                </td>
                <td>
                    <form action="categories_delete" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="CategoryID" value="<?= $row->CategoryID ?>">
                        <input type="submit" value="Delete" class="delete-btn">
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>