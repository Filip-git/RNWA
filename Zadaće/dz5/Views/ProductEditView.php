
<?php
/** @var $data */
//print_r($data);
?>

<div class="form-container">
    <div id="dataModal">
        <h4>Uredi državu</h4>
        <div class="divider surface-0 mv10"></div>
        <form id="form" method="post" action="products_update">
            <input type="hidden" name="_method" value="PUT">
            <div class="input-row">
                <label for="ProductID">ID</label>
                <input id="ProductID" name="ProductID" type="text" value="<?= $data['product']->ProductID ?>"  />
            </div>
            <div class="input-row">
                <label for="ProductName">Naziv</label>
                <input id="ProductName" name="ProductName" type="text" value="<?= $data['product']->ProductName ?>" />
            </div>
            <div class="input-row">
                <label for="CategoryID">Kategorija</label>
                    <select id="CategoryID" name="CategoryID">
                        <option value="-1" selected disabled>Odaberite kategoriju</option>
                        <?php foreach ($data['categories'] as $region): ?>
                        <option value="<?=$region->CategoryID?>" <?= $region->CategoryID == $data['product']->CategoryID ? 'selected' : '' ?>><?=$region->CategoryName?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <div class="input-row">
            <label for="SupplierID">Dobavljač</label>
                <select id="SupplierID" name="SupplierID">
                    <option value="-1" selected disabled>Odaberite dobavljača</option>
                    <?php foreach ($data['suppliers'] as $region): ?>
                    <option value="<?=$region->SupplierID?>" <?= $region->SupplierID == $data['product']->SupplierID ? 'selected' : '' ?>><?=$region->CompanyName?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="divider surface-0 mv5"></div>
            <div class="button-row">
                <button type="submit" name="Submit">Uredi</button>
            </div>
        </form>
    </div>
<div>