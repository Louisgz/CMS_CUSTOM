
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
                    <div>
                         <?php   if (isset($_SESSION['user'])){ ?>
                        <form action="create-comment/?id=<?php echo($_GET['id']) ?>" method='post'>
                            <input type="text" id="commentInput" name="comment" placeholder="ajouter commentaire">
                            <input type="submit" value="Create comment">
                        </form>

                       <?php }?>
                    </div>
                </div>
            </div>
        <?php
        }
        
        ?>
      
</div>