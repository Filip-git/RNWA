
<?php
/** @var $data */
//print_r($data);
?>

<div class="form-container">
    <div id="dataModal">
        <h4>Nova kategorija</h4>
        <div class="divider surface-0 mv10"></div>
        <form id="form" method="post" action="categories">
            <div class="input-row">
                <label for="CategoryName">Naziv</label>
                <input id="CategoryName" name="CategoryName" type="text" />
            </div>
            <div class="input-row">
                <label for="Description">Opis</label>
                <input id="Description" name="Description" type="text" />
            </div>
            <div class="divider surface-0 mv5"></div>
            <div class="button-row">
                <button type="submit" name="Submit">Dodaj</button>
            </div>
        </form>
    </div>
</div>