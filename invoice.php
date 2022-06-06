<?php // vim: set sw=4 ts=4 expandtab nu:
/**
 * Index File
 *
 * PHP version 8.0
 *
 * @category IndexFile
 * @package  Query
 * @author   Adrian P. Ireland <procras2@gmail.com>
 * @license  http://gnu.org/licences/gpl-3.0 GPLv3
 * @link     http://localhost/~adrian/query
 */

require 'templates/header.inc';
?>

<div class="mainbody">
    <div class="container">
        <div class="header">
            <h2>Query Invoices for a Day</h2>
        </div>
        <form id="form" class="form">
            <div class="form-control">
                <label for="day">Date</label>
                <input type="date" name="day" id="day" value="2022-05-21">
                <img class="fa fa-check-circle"
                    src="img/clear/circle-check.svg"
                    height="20"
                    width="20">
                <img class="fa fa-exclamation-circle"
                    src="img/clear/circle-pause.svg"
                    height="20"
                    width="20">
                <small>Error Message</small>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
    <div>
        <div id="pets"></div>
    </div>
</div>

<script defer src="js/genform.js"></script>
<script>
const day=document.getElementById('day');
const pets=document.getElementById('pets');

function checkInputs() {
    // get the values from the inputs, use trim to remove whitespace
    let passedChecks = true;
    const dayValue = day.value.trim();

    // Check day field
    if (dayValue === '' || dayValue == null) {
        // show error
        // add error class
        setErrorFor(day, 'You must enter a date');
        passedChecks = false;
    } else {
        // add success class
        setSuccessFor(day);
    }

    if (passedChecks) {
        // We have not passed the checks so do not submit the form
        //form.submit();
        const request = new XMLHttpRequest();

        request.onload = () => {
            //console.log(request.responseText)
            let responseObject = null;

            try {
                responseObject = JSON.parse(request.responseText);
            } catch (e) {
                console.error('Could not parse JSON!');
            }

            if (responseObject) {
                handleResponse(responseObject);
            }
        }

        const requestData = `day=${form.day.value}`;

        request.open('POST', 'sql/query.php');
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        request.send(requestData);
    }
}

// Logic for when we get rows back from the server
function handleResponse(responseObject) {
    // Create and add html to page
    // We will add it to the div with id of pets
    var htmlString = "";

    // Empty the div contents eg previous run
    while (pets.firstChild) {
        pets.removeChild(pets.firstChild);
    }

    if (responseObject.rows.length > 0) {
        var totalBilled = 0;
        htmlString += '<table class="table">';
        htmlString += "<thead>";

        htmlString += "<tr>";
        for (var i = 0; i< responseObject.headers.length; i++) {
            htmlString += `<th>${responseObject.headers[i]}</th>`;
        }
        htmlString += "</tr>";

        htmlString += "</thead>";
        htmlString += "<tbody>";

        // Loop through the records
        for (var i = 0; i < responseObject.rows.length; i++) {
            htmlString += "<tr>";
            // Loop through the individual fields
            for (var j = 0; j< responseObject.headers.length; j++) {
                htmlString += `<td>${responseObject.rows[i][j]}</td>`;
            }
            htmlString += "</tr>";
            totalBilled += responseObject.rows[i][3];
        }
        htmlString += "</tbody>";
        htmlString += "</table>";

        // Add the string to the DOM
        pets.insertAdjacentHTML('beforeend', htmlString);
        alert('Total Billed: ' + totalBilled);
    } else {
        alert('Thats an empty result!');
    }
    
}
</script>
<?php
require 'templates/footer.inc';

