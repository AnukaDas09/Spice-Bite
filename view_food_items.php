<h3 class="text-center">All Food Items</h3>
<table class="table table-bordered mt-5 text-center">
    <colgroup>
        <col span="1" style="width: 10%;">
        <col span="1" style="width: 15%;">
        <col span="1" style="width: 20%;">
    </colgroup>
    <thead class="bg-danger text-light fw-bold">
        <tr>
            <th>Food Id</th>
            <td>Food Title</td>
            <td>Food Image</td>
            <td>Food price</td>
            <td>Sales</td>
            <td>Status</td>
            <td>Edit</td>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $get_food_items = "Select * from `food`";
        $result = mysqli_query($con, $get_food_items);
        while ($row = mysqli_fetch_assoc($result)) {
            $food_id = $row['food_id'];
            $food_title = $row['food_title'];
            $food_image = $row['food_image'];
            $food_price = $row['food_price'];
            $food_status = $row['status'];
        ?>
            <tr style="height:100px;">
                <td><?php echo "$food_id"; ?></td>
                <td><?php echo "$food_title"; ?></td>
                <td>
                    <?php echo "<img src='food_images/$food_image' class='food_image' style='width:120px; height:100px;'>"; ?>
                </td>
                <td><?php echo "$food_price"; ?></td>
                <td><?php $get_count="Select * from `orders_pending` where food_id=$food_id";
                $result_count=mysqli_query($con,$get_count);
                $rows_count=mysqli_num_rows($result_count);
                echo $rows_count;
                ?></td>
                <td><?php echo "$food_status"; ?></td>
                <td><a href='index.php?edit_food_item=<?php echo $food_id; ?>' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_food_item=<?php echo $food_id; ?>' class='text-dark'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>