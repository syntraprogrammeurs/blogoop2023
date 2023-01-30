<section class="mb-5">
    <div class="card bg-light">
        <div class="card-body">
            <!-- Comment form-->

            <form class="mb-4" method="post" enctype="multipart/form-data">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" placeholder="author...">
                <textarea name="body" class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
            <!-- Comment with nested comments-->
            <?php foreach($comments as $comment): ?>
            <div class="d-flex mb-4">
                <!-- Parent comment-->

                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                <div class="ms-3">

                        <div class="fw-bold"><?php echo $comment->author; ?></div>
                        <p><?php echo $comment->body; ?></p>
                        <!-- Child comment
                        <div class="d-flex mt-4">
                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                            <div class="ms-3">
                                <div class="fw-bold">Commenter Name</div>
                                And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                            </div>
                        </div>

                        <div class="d-flex mt-4">
                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                            <div class="ms-3">
                                <div class="fw-bold">Commenter Name</div>
                                When you put money directly to a problem, it makes a good headline.
                            </div>
                        </div>-->

                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>