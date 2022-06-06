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
<section class="mysection">
    <article>
        <h2>Queries</h2>
        <ul>
          <li><a href="invoice.php">Invoices</a> for a day</li>
          <li><a href="roominvoice.php">Rooms Invoices</a> for a day</li>
        </ul>  
    </article>
</section>
<?php
require 'templates/footer.inc';

