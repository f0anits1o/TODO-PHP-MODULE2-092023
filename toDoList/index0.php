<?php 
require 'connexion.php';
require 'html/header.php';
?>

    <div class="main-section">

        <!-- section ajouter -->
       <div class="add-section">

            <!-- formulaire -->
            <form action="app/ajouter.php" method="POST" autocomplete="off">

                <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'): ?>
                    <input type="text" 
                        name="title" 
                        style="border-color: #ff6666"
                        placeholder="Completez le champ s'il vous plait :)" />
                    <button type="submit">Add &nbsp; <span>&#43;</span></button>

                <?php else: ?>

                <input type="text" 
                     name="title" 
                     placeholder="Qu'est-ce que vous voulez faire?" />
              <button type="submit">Ajouter &nbsp; <span>&#43;</span></button>
             <?php endif; ?>
            </form>
            <!-- Fin Formulaire -->
       </div>
       <!-- Fin section Ajouter -->


       
       <!-- requête pour afficher la liste des taches -->
       <?php 
            $sql = 'SELECT * FROM todo ORDER BY id DESC';
    
            $todos = $conn->query("$sql");
       ?>
        <!-- section affichage -->
       <div class="show-todo-section">

            <?php if($todos->rowCount() <= 0): ?>
                <div class="todo-item">
                    <div class="empty">
                        <img src="img/f.png" width="50%" />
                        <br>
                        <img src="img/Ellipsis.gif" width="30px">
                    </div>
                </div>
            <?php endif; ?>

            <?php $todo = $todos->fetchall(PDO::FETCH_ASSOC); ?>

            <?php foreach($todo as $tache): ?>
                <div class="todo-item">
                    <ul>
                        <li><a href="app/supprimer.php?id=<?=$tache['id']?>"><img src="img/trash.png" alt="trash"></a></li>
                        <li><a href="app/modifier.php?id=<?=$tache['id']?>"><img src="img/pen.png" alt="pen" ></a></li>
                    </ul>
                    
            
                    <?php if($tache['checked']): ?> 
                        <?php // echo $tache['title'];?>  
                        <a href="checkboxchecked.php?id=<?php echo $tache['id']; ?>">
                               <input type="checkbox"
                               class="check-box "
                               id ="<?php echo $tache['id']; ?>"
                               checked />
                        </a>

                        <h2 class="checked"><?php echo $tache['title'] ?></h2>

                    <?php else: ?>
                        <a href="checkboxunchecked.php?id=<?php echo $tache['id']; ?>">
                               <label for="<?php echo $tache['id']; ?>"></label><input type="checkbox"
                               id ="<?php echo $tache['id']; ?>"
                               class="check-box"/>
                        </a>
                        <h2><?php echo $tache['title']?></h2>
                    <?php endif; ?>
                    
                    <br>
                    <div>
                    <small>cree le: <?php echo $tache['date_time'] ?></small> 
                    </div>
                </div>
            <?php endforeach; ?>
            <?php $todos->closeCursor(); ?>
        </div>
        <!-- Fin Affiche to do list -->

    </div>

    

    <?php
       require 'html/footer.php';

    ?>
