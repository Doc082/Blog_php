<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titolo</th>
      <th scope="col">Categoria</th>
      <th scope="col">Modifica</th>
      <th scope="col">Elimina</th>
      <th scope="col">Commenti Nuovi</th>
      <th scope="col">Totale Commenti</th>
    </tr>
  </thead>
  <tbody>
    <?php
        require_once('sm_gen.php');
		$news = getAllNews();
		sitemapGen($news);
        foreach($news as $articolo){
          $commenti = getNumberComments($articolo['id']);
    ?>
    <tr>
      <th scope="row"><?=$articolo['id']?></th>
      <td><?=$articolo['titolo']?></td>
      <td><?=$articolo['categoria']?></td>
      <td><button class='btn btn-success' onclick="location.href='editor.php?token=<?=$token?>&modify=<?=$articolo['id']?>'" ><i class='fa fa-pencil'></i> Modifica</button></td>
      <td><button class='btn btn-danger' onclick="location.href='editor.php?token=<?=$token?>&delete=<?=$articolo['id']?>&elenco=1'"><i class='fa fa-trash'></i> Elimina</button></td>
      <?php
            if($commenti){
      ?>
         <td><button class='btn btn-info' onclick="location.href='editor.php?token=<?=$token?>&idpost=<?=$articolo['id']?>&commento=1'"><i class='fa fa-comments'></i><?=$commenti['partial']?> Commenti</button></td>
         <td><?=$commenti['total']?> commenti in totale</td>
      <?php
        }
    ?>
    </tr>
    <?php
        }
    ?>
  </tbody>
</table>

