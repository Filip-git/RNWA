
<?php
/** @var $data */
//print_r($data);
?>

<div class="form-container">
    <div id="dataModal">
        <h4>Uredite supplier-a</h4>
        <div class="divider surface-0 mv10"></div>
        <form id="form" method="post" action="suppliers_update">
            <input type="hidden" name="_method" value="PUT">
            <div class="input-row" style="display: none">
                <label for="SupplierID">ID</label>
                <input id="SupplierID" name="SupplierID" type="text" value="<?= $data['supplier']->SupplierID ?>" />
            </div>
            <div class="input-row">
                <label for="CompanyName">Naziv tvrtke</label>
                <input id="CompanyName" name="CompanyName" type="text" value="<?= $data['supplier']->CompanyName ?>" />
            </div>
            <div class="input-row">
                <label for="City">Grad</label>
                <input id="City" name="City" type="text" value="<?= $data['supplier']->City ?>" />
            </div>
            <div class="input-row">
                <label for="Country">Zemlja</label>
                <input id="Country" name="Country" type="text" value="<?= $data['supplier']->Country ?>" />
            </div>
            <div class="input-row">
                <label for="Phone">Broj telefona</label>
                <input id="Phone" name="Phone" type="text" value="<?= $data['supplier']->Phone ?>" />
            </div>
            <div class="divider surface-0 mv5"></div>
            <div class="button-row">
                <button type="submit" name="Submit">Uredi</button>
            </div>
        </form>
    </div>
</div>