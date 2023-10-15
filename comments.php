<div class="row text-center">
    <div class="col-md-6 offset-3">
        <form method="POST" action="sp_comment.php">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Email</span>
                </div>
                <input type="email" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="email">
            </div>

            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Commento</span>
                </div>
                <textarea class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="commento" rows="5"></textarea>
            </div>
            <input hidden name="id" value="<?=$articolo['id']?>">
            <input hidden name="url" value="<?=$articolo['url']?>">
            <button type="submit" class="btn btn-primary ">Invia commento</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-6 offset-3">
        <?php
            $comments = getComments($articolo['id']);
            if($comments) foreach($comments as $comment){
        ?>
        <p>&nbsp;</p>
        <p><?=$comment['email']?> - <?=date('d/m/Y', strtotime($articolo['create_at']))?><br><?=$comment['commento']?></p>
        <?php
            }
        ?>
    </div>
</div>
