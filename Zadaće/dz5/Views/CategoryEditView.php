
<?php
/** @var $data */
//print_r($data);
?>

<div class="form-container">
    <div id="dataModal">
        <h4>Uredite kategoriju</h4>
        <div class="divider surface-0 mv10"></div>
        <form id="form" method="post" action="categories_update">
            <input type="hidden" name="_method" value="PUT">
            <div class="input-row" style="display: none">
                <label for="CategoryID">ID</label>
                <input id="CategoryID" name="CategoryID" type="text" value="<?= $data['category']->CategoryID ?>" />
            </div>
            <div class="input-row">
                <label for="CategoryName">Naziv</label>
                <input id="CategoryName" name="CategoryName" type="text" value="<?= $data['category']->CategoryName ?>" />
            </div>
            <div class="input-row">
                <label for="Description">Opis</label>
                <input id="Description" name="Description" type="text" value="<?= $data['category']->Description ?>" />
            </div>
            <div class="divider surface-0 mv5"></div>
            <div class="button-row">
                <button type="submit" name="Submit">Uredi</button>
            </div>
        </form>
    </div>
</div>