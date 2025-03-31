<h3 class="text-center">All Cuisines!</h3>
<table class="table table-bordered mt-5 text-center">
    <thead>
        <tr>
            <th>Sl.No</th>
            <th>Cuisine Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $select_cui = "Select * from `cuisines`";;
        $result = mysqli_query($con, $select_cui);
        $number = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $cuisine_id = $row['cuisine_id'];
            $cuisine_title = $row['cuisine_title'];
            $number++;
        ?>
            <tr>
                <td><?php echo $number; ?></td>
                <td><?php echo $cuisine_title; ?></td>
                <td><a href='index.php?edit_cuisine=<?php echo $cuisine_id; ?>' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_cuisine=<?php echo $cuisine_id; ?>' type="button" class="text-dark" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>

            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                Delete this Cuisine?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary"><a href='index.php?delete_cuisine=
                <?php echo $cuisine_id; ?>' class="text-dark text-decoration-none">Yes</a></button>
            </div>
        </div>
    </div>
</div>