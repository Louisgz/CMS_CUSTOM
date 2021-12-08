

<?php
/**
 * @var $user \App\Entity\Author
 * @var $posts \App\Entity\Post[]
 */


?>

<div class="flex-post-column">
    <h1>Dernier post</h1>
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
                                <input type="text" id="commentInput" name="addComment" placeholder="ajouter commentaire">
                                <button id="addComment" onclick="addComment(<?php echo $post['id'] ?>)">Ajouter</button>
                            </div>
                        </div>
                    <?php
                    }
                    
                    ?>
      
</div>