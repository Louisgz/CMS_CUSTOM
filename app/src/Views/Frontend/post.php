
<?php
/**
 * @var $user \App\Entity\Author
 * @var $posts \App\Entity\Post[]
 */

use App\Entity\Author;
?>
<div class="flex-post-column">
        <?php
        foreach ($posts as $post) {
            ?>
            <div class="single-post-page">
                <div class="single-post-background">                        
                    <h3><?php echo $post['title'] ?></h3>
                    <div>
                        <button type="button" class="btn btn-danger">Delete post</button>
                        <button type="button" class="btn btn-warning"><a href="/edit-post">Edit post</a></button>
                    </div>
                    <div>
                        <p><?php echo $post['content'] ?></p>
                    </div>
                </div>
                <div>
                         <?php   if (isset($_SESSION['user'])){ ?>
                            <div>
                                <h4>Ajouter un commentaire :</h4>
                            </div>
                        <form action="create-comment/?id=<?php echo($_GET['id']) ?>" method='post'>
                            <input type="text" id="commentInput" name="comment" placeholder="ajouter commentaire">
                            <input class="btn btn-success" type="submit" value="add comment">
                            
                        </form>

                       <?php }?>
                    </div>
                    <div class="single-post-background">
                    <p>
                    commentaires:
                    </p>
                    <?php
                    foreach ($comments as $comment){
                        if($comment['postId'] == $post['id']){
                            ?>
                            <div>
                                <div>
                                    <p>
                                        <?php echo $comment['content'] ?>
                                    </p>
                                </div>
                                <button type="button" class="btn btn-danger">Delete post</button>
                            </div>
                            <?php
                        }
                        ?>
                        
                        <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        
        ?>
      
</div>