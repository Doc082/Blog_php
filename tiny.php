      

                    <form action="insertNew.php?token=<?=$token?>&<?=$modify?'update='.$modify:''?>" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                        <div class="input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-lg">Titolo</span>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="titolo" value="<?=$news['titolo']?>">
                                        </div>
                                        <div class="input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-lg">Articolo</span>
                                            </div>
                                            <textarea class="form-control" name="articolo" id="textarea1"><?=$news['contenuto']?></textarea>
                                        </div>
                                        <div class="input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-lg">Hashtag</span>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="hashtag" value="<?=$news['hashtag']?>">
                                        </div>
                                        <div class="input-group input-group-lg mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-lg">Descrizione</span>
                                            </div>
                                            <textarea  class="form-control" name="descrizione"><?=$news['descrizione']?></textarea>
                                        </div>
                                        <button class="btn btn-success" type="submit">Invia Articolo</button>
                                    </div>
                                    <div class="form-group col-md-2 menublock">
                                        <p style="color:white;">Scegli immagine di copertina</p>
                                    <div class="input-group mb-3">
                                       
                                        <label class="fileContainer">
                                            <img src="images/<?= $news['immagini'] ?>" id="titleimg" height="100">
                                            <br>Carica immagine di copertina
                                            <input type="file" name="copertina" onchange="document.getElementById('titleimg').src=window.URL.createObjectURL(this.files[0])"/>
                                            <input type="hidden" name="altcopertina" value="<?= $modify?$news['immagini']:''?>">
                                </label>
                                        
                                        
                                    </div>
                                        
                                         <p style="color:white;">Anteprima immagine titolo</p>
                                         <p>&nbsp;</p>
                                         <p style="color:white;">Scegli Categoria</p>
                                    <div class="input-group-prepend">
                                        
                                            <label class="input-group-text" for="inputGroupSelect01">Categorie</label>
                                        </div>
                                        <select class="custom-select" id="categoria" name="categoria">
                                        
                                        <?php
                                            $categories = getCategories();
                                            $select='';
                                            foreach($categories as $key=>$cat){
                                                if($news['categoria'] != ''){
                                                    if($news['categoria'] == $cat){
                                                        $select='selected';
                                                    }else $select='';
                                                }else if(!$key) $select='selected';
                                                else $select='';
                                        ?>
                                       
                                        <option <?=$select?> value="<?=$cat?>"><?=$cat?></option>
                                            
                                       
                                        <?php
                                            }
                                        ?>
                                       </select>
                                        <p>&nbsp;</p>
                                        <div class="input-group mb-3">
                                            <input id="ncate" type="text" class="form-control" placeholder="Nuova Categoria..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" onclick="addCategory()" type="button">Aggiungi</button>
                                            </div>
                                        </div>
                                    </div>
                               
                                </div>
                        

                        
                        </form>

<script>
    function addCategory() {

    var x = document.getElementById("categoria");
    var nomecat= document.getElementById('ncate');
    var option = document.createElement("option");
    option.text = nomecat.value;
    option.value = nomecat.value;
    x.add(option);
}
</script>