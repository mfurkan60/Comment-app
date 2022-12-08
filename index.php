<?php require_once("modul/db.php") ?>
<?php
if (isset($_POST['commentBtn'])) {
    $commentsAdd = $db->prepare("INSERT INTO comments SET 
    userName=:userName,
    email =:email,
    comment =:comment");

    $commentsAdd->execute([
        'userName' => strip_tags($_POST['userName']),
        'email' => strip_tags($_POST['email']),
        'comment' => strip_tags($_POST['comment'])
    ]);

    if ($commentsAdd) {
        echo '<div class="alert alert-primary" role="alert">
        Comment added Successfully
</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
Erorr
</div>';
    }
}     ?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.0/css/all.min.css" integrity="sha512-ykRBEJhyZ+B/BIJcBuOyUoIxh0OfdICfHPnPfBy7eIiyJv536ojTCsgX8aqrLQ9VJZHGz4tvYyzOM0lkgmQZGw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Comment</title>
</head>

<body>
    <h1 class=" text-center"> Comment</h1>

    <div class="container mt-5">

        <div class="row  d-flex justify-content-center">
            <div class="col-md-8 mb-3  ">
                <div class="card">
                    <h4 class="text-center p-3">Leave a Comment</h4>
                    <form class="p-4" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="userName" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email </label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
                            <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <button name="commentBtn" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8">



                <h4 class="text-center p-3 ">All Comments</h4>


                <?php

                $commentQuery = $db->prepare("SELECT * FROM comments ");
                $commentQuery->execute();
                $comments = $commentQuery->fetchAll(PDO::FETCH_ASSOC);
                foreach ($comments as $key => $comment) { ?>

                    <div class="card p-3 mt-3">

                        <div class="d-flex justify-content-between align-items-center">

                            <div class="user d-flex flex-row align-items-center">

                                <span><small class="font-weight-bold text-primary" style="font-size:1.4rem ;"><?= $comment['userName'] ?></small>
                                    <br> <i class="font-weight-bold"> "<?= $comment['comment']  ?>"</i></span>

                            </div>


                            <small><?= $comment['date'] ?>

                            </small>


                        </div>


                        <div class="action d-flex justify-content-between mt-2 align-items-center">



                            <div class="icons align-items-center">

                                <span>
                                    <?= $comment['commentLike'] ?><i class="fa fa-star text-warning"></i>
                                </span>


                            </div>

                        </div>



                    </div>





                <?php } ?>


















            </div>

        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>