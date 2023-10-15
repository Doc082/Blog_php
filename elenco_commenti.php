<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Email Commento</th>
      <th scope="col">Commento</th>
      <th scope="col">Accetta Commento</th>
      <th scope="col">Elimina</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $comments = getAllComments($idpost);
        foreach($comments as $comment){  
    ?>
    <tr>
      <th scope="row"><?=$comment['id']?></th>
      <td><?=$comment['email']?></td>
      <td><?=$comment['commento']?></td>
      <td>
      <?php if($comment['public'] != 'ok') { ?>
      <button class='btn btn-success' onclick="location.href='editor.php?token=<?=$token?>&accept=<?=$comment['id']?>&commento=1&idpost=<?=$idpost?>'" ><i class='fa fa-pencil'></i> Accetta Commento</button>
      <?php
      }
      ?>
      </td>
      <td><button class='btn btn-danger' onclick="location.href='editor.php?token=<?=$token;?>&deletecomment=<?=$comment['id'];?>&commento=1&idpost=<?=$idpost?>'"><i class='fa fa-trash'></i> Elimina Commento</button></td>
    </tr>
    <?php
        }
    ?>
    
  </tbody>
</table>

