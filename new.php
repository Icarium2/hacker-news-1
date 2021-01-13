<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php $allPosts = getAllPosts($pdo); ?>

<?php if (loggedIn()) : ?>
    <article>
        <h4><strong>Most recent posts</strong></h4>
        <p><?php $message ?></p>
        <br>
        <?php foreach ($allPosts as $post) : ?>
            <?php $currentUserId = $_SESSION['user']['id']; ?>
            <?php $userPostId = $post['user_id']; ?>
            <?php $upvotes = countUpvotes($post['id'], $pdo); ?>
            <?php $alreadyUpvoted = alreadyUpvoted($post['id'], $currentUserId, $pdo); ?>
            <?php $numberOfComments = countNumberOfComments($post['id'], $pdo); ?>

            <div class="card shadow p-4 mb-4 bg-card mw-100">
                <img loading="lazy" src="<?php echo '/app/users/images/' . $post['avatar'] ?>" alt="user-avatar" width="50px">
                <?php if ($currentUserId === $userPostId) : ?>
                    <small class="text-muted"><a href="/settings.php?id=<?php echo $post['user_id']; ?>"><?php echo $post['username'] ?></a></small>
                <?php else : ?>
                    <small class="text-muted"><a href="/profile.php?id=<?php echo $post['user_id']; ?>"><?php echo $post['username'] ?></a></small>
                <?php endif; ?>
                <br>
                <h6><strong><a href="/post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title'] ?></a></strong></h6>
                <p><a class="text-info" href="<?php echo $post['url'] ?>"><?php echo $post['url'] ?></a></p>
                <p><?php echo $post['text'] ?></p>
                <small class="text-muted">Upvotes: <?php echo $upvotes; ?></small>
                <?php if ($alreadyUpvoted) : ?>
                    <form action="app/posts/upvotesnew.php" method="post">
                        <button class="btn btn-link" type="submit" name="submit">Downvote</button>
                        <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
                    </form>
                <?php else : ?>
                    <form action="app/posts/upvotesnew.php" method="post">
                        <button class="btn btn-link" type="submit" name="submit">Upvote</button>
                        <input type="hidden" name="postid" value="<?php echo $post['id']; ?>">
                    </form>
                <?php endif; ?>
                <small class="text-muted">Posted: <?php echo $post['date']; ?></small>
                <?php if ($numberOfComments == 1) : ?>
                    <small class="text-muted"><a href="/post.php?id=<?php echo $post['id']; ?>"><?php echo $numberOfComments; ?> comment</a></small>
                <?php else : ?>
                    <small class="text-muted"><a href="/post.php?id=<?php echo $post['id']; ?>"><?php echo $numberOfComments; ?> comments</a></small>
                <?php endif; ?>
                <small class="text-muted">
                    <?php if ($currentUserId === $userPostId) : ?>
                        <a href="/updateuserpost.php?id=<?php echo $post['id']; ?>">Edit Post</a>
                    <?php endif; ?>
                </small>
            </div>
            <div class="py-1"></div>
        <?php endforeach; ?>
    </article>

<?php else : ?>
    <article>
        <h4><strong>Most recent posts</strong></h4>
        <br>
        <?php foreach ($allPosts as $post) : ?>
            <?php $upvotes = countUpvotes($post['id'], $pdo); ?>
            <?php $numberOfComments = countNumberOfComments($post['id'], $pdo); ?>

            <div class="card shadow p-4 mb-4 bg-card mw-100">
                <img loading="lazy" src="<?php echo '/app/users/images/' . $post['avatar'] ?>" alt="user-avatar" width="50px">
                <small class="text-muted"><a href="/profile.php?id=<?php echo $post['user_id']; ?>"><?php echo $post['username'] ?></a></small>
                <br>
                <h6><strong><a href="/post.php?id=<?php echo $post['id']; ?>"><?php echo $post['title'] ?></a></strong></h6>
                <p><a class="text-info" href="<?php echo $post['url'] ?>"><?php echo $post['url'] ?></a></p>
                <p><?php echo $post['text'] ?></p>
                <small class="text-muted">Upvotes: <?php echo $upvotes; ?></small>
                <small class="text-muted">Posted: <?php echo $post['date']; ?></small>
                <?php if ($numberOfComments == 1) : ?>
                    <small class="text-muted"><a href="/post.php?id=<?php echo $post['id']; ?>"><?php echo $numberOfComments; ?> comment</a></small>
                <?php else : ?>
                    <small class="text-muted"><a href="/post.php?id=<?php echo $post['id']; ?>"><?php echo $numberOfComments; ?> comments</a></small>
                <?php endif; ?>
            </div>
            <div class="py-1"></div>
        <?php endforeach; ?>
    </article>
<?php endif; ?>


<?php require __DIR__ . '/views/footer.php'; ?>