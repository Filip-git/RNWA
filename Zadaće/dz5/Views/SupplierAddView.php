
<?php
/** @var $data */
//print_r($data);
?>

<div class="form-container">
    <div id="dataModal">
        <h4>Novi supplier</h4>
        <div class="divider surface-0 mv10"></div>
        <form id="form" method="post" action="suppliers">
            
            <div class="input-row">
                <label for="CompanyName">Naziv tvrtke</label>
                <input id="CompanyName" name="CompanyName" type="text" />
            </div>
            <div class="input-row">
                <label for="City">Grad</label>
                <input id="City" name="City" type="text" />
            </div>
            <div class="input-row">
                <label for="Country">Zemlja</label>
                <input id="Country" name="Country" type="text" />
            </div>
            <div class="input-row">
                <label for="Phone">Broj telefona</label>
                <input id="Phone" name="Phone" type="text" />
            </div>
            <div class="divider surface-0 mv5"></div>
            <div class="button-row">
                <button type="submit" name="Submit">Dodaj</button>
            </div>
        </form>
    </div>
</div>