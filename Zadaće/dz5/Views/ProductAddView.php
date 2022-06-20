
<?php
/** @var $data */
//print_r($data);
?>
<div class="form-container">
    <div id="dataModal">
        <h4>Nova država</h4>
        <div class="divider surface-0 mv10"></div>
        <form id="form" method="post" action="products">

            <div class="input-row">
                <label for="ProductName">Naziv</label>
                <input id="ProductName" name="ProductName" type="text" />
            </div>
            <div class="input-row">
                <label for="CategoryID">Kategorija</label>
                    <select id="CategoryID" name="CategoryID">
                        <option value="-1" selected disabled>Odaberite kategoriju</option>
                        <?php foreach ($data['categories'] as $category): ?>
                        <option value="<?=$category->CategoryID?>"><?=$category->CategoryName?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            <div class="input-row">
                <label for="SupplierID">Dobavljač</label>
                    <select id="SupplierID" name="SupplierID">
                        <option value="-1" selected disabled>Odaberite dobavljača</option>
                        <?php foreach ($data['suppliers'] as $supplier): ?>
                        <option value="<?=$supplier->SupplierID?>"><?=$supplier->CompanyName?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <div class="divider surface-0 mv5"></div>
            <div class="button-row">
                <button type="submit" name="Submit">Dodaj</button>
            </div>
        </form>
    </div>
</div>