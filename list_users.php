<h3 class="text-center">All Users</h3>
<table class="table table-bordered mt-5 text-center">
    <thead>
        <tr>
            <th>Sl.No</th>
            <th>User Email</th>
            <th>User Image</th>
            <th>User Addresses</th>
            <th>User Mobile</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $get_payments = "SELECT * FROM `user`";
    $result = mysqli_query($con, $get_payments);
    $row_count = mysqli_num_rows($result);
    if ($row_count == 0) {
        echo "<tr><td colspan='5'><h3>No Users Yet!</h3></td></tr>";
    } else {
        $number = 0;
        while ($row_data = mysqli_fetch_assoc($result)) {
            $user_id = $row_data['id'];
            $user_email = $row_data['user_email'];
            $user_image = $row_data['user_image'];
            $user_addresses = $row_data['address'];
            $user_mobile = $row_data['user_mobile'];
            $number++;
            echo "<tr>
                <td>$number</td>
                <td>$user_email</td>
                <td><img src='../user/user_image/$user_image' alt='$user_email' class='food_image' style='width:120px; height:100px;'></td>
                <td>$user_addresses</td>
                <td>$user_mobile</td>
            </tr>";
        }
    }
    ?>
    </tbody>
</table>
