
<?php
/**
 * @var $user \App\Entity\Author
 * @var $posts \App\Entity\Post[]
 */


?>
<div class="flex-post-column">
        <?php
        foreach ($posts as $post) {
            ?>
            <div>
                <div>                        
                    <h3><?php echo $post['title'] ?></h3>
                    <p><?php echo $post['content'] ?></p>
                </div>
                <div>
                    <p>
                    commentaires:
                    </p>
                    <?php
                    foreach ($comments as $comment){
                        if($comment['postId'] == $post['id']){
                            ?>
                            <div>
                                <p>
                                    <?php echo $comment['content'] ?>
                                </p>
                            </div>
                            <?php
                        }
                        ?>
                        
                        <?php
                    }
                    ?>
                    <form action="create-comment/?id=<?php echo($_GET['id']) ?>" method='post'>
                    <input type="text" id="commentInput" name="comment" placeholder="ajouter commentaire">
                    <input type="submit" value="Create comment">
                    </form>
                </div>
            </div>
        <?php
        }
        
        ?>
      
</div>