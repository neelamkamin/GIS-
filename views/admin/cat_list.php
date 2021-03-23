<?php include_once 'admin_header.php'; ?>

    <?php
          function sum() {
            $servername = "localhost:3306";
            $username = "root";
            $password = "";
            $dbname = "rms_db";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            $sql = "SELECT SUM(cost) AS value_sum FROM articles";
            //$sql = "SELECT COUNT(title) AS value_count FROM articles";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<b>TOTAL REPORT COST OF ALL PROJECT IS :- " . $row["value_sum"]. "  Lakhs (Including State Funded and CSS)</b>";
                }
            } else {
                echo "0 results";
            }
            $conn->close();

        }
        echo sum();
        ?>

<div class="container">
    <table class="table table-hover">
        <thead style="color:green;">
            <tr>
                <td><b>Sl._No.</td>
                <td><b>CATEGORY_OF_FUNDING</td>
                <td><b>TOTAL_AMOUNT (in Lakhs)</b></td>
            </tr>
            </thead>
        <tbody>
            <tr>
                <? if ( count($cat)): ?>
        <?php   $count = $this->uri->segment(3,0); ?>
        <?php foreach ($cat as $key => $sin): ?>
            
 <td> <?= ++$count ?> </td>
 <td> <?= anchor ("User/category_result/{$sin->category}",$sin->category) ?> </td>
 <td> Rs. <?= $sin->AMOUNT; ?> Lakhs </td>
 </tr>

      <?php endforeach; ?>
            <? else: ?>
        <tr>
        </tr>

        <? endif; ?>
            </tr>
        </tbody>
    </table>

<?= $this->pagination->create_links(); ?>
</div>
</body>
</html>